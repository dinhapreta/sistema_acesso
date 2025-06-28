<?php
session_start();
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';
require 'conexao.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Força reinício do processo de recuperação
session_unset();
session_destroy();
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = mysqli_real_escape_string($conn, $_POST["email"]);

  // Verifica se o e-mail existe no banco
  $sql = "SELECT id FROM usuarios WHERE email = '$email'";
  $resultado = mysqli_query($conn, $sql);

  if (mysqli_num_rows($resultado) === 0) {
    $erro = "E-mail não encontrado no sistema.";
  } else {
    $codigo = rand(100000, 999999);
    $_SESSION["codigo"] = $codigo;
    $_SESSION["email"] = $email;

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'seuemailaqui@gmail.com';
    $mail->Password = 'sua senha de app';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('iamhere.suporte@gmail.com', 'i_am_here - Recuperação');
    $mail->addAddress($email);
    $mail->isHTML(true);

    $mail->Subject = 'Código de verificação - Recuperação de senha';
    $mail->Body    = "<p>Seu código de verificação é: <strong>$codigo</strong></p>";

    if ($mail->send()) {
      header("Location: verificar_codigo.php");
      exit;
    } else {
      $erro = "Erro ao enviar e-mail: " . $mail->ErrorInfo;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Recuperar Senha</title>
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
    <h2>Recuperar Senha</h2>

    <?php if (!empty($erro)): ?>
      <p class="error"><?php echo $erro; ?></p>
    <?php endif; ?>

    <form method="post">
      <input type="email" name="email" required placeholder="Digite seu e-mail" />
      <button type="submit">Enviar código</button>
    </form>

        <p><a href="index.php">← Voltar para o login</a></p>

  </div>
</body>
</html>
