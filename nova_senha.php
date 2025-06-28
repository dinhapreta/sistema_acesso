<?php
session_start();
require 'conexao.php';

// Garante que só usuários verificados acessem
if (!isset($_SESSION["verificado"]) || !isset($_SESSION["email"])) {
  session_destroy();
  header("Location: esqueci_senha.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nova = $_POST["nova"];
  $confirma = $_POST["confirma"];

  if ($nova !== $confirma) {
    $erro = "As senhas não coincidem.";
  } else {
    $hash = password_hash($nova, PASSWORD_DEFAULT);
    $email = $_SESSION["email"];

    // Corrigido: WHERE email = ?
    $stmt = $conn->prepare("UPDATE usuarios SET senha = ? WHERE email = ?");
    $stmt->bind_param("ss", $hash, $email);

    if ($stmt->execute()) {
      session_destroy();
      header("Location: index.php");
      exit;
    } else {
      $erro = "Erro ao redefinir a senha.";
    }
  }
}
?>

<!-- HTML -->
<form method="post">
  <h2>Nova senha</h2>
  <?php if (isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
  
  <input type="password" name="nova" placeholder="Nova senha" required>
  <input type="password" name="confirma" placeholder="Confirmar nova senha" required>
  
  <button type="submit">Alterar senha</button>
</form>
