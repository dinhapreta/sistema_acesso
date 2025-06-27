<!-- 🔐 index.php - Tela de login -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
</head>
<body>
  <h2>Login</h2>
  <form action="index.php" method="post">
    <input type="text" name="usuario" placeholder="Usuário" required><br>
    <input type="password" name="senha" placeholder="Senha" required><br>
    <button type="submit">Entrar</button>
  </form>
<p><a href="esqueci_senha.php">Esqueci minha senha</a></p>
<br>
<p>Não tem conta? <a href="cadastro.php">Cadastre-se</a></p>


<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  require_once "conexao.php";

  $usuario = $conn->real_escape_string($_POST['usuario']);
  $senha = $_POST['senha'];

  $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
  $result = $conn->query($sql);

  if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($senha, $row['senha'])) {
      $_SESSION['usuario'] = $usuario;
      header("Location: area_restrita.php");
      exit;
    }
  }
  echo "<p>Usuário ou senha inválidos.</p>";
}
?>
</body>
</html>
