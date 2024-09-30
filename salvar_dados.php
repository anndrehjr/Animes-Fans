<?php
// salvar_dados.php

// Conexão com o banco de dados
$servername = "localhost";
$username = "root"; // Usuário padrão do XAMPP
$password = ""; // Deixe vazio se não tiver senha
$dbname = "anime_fans"; // Nome do banco de dados

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Preparar e vincular
$stmt = $conn->prepare("INSERT INTO cadastro (nome, sobrenome, email, genero, status, animes_favoritos, comentario) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $nome, $sobrenome, $email, $genero, $status, $animes_favoritos, $comentario);

// Definir parâmetros e executar
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$genero = $_POST['genero'];
$status = $_POST['status'];

// Verificando quais animes favoritos foram selecionados
$animes_favoritos = [];
if (isset($_POST['anime1'])) $animes_favoritos[] = $_POST['anime1'];
if (isset($_POST['anime2'])) $animes_favoritos[] = $_POST['anime2'];
if (isset($_POST['anime3'])) $animes_favoritos[] = $_POST['anime3'];
if (isset($_POST['anime4'])) $animes_favoritos[] = $_POST['anime4'];
if (isset($_POST['anime5'])) $animes_favoritos[] = $_POST['anime5'];
if (isset($_POST['anime6'])) $animes_favoritos[] = $_POST['anime6'];
if (isset($_POST['anime7'])) $animes_favoritos[] = $_POST['anime7'];

// Converter array para string
$animes_favoritos = implode(", ", $animes_favoritos);
$comentario = $_POST['comentario'];

// Executar a inserção
if ($stmt->execute()) {
    // Se a inserção foi bem-sucedida, exibe a página de agradecimento
    echo '
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Tela de Agradecimento</title>
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <div class="container">
            <h1 class="title">Obrigado pelo seu cadastro!</h1>
            <p class="message">Seus dados foram salvos com sucesso.</p>
            <button class="back-button" onclick="goBack()">Voltar para o Início</button>
        </div>

        <div id="alert" class="alert">
            <p>Cadastro realizado com sucesso!</p>
            <button class="close-alert" onclick="closeAlert()">Fechar</button>
        </div>

        <script>
            // Função para voltar à página inicial
            function goBack() {
                window.history.back();
            }

            // Função para fechar o alerta
            function closeAlert() {
                document.getElementById("alert").style.display = "none";
            }
        </script>
    </body>
    </html>';
} else {
    echo "Erro ao salvar dados: " . $stmt->error;
}

// Fechar a declaração e a conexão
$stmt->close();
$conn->close();
?>
