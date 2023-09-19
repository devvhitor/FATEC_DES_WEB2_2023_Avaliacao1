<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Se o usuário já estiver logado, redirecione para a página de cadastro.
    header("Location: cadastro.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = "portaria";
    $senha = "FatecAraras";

    if ($_POST["username"] == $login && $_POST["password"] == $senha) {
        // Defina a sessão como logada.
        $_SESSION['logged_in'] = true;
        header("Location: cadastro.php");
        exit();
    } else {
        $erro = "Login ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($erro)) { echo "<p>$erro</p>"; } ?>
    <form method="post">
        <label for="username">Login:</label>
        <input type="text" name="username" required><br>

        <label for="password">Senha:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Entrar">
    </form>

    <br>
    <a href="cadastro.php">Acesso ao Cadastro</a>
</body>
</html>