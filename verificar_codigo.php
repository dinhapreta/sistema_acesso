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

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Verificar Código</title>
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
    <h2>Digite o código recebido</h2>

    <?php if (isset($erro)) echo "<p class='error'>$erro</p>"; ?>

    <form method="post">
      <input type="text" name="codigo" placeholder="Código de 6 dígitos" required />
      <button type="submit">Verificar</button>
    </form>

        <p><a href="index.php">← Voltar para o login</a></p>

  </div>
</body>
</html>
