<?php
$host = "sql201.infinityfree.com";         // Host do MySQL
$user = "if0_39339520";                    // Nome de usuário
$pass = "isSpzmzlJVdNuAF";                // Senha
$db   = "if0_39339520_sistema_acesso";     // Nome do banco de dados

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Erro na conexão: " . $conn->connect_error);
}
?>
