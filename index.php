<!-- 🔐 index.php - Tela de login -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
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
    <h2>Login</h2>
    <form action="index.php" method="post">
      <input type="text" name="usuario" placeholder="Usuário" required>
      <input type="password" name="senha" placeholder="Senha" required>
      <button type="submit">Entrar</button>
    </form>

    <p><a href="esqueci_senha.php">Esqueci minha senha</a></p>
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
      echo '<p class="error">Usuário ou senha inválidos.</p>';
    }
    ?>
  </div>
</body>
</html>
