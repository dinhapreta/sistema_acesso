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
    echo "<p style='color:red;'>E-mail não encontrado no sistema.</p>";
  } else {
    $codigo = rand(100000, 999999);
    $_SESSION["codigo"] = $codigo;
    $_SESSION["email"] = $email;

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'iamhere.suporte@gmail.com';
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
      echo "Erro ao enviar e-mail: " . $mail->ErrorInfo;
    }
  }
}
?>

<form method="post">
  <h2>Recuperar Senha</h2>
  <input type="email" name="email" required placeholder="Digite seu e-mail">
  <button type="submit">Enviar código</button>
</form>
