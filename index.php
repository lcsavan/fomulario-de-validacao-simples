<?php
$erroNome = "";
$erroEmail = "";
$erroSenha = "";
$erroRepeteSenha = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  //VERIFICAR SE ESTÁ VAZIO O POST NOME
  if (empty($_POST['nome'])) {
    $erroNome = "Por favor, Informe seu nome completo";
  } else {
    //PEGAR O VALOR VINDO DO POST E LIMPAR
    $nome = limpaPost($_POST['nome']);

    //VERIFICAR SE TEM SOMENTE LETRAS
    if (!preg_match("/^[a-zA-Z-' ]*$/", $nome)) {
      $erroNome = "Não informe caracteres especiais, somente letras e espaço";
    }
  }

  //VERIFICAR SE ESTÁ VAZIO O POST EMAIL
  if (empty($_POST['email'])) {
    $erroEmail = "Por favor, informe seu e-mail";
  } else {
    $email = limpaPost($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $erroEmail = "E-mail inválido!";
    }
  }

  //VERIFICAR SE ESTÁ VAZIO O POST SENHA
  if (empty($_POST['senha'])) {
    $erroSenha = "Por favor, informe uma senha";
  } else {
    $senha = limpaPost($_POST['senha']);
    if (strlen($senha) < 6) {
      $erroSenha = "A senha precisa ter no mínimo 6 dígitos!";
    }
  }

  //VERIFICAR SE ESTÁ VAZIO O POST REPETE_SENHA
  if (empty($_POST['repete_senha'])) {
    $erroRepeteSenha = "Por favor, informe a repetição da senha";
  } else {
    $repete_senha = limpaPost($_POST['repete_senha']);
    if ($repete_senha !== $senha) {
      $erroRepeteSenha = "O confirme a senha está diferente da senha!";
    }
  }

  //SE NÃO TIVER NENHUM ERRO ENVIAR PARA OBRIGADO
  if (($erroNome == "") && ($erroEmail == "") && ($erroSenha == "") && ($erroRepeteSenha == "")) {
    header('Location: obrigado.php');
  }
}

function limpaPost($valor)
{
  $valor = trim($valor);
  $valor = stripslashes($valor);
  $valor = htmlspecialchars($valor);
  return $valor;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validação de Formulário</title>
    <link href="css/estilo.css" rel="stylesheet">
</head>

<body>
    <main>
        <h1>Validação de Formulário Simples</h1>
        <form method="post">
            <!-- NOME COMPLETO -->
            <label>Nome Completo </label>
            <input type="text" <?php if (!empty($erroNome)) { echo "class='invalido'";} ?> <?php if (isset($_POST['nome'])) {
              echo "value='" . $_POST['nome'] . "'"; } ?> name="nome" placeholder="Digite seu nome">
            <span class="erro"><?php echo $erroNome; ?></span>
            <!-- EMAIL -->
            <label>E-mail </label>
            <input type="email" <?php if (!empty($erroEmail)) { echo "class='invalido'";} ?> <?php if (isset($_POST['email'])) {
              echo "value='" . $_POST['email'] . "'";} ?> name="email" placeholder="seuemail@mail.com">
            <span class="erro"><?php echo $erroEmail; ?></span>
            <!-- SENHA -->
            <label>Senha </label>
            <input type="password" <?php if (!empty($erroSenha)) { echo "class='invalido'";} ?> <?php if (isset($_POST['senha'])) {
              echo "value='" . $_POST['senha'] . "'";} ?> name="senha" placeholder="Digite uma senha">
            <span class="erro"><?php echo $erroSenha; ?></span>
            <!-- CONFIRME A A SENHA -->
            <label>Confirme a Senha </label>
            <input type="password" <?php if (!empty($erroSenha)) { echo "class='invalido'";} ?> <?php if (isset($_POST['repete_senha'])) {
              echo "value='" . $_POST['repete_senha'] . "'";} ?> name="repete_senha" placeholder="Confirme a senha">
            <span class="erro"><?php echo $erroRepeteSenha; ?></span>
            <button type="submit"> Enviar Formulário </button>
        </form>
    </main>
</body>

</html>