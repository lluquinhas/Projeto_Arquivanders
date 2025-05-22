<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publique na nossa plataforma</title>
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
    display: flex;
    justify-content: flex-start;
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

/* Texto de apresentação */
.texto {
    max-width: 700px;
    margin: 30px auto;
    text-align: center;
    padding: 20px;
}

.texto h1 {
    font-size: 32px;
    margin-bottom: 20px;
    color: #222;
}

.texto p {
    font-size: 18px;
    line-height: 1.6;
    margin-bottom: 15px;
}

.texto .divulgacao {
    font-weight: bold;
    color: #007BFF;
    font-size: 20px;
    margin-top: 30px;
}

/* Imagens */
.imagens {
    display: flex;
    justify-content: center;
    align-items: flex-end;
    gap: 40px;
    margin-top: 40px;
    flex-wrap: wrap;
}

img.logo {
    width: 200px;
    height: auto;
}

img.pessoaSentada {
    width: 250px;
    height: auto;
}

        </style>
</head>
<body>
    <header>
        <a href="../tela_inicial/tela_inicial.php"><button>Voltar</button></a>
    </header>

    <div class="texto" >
        <h1>Publique na nossa plataforma</h1>
        <p>Você é escritor e quer que sua obra chegue a mais leitores? Na <span style="color: aquamarine;"> ARQUIVANDER´S</span> você tem um espaço
        dedicado para autores independentes divulgarem e compartilharem suas histórias com o mundo! </p>
        <p> Seja um romance, fantasia, mistério ou qualquer outro gênero, queremos ajudar sua voz a ser ouvida. </p>

        <p> Entre em contato agora e faça parte dessa jornada literária. </p>

        <p class="divulgacao">Nosso contato: arquivanders@gmail.com</p>
    </div>
    <div class="imagens">
    <img class="logo" src="../imagens/11.png">
    <img class="pessoaSentada" src="../imagens/3.png">
</div>

</body>
</html>