<?php
session_start();
require 'conexao.php';

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nome = $conn->real_escape_string($_POST['nome']);
  $usuario = $conn->real_escape_string($_POST['usuario']);
  $email = $conn->real_escape_string($_POST['email']);
  $senha = $_POST['senha'];
  $confirma = $_POST['confirma'];

  if ($senha !== $confirma) {
    $erro = "❌ As senhas não coincidem.";
  } else {
    // Verifica se e-mail ou usuário já existem
    $verifica = $conn->prepare("SELECT * FROM usuarios WHERE email = ? OR usuario = ?");
    $verifica->bind_param("ss", $email, $usuario);
    $verifica->execute();
    $resultado = $verifica->get_result();

    if ($resultado->num_rows > 0) {
      $erro = "❌ Usuário ou e-mail já cadastrados.";
    } else {
      // Tudo certo, insere no banco
      $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

      $stmt = $conn->prepare("INSERT INTO usuarios (nome, usuario, email, senha) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("ssss", $nome, $usuario, $email, $senha_hash);

      if ($stmt->execute()) {
        $_SESSION['usuario'] = $usuario;
        header("Location: area_restrita.php");
        exit;
      } else {
        $erro = "Erro ao cadastrar: " . $conn->error;
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cadastro</title>
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

    /* Mensagem de erro */
    .error {
      color: red;
      margin-top: 10px;
      font-weight: bold;
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
    <h2>Cadastro de Usuário</h2>

    <?php if (!empty($erro)): ?>
      <p class="error"><?php echo $erro; ?></p>
    <?php endif; ?>

    <form method="post">
      <input type="text" name="nome" placeholder="Nome completo" required />
      <input type="text" name="usuario" placeholder="Nome de usuário" required />
      <input type="email" name="email" placeholder="E-mail" required />
      <input type="password" name="senha" placeholder="Senha" required />
      <input type="password" name="confirma" placeholder="Confirmar senha" required />
      <button type="submit">Cadastrar</button>
    </form>

    <p><a href="index.php">← Voltar para o login</a></p>
  </div>
</body>
</html>
