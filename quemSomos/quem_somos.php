<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="quemSomos.css">
    <style>
        /* Reset básico */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Corpo da página */
body {
    background-color: #FDF5E4;
    color: #333;
    padding: 20px;
}

/* Cabeçalho com botão */
header {
    padding: 10px 0;
}

header a button {
    background-color: #007BFF;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s;
}

header a button:hover {
    background-color: #0056b3;
}

/* Imagem de destaque */
.pessoasLendo {
    display: block;
    max-width: 350px;
    margin: 30px auto 20px;
    border-radius: 12px;
}

/* Texto principal */
.Texto {
    max-width: 800px;
    margin: 0 auto;
    background-color: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.Texto h1 {
    font-size: 32px;
    color: #007BFF;
    margin-bottom: 20px;
    text-align: center;
}

.Texto p {
    font-size: 18px;
    line-height: 1.7;
    margin-bottom: 20px;
    text-align: justify;
}

.Texto span {
    font-weight: bold;
}

        </style>
</head>
<body>
    <header>
        <a href="../tela_inicial/tela_inicial.php"><button>Voltar</button></a>
    </header>

    <img class="pessoasLendo" src="../imagens/2.png">

    <div class="Texto">
        <h1>Quem nós somos?</h1>
        <p>
         Somos os <span style="color:red">ARQUIVANDER´S</span> , apaixonados por histórias, conhecimento e a magia que os livros proporcionam.
         Nossa missão é levar a literatura até você, tornando a leitura acessível, prática e envolvente.
         Acreditamos que um bom livro tem o poder de transformar momentos, inspirar ideias e abrir portas para novos mundos.
        </p>
        <p>
            Aqui, você encontra um vasto acervo de títulos, dos mais variados autores, tudo ao alcance de um clique. 
            Criamos um espaço onde leitores de todos os estilos podem explorar, descobrir e se apaixonar por novas leituras.
        </p>
        <p>
            Seja bem-vindo ao futuro da leitura online. Conecte-se, explore e mergulhe nas páginas da sua próxima grande história.
        </p>
    </div>
</body>
</html>