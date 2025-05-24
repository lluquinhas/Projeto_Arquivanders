<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../login/login.php");
    exit();
}

if ($_SESSION['tipo_usuario'] !== 'admin') {
    echo "Você não tem permissão para acessar esta página.";
    exit();
}

include("../conexao.php");

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $ano = $_POST['ano_publicacao'];
    $genero = $_POST['genero'];

    // Upload do arquivo
    $arquivo_nome = $_FILES['arquivo']['name'];
    $arquivo_tmp = $_FILES['arquivo']['tmp_name'];

    // Pasta onde o arquivo será salvo
    $pasta = "../uploads/livros/";

    // Caminho final do arquivo
    $destino = $pasta . basename($arquivo_nome);

    // Move o arquivo para a pasta
    if (move_uploaded_file($arquivo_tmp, $destino)) {
        // Inserir no banco
        $sql = "INSERT INTO livros (titulo, autor, ano_publicacao, genero, arquivo) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $titulo, $autor, $ano, $genero, $arquivo_nome);

        if ($stmt->execute()) {
            echo "<p>Livro cadastrado com sucesso!</p>";
            echo "<a href='index.php'>Voltar para a lista de livros</a>";
        } else {
            echo "<p>Erro ao cadastrar livro.</p>";
        }

        $stmt->close();
    } else {
        echo "<p>Erro ao fazer upload do arquivo.</p>";
    }

    $conn->close();
}
?>

<style>
body {
    font-family: Arial, sans-serif;
    background-color: #FDF5E4;
    margin: 0;
    padding: 0;
}

h2 {
    text-align: center;
    color: #333;
    margin-top: 30px;
}

form {
    background-color: #fff;
    max-width: 500px;
    margin: 30px auto;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
}

label {
    display: block;
    margin-bottom: 5px;
    color: #555;
    font-weight: bold;
}

input[type="text"],
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #2C3E49;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color:rgb(31, 50, 61);
}

a {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: #333;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}


</style>

<!-- Formulário HTML -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Livros</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h2>Cadastro de Livros</h2>

    <form action="cadastro.php" method="POST" enctype="multipart/form-data">
        <label>Título:</label>
        <input type="text" name="titulo" required><br>

        <label>Autor:</label>
        <input type="text" name="autor" required><br>

        <label>Ano de Publicação:</label>
        <input type="text" name="ano_publicacao" required><br>

        <label>Gênero:</label>
        <select name="genero" required>
            <option value="">Selecione o gênero</option>
            <option value="Ficção">Ficção</option>
            <option value="Aventura">Aventura</option>
            <option value="Fantasia">Fantasia</option>
            <option value="Romance">Romance</option>
            <option value="Terror">Terror</option>
            <option value="Mistério">Mistério</option>
            <option value="Infantil">Infantil</option>
        </select><br>

        <label>Arquivo (PDF):</label>
        <input type="file" name="arquivo" accept=".pdf" required><br><br>

        <input type="submit" value="Cadastrar Livro">
    </form>
</body>
</html>
