<?php
session_start();

// Destrua a sessão e redirecione para a página de login.
session_destroy();
header("Location: login.php");
exit();
?>