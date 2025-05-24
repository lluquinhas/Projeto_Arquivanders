<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arquivander´s - Livraria Online</title>
    <style>
        /* Reset básico */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Corpo */
body {
    background-color:#FDF5E4;
}

/* Navegação */
header nav {
    background-color: #2C3E49;
    height: 60px;
    display: flex;
    align-items: center;
    padding: 10px 20px;
}

nav ul {
    list-style: none;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 120px;
}

nav ul li {
    margin: 5px 10px;
}

nav ul li a {
    color: white;
    text-decoration: none;
    font-weight: bold;
    padding: 8px 12px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

nav ul li.logo img {
   height: 250px; /* Ajuste do tamanho da logo */
    width: auto;
    display: flex; /* Evita que afete o fluxo do layout */
    object-fit: contain; /* Mantém proporção */
    justify-content: center;
    
}

nav ul li.user span {
    color: white;
    font-size: 16px;
    font-weight: 500;
}

/* Seção de boas-vindas */
main {
    display: flex;
    flex-direction: row;
    align-items: center;
    padding: 40px 20px;
    gap: 40px;
}

.welcome {
    padding: 30px;
    border-radius: 12px;
    max-width: 700px;
    text-align: center;
}

.welcome h1 {
    font-size: 32px;
    color: #2C3E49;
    margin-bottom: 20px;
}

.welcome p {
    font-size: 18px;
    margin-bottom: 25px;
}

.welcome a button {
    background-color:rgb(241, 150, 45);
    color: white;
    padding: 12px 25px;
    border: none;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.welcome a button:hover {
    background-color: rgb(196, 182, 154);
}

/* Imagem principal */
.imagemPrincipal img {
    max-width: 100%;
    height: auto;
    border-radius: 12px;
}

/* Responsividade */
@media (max-width: 768px) {
    nav ul {
        flex-direction: column;
        align-items: flex-start;
    }

    .welcome h1 {
        font-size: 26px;
    }

    .welcome p {
        font-size: 16px;
    }
}

        </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="../quemSomos/quem_somos.php">Quem somos?</a></li>
                <li><a href="../publique/publique.php">Nos envie seu livro!</a></li>
                <li class="logo"><img src="../imagens/Logo.png" alt="Arquivander´s"></li>
                <li class="user"><span> Olá, seja bem-vindo(a) </span></li>
                <li><a href="../login/login.php">Conecte-se</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="welcome">
            <div clas="text">
                <h1>Que tal conhecer um novo universo hoje?</h1>
                <p>Conheça nossa vasta coleção de livros e mergulhe no mundo da literatura no conforto da sua casa.</p>
                <a href="../Cadastro/cadastro.php"><button>Cadastre-se</button></a>
                <a href="../index/index.php"><button>Livros</button></a>
            </div>
        </section>
        <div class="imagemPrincipal">
            <img src="../imagens/Principal.png">
        </div>
    </main>
</body>
</html>