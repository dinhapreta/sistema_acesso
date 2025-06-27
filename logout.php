<?php
session_start();
session_unset();
session_destroy();

// Invalida o cache do navegador
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Redireciona
header("Location: index.php");
exit;
