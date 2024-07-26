<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'usersblog';

// Conecta ao servidor MySQL
$conexao = mysqli_connect($host, $user, $password, $database);

// Verifica se a conexão foi bem-sucedida
if (!$conexao) {
    die('Erro na conexão: ' . mysqli_connect_error());
}
?>
