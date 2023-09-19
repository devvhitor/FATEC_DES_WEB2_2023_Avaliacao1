<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Se o usuário não estiver logado, redirecione para a página de login.
    header("Location: login.php");
    exit();
}

function lerRegistros() {
    $file = fopen("alunos.txt", "r");

    if ($file) {
        echo "<h2>Registros de Alunos</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Nome Completo</th><th>Registro Acadêmico (R.A.)</th><th>Placa do Carro ou Moto</th></tr>";

        while (($line = fgets($file)) !== false) {
            $dados = explode("|", $line);

            // Verificar se o array $dados possui os índices necessários
            if (isset($dados[0]) && isset($dados[1]) && isset($dados[2])) {
                echo "<tr><td>{$dados[0]}</td><td>{$dados[1]}</td><td>{$dados[2]}</td></tr>";
            } else {
                echo "<tr><td colspan='3'></td></tr>";
            }
        }

        echo "</table>";
        fclose($file);
    } else {
        echo "Não foi possível abrir o arquivo de registros.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Visualizar Registros</title>
</head>
<body>
    <a href="cadastro.php">Voltar</a>
    <?php lerRegistros(); ?>
    <br>
    <a href="logout.php">Logout</a>
</body>
</html>
