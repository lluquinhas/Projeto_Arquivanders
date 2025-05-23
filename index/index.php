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
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Corpo da página */
body {
    background-color:#FDF5E4;
    padding: 20px;
}

/* Cabeçalho */
header {
    background-color: #2C3E49;
    color: #FDF5E4;
    padding: 20px;
    text-align: center;
    border-radius: 8px;
    margin-bottom: 20px;
}

/* Navegação */
nav ul {
    list-style: none;
    display: flex;
    gap: 20px;
    margin: 0 auto 20px;
    padding: 0;
    justify-content: center;
}

nav ul li a {
    text-decoration: none;
    color:#2C3E49;
    font-weight: bold;
    padding: 8px 16px;
    border: 2px solid transparent;
    border-radius: 5px;
    transition: 0.3s;
}


/* Seção principal */
section {
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(180, 64, 64, 0.1);
    max-width: 800px;
    margin: 0 auto;
}

section h2, section h3 {
    color:rgb(0, 0, 0);
    margin-bottom: 20px;
}

/* Formulário de busca */
form {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 30px;
}

form input[type="text"],
form select {
    padding: 10px;
    font-size: 16px;
    flex: 1;
    border: 1px solid #ccc;
    border-radius: 5px;
}

form button {
    padding: 10px 20px;
    background-color: #2C3E49;
    color: white;
    border: none;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
}

form button:hover {
    background-color:rgb(115, 27, 2, 0.73);
}

/* Lista de livros */
ul {
    list-style-type: none;
    padding: 0;
}

ul li {
    background-color: #f1f1f1;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 5px;
}

ul li strong {
    font-size: 18px;
    display: block;
    color: #333;
}

ul li a {
    color:rgb(31, 106, 205);
    text-decoration: none;
    font-weight: bold;
}

ul li a:hover {
    text-decoration: underline;
}

/* Mensagem quando nenhum livro for encontrado */
p {
    font-style: italic;
    color: #777;
}
</style>
</head>
<body>
    <header>
        <h1>Bem-vindo à Biblioteca Virtual</h1>
    </header>

    <nav>
        <ul>            <li><a href="../tela_inicial/tela_inicial.php">Voltar para Tela Inicial</a></li>
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
                $generos = ["Ficção", "Aventura", "Fantasia", "Romance", "Terror", "Mistério", "Infantil"];
                foreach ($generos as $genero): 
                ?>
                    <option value="<?= $genero ?>" <?= $genero == $generoSelecionado ? 'selected' : '' ?>><?= $genero ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Buscar</button>
        </form>

        <h3>Livros</h3>
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
