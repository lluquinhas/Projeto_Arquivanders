<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>
    <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>
</head>

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
            background-color:rgb(235, 212, 176);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* Imagem da estante */
        img.estante {
            width: 470px;
            margin-bottom: -140px;
        }

        /* Estilo do formulário */
        form {
            padding: 0px 5px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            margin-bottom: 110px
        }

        /* Campos de entrada */
        form input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        form input:focus {
            border-color:rgb(170, 174, 78);
            outline: none;
        }

        /* Botão de envio */
        form button {
            width: 100%;
            padding: 12px;
            background-color:rgb(169, 130, 68);
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        form button:hover {
            background-color:rgb(136, 121, 68);
        }
    </style>

<body>
    <img class="estante" src="../imagens/estante.png">

    <form action="cadastro.php" method="POST">
        <input type="text" name="nome" placeholder="Nome completo" required><br>
        <input type="email" name="email" placeholder="E-mail" required><br>
        <input type="password" name="senha" placeholder="Crie uma senha" required><br>
        <input type="password" name="confirmar" placeholder="Confirme a senha" required><br>
        <button type="submit">Cadastrar</button>

    </form>

    <!-- PHP - CADASTRO -->

    <?php
     require_once "../conexao.php";

     if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $nome = $_POST['nome'];
         $email = $_POST['email'];
         $senha = $_POST['senha'];
         $confirmar = $_POST['confirmar'];
     
         // Verificação de senha
         if ($senha !== $confirmar) {
             echo "As senhas não coincidem.";
             exit;
         }
     
         // Usando a função password_hash para armazenamento seguro
         $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
     
         $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
         $stmt = $conn->prepare($sql); // Preparando a consulta para inserção no banco
         $stmt->bind_param("sss", $nome, $email, $senha_hash); // Indicando os tipos e valores
     
         if ($stmt->execute()) {
             echo "Cadastro realizado com sucesso!";
             header("Location: ../login/login.php");
             exit;
         } else {
             echo "Erro: " . $conn->error;
         }
     }
     ?>
</body>
</html>