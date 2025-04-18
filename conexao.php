<?php
$servername = "localhost";
$usuario = "root";
$senha = "";
$banco = "arquivanders";

$conn = new mysqli($servername, $usuario, $senha, $banco);

// Verificação de erro
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>