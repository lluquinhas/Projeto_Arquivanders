<?php
session_start();
include("../conexao.php"); // Conexão com o banco de dados

// Verificando se o parâmetro "arquivo" foi passado pela URL
if (isset($_GET['arquivo'])) {
    $arquivo = $_GET['arquivo'];

    // Validando se o arquivo existe no servidor
    $caminhoArquivo = "../uploads/livros/" . $arquivo;  // Diretório onde os livros são armazenados

    if (file_exists($caminhoArquivo)) {
        // Definir os headers para exibir o PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . basename($caminhoArquivo) . '"');
        header('Content-Length: ' . filesize($caminhoArquivo));

        // Lendo e exibindo o conteúdo do PDF
        readfile($caminhoArquivo);
        exit();
    } else {
        echo "Arquivo não encontrado!";
    }
} else {
    echo "Nenhum livro selecionado.";
}
?>