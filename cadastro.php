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

<h2>Cadastro de Usuário</h2>

<!-- Mostra o erro, se houver -->
<?php if (!empty($erro)): ?>
  <p style="color: red; font-weight: bold;"><?php echo $erro; ?></p>
<?php endif; ?>

<form method="post">
  <input type="text" name="nome" placeholder="Nome completo" required><br />
  <input type="text" name="usuario" placeholder="Nome de usuário" required><br />
  <input type="email" name="email" placeholder="E-mail" required><br />
  <input type="password" name="senha" placeholder="Senha" required><br />
  <input type="password" name="confirma" placeholder="Confirmar senha" required><br />
  <button type="submit">Cadastrar</button>
</form>

<p><a href="index.php">← Voltar para o login</a></p>
