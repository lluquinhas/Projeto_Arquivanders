<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>
    <link rel="stylesheet" href="cadastro.css">
</head>
<body>
    <img class="estante.png" src="../imagens/estante.png">

    <form action="cadastro.php" method="POST">
        <input type="text" name="nome" placeholder="Nome completo" required><br>
        <input type="email" name="email" placeholder="E-mail" required><br>
        <input type="password" name="senha" placeholder="Crie uma senha" required><br>
        <input type="password" name="confirmar" placeholder="Confirme a senha" required><br>
        <button type="submit">Cadastrar</button>

    </form>

    <!-- PHP - CADASTRO -->

    <?php
     require_once "../conexao.php";

     if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $nome = $_POST['nome'];
         $email = $_POST['email'];
         $senha = $_POST['senha'];
         $confirmar = $_POST['confirmar'];
     
         // Verificação de senha
         if ($senha !== $confirmar) {
             echo "As senhas não coincidem.";
             exit;
         }
     
         // Usando a função password_hash para armazenamento seguro
         $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
     
         $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
         $stmt = $conn->prepare($sql); // Preparando a consulta para inserção no banco
         $stmt->bind_param("sss", $nome, $email, $senha_hash); // Indicando os tipos e valores
     
         if ($stmt->execute()) {
             echo "Cadastro realizado com sucesso!";
             header("Location: ../login/login.php");
             exit;
         } else {
             echo "Erro: " . $conn->error;
         }
     }
     ?>
</body>
</html>