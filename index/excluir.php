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

$sql = "DELETE FROM livros WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php");
    exit();
} else {
    echo "Erro ao excluir livro.";
}

$stmt->close();
$conn->close();
?>
