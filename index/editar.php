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

$id = $_GET['id'];

$sql = "SELECT * FROM livros WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$livro = $resultado->fetch_assoc();
$stmt->close();
$conn->close();
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

<h2>Editar Livro</h2>
<form method="POST" action="atualizar.php">
    <input type="hidden" name="id" value="<?= $livro['id'] ?>">
    Título: <input type="text" name="titulo" value="<?= htmlspecialchars($livro['titulo']) ?>"><br><br>
    Autor: <input type="text" name="autor" value="<?= htmlspecialchars($livro['autor']) ?>"><br><br>
    Ano de Publicação: <input type="text" name="ano_publicacao" value="<?= htmlspecialchars($livro['ano_publicacao']) ?>"><br><br>
    Gênero:
    <select name="genero">
        <?php 
        $generos = ["Ficção", "Aventura", "Fantasia", "Romance", "Terror", "Mistério", "Infantil"];
        foreach ($generos as $genero): 
        ?>
            <option value="<?= $genero ?>" <?= ($livro['genero'] == $genero) ? 'selected' : '' ?>><?= $genero ?></option>
        <?php endforeach; ?>
    </select><br><br>
    <input type="submit" value="Atualizar">
</form>
