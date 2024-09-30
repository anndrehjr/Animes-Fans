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

$stmt->execute();

echo "Novo registro criado com sucesso";

$stmt->close();
$conn->close();
?>
