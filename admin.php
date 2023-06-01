<?php
session_start();
require_once("db.php");

// Verifique se o usuário está logado
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

// Processar o formulário de cadastro de treino
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST["tipo"];
    $tempo = $_POST["tempo"];
    $categoria = $_POST["categoria"];
    
    // Inserir o treino no banco de dados
    $sql = "INSERT INTO treino (tipo, tempo, categoria) VALUES ('$tipo', $tempo, '$categoria')";
    if ($conn->query($sql) === TRUE) {
        echo "Treino cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar o treino: " . $conn->error;
    }
}

// Obter a lista de treinos cadastrados
$sql = "SELECT * FROM treino";
$result = $conn->query($sql);
$treinos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $treinos[] = $row;
    }
} else {
    echo "Nenhum treino cadastrado.";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administração</title>
</head>
<body>
    <h2>Administração</h2>
    
    <h3>Cadastrar Treino</h3>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo">
            <option value="For Time">For Time</option>
            <option value="AMRAP">AMRAP</option>
            <option value="EMOM">EMOM</option>
            <option value="TABATA">TABATA</option>
        </select><br><br>
        <label for="tempo">Tempo (minutos):</label>
        <input type="number" id="tempo" name="tempo"><br><br>
        <label for="categoria">Categoria:</label>
        <select id="categoria" name="categoria">
            <option value="Força">Força</option>
            <option value="Endurance">Endurance</option>
            <option value="Cardio">Cardio</option>
        </select><br><br>
        <input type="submit" value="Cadastrar">
    </form>
    
    <h3>Treinos Cadastrados</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Tempo</th>
            <th>Categoria</th>
        </tr>
        <?php foreach ($treinos as $treino): ?>
            <tr>
                <td><?php echo $treino["id"]; ?></td>
                <td><?php echo $treino["tipo"]; ?></td>
                <td><?php echo $treino["tempo"]; ?></td>
                <td><?php echo $treino["categoria"]; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    
    <br><br>
    <a href="logout.php">Sair</a>
</body>
</html>
