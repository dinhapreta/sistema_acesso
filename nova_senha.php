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

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Nova Senha</title>
  <style>
    /* Reset básico */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: #f5f5f5;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .container {
      background: #fff;
      padding: 30px 25px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    h2 {
      margin-bottom: 20px;
      color: #333;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    input {
      padding: 12px 15px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 6px;
      transition: border-color 0.3s ease;
    }

    input:focus {
      border-color: #4a90e2;
      outline: none;
    }

    button {
      padding: 12px;
      font-size: 16px;
      background-color: #4a90e2;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #357abd;
    }

    p {
      margin-top: 15px;
      font-size: 14px;
      color: #555;
    }

    a {
      color: #4a90e2;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }
    .error {
      color: red;
      font-weight: bold;
      margin-bottom: 15px;
    }

    @media (max-width: 480px) {
      .container {
        padding: 20px 15px;
        max-width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Nova senha</h2>

    <?php if (isset($erro)): ?>
      <p class="error"><?php echo $erro; ?></p>
    <?php endif; ?>

    <form method="post">
      <input type="password" name="nova" placeholder="Nova senha" required />
      <input type="password" name="confirma" placeholder="Confirmar nova senha" required />
      <button type="submit">Alterar senha</button>
    </form>

        <p><a href="index.php">← Voltar para o login</a></p>

  </div>
</body>
</html>
