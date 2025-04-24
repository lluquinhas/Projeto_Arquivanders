<?php
session_start();
include("../conexao.php"); // Conexão com o banco de dados

// Inicializando variáveis de erro e resultados
$erro = '';
$livros = [];
$pesquisa = '';
$generoSelecionado = '';

// Verificando se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pegando os valores dos campos do formulário
    $pesquisa = $_POST['pesquisa'] ?? '';
    $generoSelecionado = $_POST['genero'] ?? '';

    // Construindo a consulta SQL dinamicamente com base na pesquisa e no gênero
    $sql = "SELECT * FROM livros WHERE 1"; 

    // Se houver pesquisa, adiciona filtro por título
    if (!empty($pesquisa)) {
        $sql .= " AND titulo LIKE ?";
    }

    // Se houver gênero selecionado, adiciona filtro por gênero
    if (!empty($generoSelecionado)) {
        $sql .= " AND genero = ?";
    }

    // Preparando a consulta
    $stmt = $conn->prepare($sql);

    // Binding de parâmetros para a consulta preparada
    if (!empty($pesquisa) && !empty($generoSelecionado)) {

        // Usando dois parâmetros: pesquisa e gênero
        $pesquisa_param = "%$pesquisa%";  // Adicionando % para pesquisa LIKE
        $stmt->bind_param("ss", $pesquisa_param, $generoSelecionado);

    } elseif (!empty($pesquisa)) {

        // Apenas pesquisa
        $pesquisa_param = "%$pesquisa%";
        $stmt->bind_param("s", $pesquisa_param);

    } elseif (!empty($generoSelecionado)) {

        // Apenas gênero
        $stmt->bind_param("s", $generoSelecionado);
    }

    // Executando a consulta
    $stmt->execute();

    // Obter resultados da consulta
    $resultado = $stmt->get_result();

    while ($livro = $resultado->fetch_assoc()) {
        $livros[] = $livro;
    }

    // Fechando o statement e a conexão
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Virtual</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
        <h1>Bem-vindo à Biblioteca Virtual</h1>
    </header>

    <nav>
        <ul>
            <li><a href="tela_inicial.php">Início</a></li>
        </ul>
    </nav>

    <section>
        <h2>Pesquisa de Livros</h2>
        <form action="index.php" method="POST">
            <input type="text" name="pesquisa" placeholder="Pesquise por título..." value="<?= htmlspecialchars($pesquisa) ?>">
            <select name="genero">
                <option value="">Escolha o gênero</option>
                <?php 
                // Gêneros disponíveis, você pode adicionar mais opções
                $generos = ["Ficção", "Aventura", "Fantasia", "Romance", "Terror", "Mistério"];
                foreach ($generos as $genero): 
                ?>
                    <option value="<?= $genero ?>" <?= $genero == $generoSelecionado ? 'selected' : '' ?>><?= $genero ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Buscar</button>
        </form>

        <h3>Livros Encontrados</h3>
        <ul>
            <?php if (count($livros) > 0): ?>
                <?php foreach ($livros as $livro): ?>
                    <li>
                        <strong><?= htmlspecialchars($livro['titulo']) ?></strong> - <?= htmlspecialchars($livro['autor']) ?> (<?= htmlspecialchars($livro['ano_publicacao']) ?>)
                        <br>
                        Gênero: <?= htmlspecialchars($livro['genero']) ?>
                        <br>
                        <a href="ler_livro.php?arquivo=<?= urlencode($livro['arquivo']) ?>" target="_blank">Ler livro</a>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhum livro encontrado.</p>
            <?php endif; ?>
        </ul>
    </section>
</body>
</html>
