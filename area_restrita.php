<?php
// 🔒 Protege com sessão e bloqueia cache
session_start();

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

if (!isset($_SESSION['usuario'])) {
  header("Location: index.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Área Restrita</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      text-align: center;
      padding: 50px;
    }
    h2 {
      color: #004080;
    }
    a {
      display: inline-block;
      margin-top: 20px;
      text-decoration: none;
      padding: 10px 20px;
      background: #004080;
      color: white;
      border-radius: 5px;
    }
    a:hover {
      background: #0066cc;
    }
  </style>
</head>
<body>
  <h2>Bem-vindo(a), <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h2>
  <p>Esse é um  futuro painel de acesso e está em construção. Faltam aprimoramentos como "editar perfil", conteúdo da página, entre outros.</p>
  <a href="logout.php">Sair</a>
</body>
</html>
