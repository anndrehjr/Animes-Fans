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
    $mensagem = "Você foi cadastrado com sucesso!";
    $tipo_mensagem = "sucesso"; // Define o tipo de mensagem como sucesso
} else {
    $mensagem = "Erro ao salvar dados: " . $stmt->error;
    $tipo_mensagem = "erro"; // Define o tipo de mensagem como erro
}

// Fechar a declaração e a conexão
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do Cadastro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center; /* Centraliza horizontalmente */
            align-items: center; /* Centraliza verticalmente */
            background: linear-gradient(to right, rgba(255, 103, 102, 0.8), rgba(255, 255, 255, 0.8));
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showAlert() {
            Swal.fire({
                title: '<?php echo $tipo_mensagem == "sucesso" ? "Sucesso!" : "Erro!" ?>',
                text: "<?php echo $mensagem; ?>",
                icon: '<?php echo $tipo_mensagem == "sucesso" ? "success" : "error"; ?>',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redireciona para index.php
                    window.location.href = "formulario.html";
                }
            });
        }
    </script>
</head>
<body onload="showAlert()">
</body>
</html>
