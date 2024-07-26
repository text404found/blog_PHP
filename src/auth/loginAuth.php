<?php
header('Content-Type: application/json');
include '../connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_email = $_POST['email'];
    $_password = $_POST['senha'];

    $query = "SELECT * FROM user";
    $resultado = mysqli_query($conexao, $query);
    

    while($row = mysqli_fetch_assoc($resultado)) 
    {
        if(password_verify($_password, $row['pass']) && $_email == $row['email']) 
        {
            session_start();
            $_SESSION['user-id'] = $row['id'];
            $_SESSION['user-name'] = $row['name'];
            $_URL = 'http://localhost/src/views/articlesView.php';
            echo json_encode($_URL);

            mysqli_close($conexao);
            exit; 
            
        }
        
    }

    echo json_encode("Erro");
    mysqli_close($conexao);

}