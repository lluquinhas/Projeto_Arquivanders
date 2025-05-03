<?php
session_start();
$erro = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../conexao.php"); // conecta ao banco

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
            header("Location: ../index/index.php");
            exit();
        } else {
            $erro = "Senha incorreta.";
        }
    } else {
        $erro = "Usuário não encontrado.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .erro {
            color: red;
            margin-top: 10px;
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

        <?php if (!empty($erro)) echo "<p class='erro'>$erro</p>"; ?>
    </form>
</div>
</body>
</html>
