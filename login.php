<?php
// Inicia a sessão
session_start();

// Verifica se o usuário já está logado, se sim, redireciona para a página do dashboard
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: dashboard.php");
    exit;
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Conecta ao banco de dados
    $conn = new mysqli("localhost", "root", "", "sistema");

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Consulta o banco de dados para verificar o usuário e a senha
    $sql = "SELECT id FROM usuario WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    // Verifica se o usuário e a senha estão corretos
    if ($result->num_rows > 0) {
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
        header("location: dashboard.php");
    } else {
        $error = "Usuário ou senha incorretos";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #1a1a2e;
            font-family: Arial, sans-serif;
            color: #eaeaea;
        }

        .form-container {
            background-color: #16213e;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
        }

        .form-container h1 {
            color: #0f3460;
            margin-bottom: 20px;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
        }

        .form-container label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #eaeaea;
            align-self: flex-start;
        }

        .form-container input {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #0f3460;
            font-size: 16px;
            background-color: #1a1a2e;
            color: #eaeaea;
        }

        .form-container input[type="submit"] {
            background-color: #0f3460;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
            border: none;
        }

        .form-container input[type="submit"]:hover {
            background-color: #0e2957;
        }

        .form-container a {
            color: #0f3460;
            text-decoration: none;
        }

        .form-container a:hover {
            color: #eaeaea;
        }

        .form-container p {
            color: red;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1>Login</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Usuário:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Login">
        </form>
        <a href="registro.php">Registrar</a>
        <?php
        if (!empty($error)) {
            echo "<p>" . $error . "</p>";
        }
        ?>
    </div>
</body>

</html>
