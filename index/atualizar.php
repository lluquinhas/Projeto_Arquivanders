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

$id = $_POST['id'];
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$ano_publicacao = $_POST['ano_publicacao'];
$genero = $_POST['genero'];

$sql = "UPDATE livros SET titulo = ?, autor = ?, ano_publicacao = ?, genero = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $titulo, $autor, $ano_publicacao, $genero, $id);

if ($stmt->execute()) {
    header("Location: index.php");
    exit();
} else {
    echo "Erro ao atualizar livro.";
}

$stmt->close();
$conn->close();
?>
