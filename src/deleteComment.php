<?php
include 'connectionArticles.php';


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $_COMMENT_TO_DELETE = $_POST['id'];

    $query = "DELETE FROM `comments` WHERE id = $_COMMENT_TO_DELETE";

    $resultado = mysqli_query($conexao, $query);

    mysqli_close($conexao);

    exit;
}

?>