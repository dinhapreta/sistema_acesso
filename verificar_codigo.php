<?php
session_start();
if (!isset($_SESSION["codigo"])) {
  header("Location: esqueci_senha.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $codigo_digitado = $_POST["codigo"];

  if ($codigo_digitado == $_SESSION["codigo"]) {
    $_SESSION["verificado"] = true;
    header("Location: nova_senha.php");
    exit;
  } else {
    $erro = "Código incorreto. Tente novamente.";
  }
}
?>

<form method="post">
  <h2>Digite o código recebido</h2>
  <?php if (isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
  <input type="text" name="codigo" placeholder="Código de 6 dígitos" required>
  <button type="submit">Verificar</button>
</form>
