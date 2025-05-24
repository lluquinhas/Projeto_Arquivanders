<?php
session_start();

include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario'] = $usuario['email'];
            $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];

            header("Location: ../index/index.php");
            exit();
        } else {
            $erro = "Senha incorreta.";
        }
    } else {
        $erro = "Usuário não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
         /* Reset básico */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Fundo da página */
body {
    height: 100vh;
    background-color: #FDF5E4;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Container do formulário */
.container {
    background: white;
    padding: 40px 30px;
    border-radius: 10px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

/* Título */
.container h2 {
    margin-bottom: 20px;
    color: #333;
}

/* Campos de entrada */
.container input[type="email"],
.container input[type="password"] {
    width: 100%;
    padding: 12px 15px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 8px;
    transition: border-color 0.3s ease;
}

.container input:focus {
    border-color: #74ebd5;
    outline: none;
}

/* Botão */
.container button {
    width: 100%;
    padding: 12px;
    background-color:#2C3E49;
    border: none;
    border-radius: 8px;
    color: white;
    font-size: 16px;
    cursor: pointer;
    margin-top: 10px;
    transition: background-color 0.3s ease;
}

.container button:hover {
    background-color: #5bc0be;
}

/* Mensagem de erro */
.erro {
    color: red;
    margin-top: 15px;
    font-size: 14px;
}

    </style>
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <form action="login.php" method="POST">
        <input type="email" name="email" placeholder="E-mail" required value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
        <li><a href="../cadastro/cadastro.php">Não tem login? Cadastre-se</a></li>
        <?php if (!empty($erro)) echo "<p class='erro'>$erro</p>"; ?>
    </form>
</div>
</body>
</html>
