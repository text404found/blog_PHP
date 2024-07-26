<?php 
header("Content-Type: application/json");
include "../connection.php";


if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $_name = $_POST["nome"];
    $_email = $_POST["email"];
    $_password = $_POST["senha"];

    $query = "SELECT * FROM user";

    $resultado = mysqli_query($conexao, $query);

    if(strlen($_name) > 10)
    {
        echo json_encode("Nome muito grande");
        exit();
    }elseif (strlen($_password) < 8) {
        echo json_encode("Senha muito pequena");
        exit;
    }

    while($row = mysqli_fetch_assoc($resultado))
    {
        if($_email == $row["email"])
        {
            echo "email ja sendo usado";
            exit;
        }
    }

    $passHash = password_hash($_password, PASSWORD_DEFAULT);

    $queryGetLastId = "select * from user ORDER BY id DESC LIMIT 1";

    $resultadoLastId = mysqli_query($conexao, $queryGetLastId);

    $linha = mysqli_fetch_assoc($resultadoLastId);

    $_nextId = $linha['id'] + 1;

    echo $_nextId;

    $queryCreate = "INSERT INTO `user`(`id`, `name`, `email`, `pass`) VALUES ('$_nextId','$_name','$_email','$passHash')";
    $resultadoCreate = mysqli_query($conexao, $queryCreate);

}