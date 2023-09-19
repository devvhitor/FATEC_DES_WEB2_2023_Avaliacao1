
<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Se o usuário não estiver logado, redirecione para a página de login.
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $ra = $_POST["ra"];
    $placa = $_POST["placa"];

    // Salvar os dados em um arquivo de texto (append mode).
    $file = fopen("alunos.txt", "a");
    fwrite($file, "$nome | $ra | $placa\n");
    fclose($file);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Alunos</title>
</head>
<body>
    <h2>Cadastro de Alunos</h2>
    <form method="post">
        <label for="nome">Nome Completo:</label>
        <input type="text" name="nome" required><br>

        <label for="ra">Registro Acadêmico (R.A.):</label>
        <input type="text" name="ra" required><br>

        <label for="placa">Placa do Carro ou Moto:</label>
        <input type="text" name="placa" required><br>

        <input type="submit" value="Cadastrar">
    </form>
    
    <h2>Registros de Alunos</h2>
    <?php
    $file = fopen("alunos.txt", "r");
    if ($file) {
       
        

        while (($line = fgets($file)) !== false) {
            $dados = explode("|", $line);

            // Verificar se o array $dados possui os índices necessários se está preenchido corretamente 
            if (isset($dados[0]) && isset($dados[1]) && isset($dados[2])) {
                echo "<tr><td>{$dados[0]}</td><td>{$dados[1]}</td><td>{$dados[2]}</td></tr>";
            } else {
                echo "<tr><td colspan='3'></td></tr>";
            }
        }               

                         // OBS:
                      // eu estava tentando fazer os  registros com tabela para melhorar design, mas comecou dar erro tirei , mas o codigo da tabela permaneceu aí sem uso  
       
       
                      echo "</table>";
        fclose($file);
    } else {
        echo "Não foi possível abrir o arquivo de registros.";
    }
    ?>
    
    <br>
   <p> <a href="visualizar_registros.php">Visualizar Registros</a>     </p>
   <p> <a href="logout.php">Logout</a></p>
</body>
</html>