<?php
// visualizar_dados.php

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

// Consultar dados
$sql = "SELECT * FROM cadastro";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Saída dos dados de cada linha
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"]. " - Nome: " . $row["nome"]. " - Sobrenome: " . $row["sobrenome"]. " - Email: " . $row["email"]. "<br>";
    }
} else {
    echo "0 resultados";
}

$conn->close();
?>
