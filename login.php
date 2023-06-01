<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Verifique as credenciais de login
    if ($username === "admin" && $password === "admin123") {
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
        
        header("Location: admin.php");
    } else {
        $login_error = "Usuário ou senha inválidos";
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
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Usuário:</label>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Entrar">
    </form>
    <?php
    if (isset($login_error)) {
        echo "<p>" . $login_error . "</p>";
    }
    ?>
</body>
</html>
