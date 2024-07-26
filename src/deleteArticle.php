<?php
include 'connectionArticles.php';


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $_ARTICLE_TO_DELETE = $_POST['articleId'];

    $query = "DELETE FROM `articlee` WHERE id = $_ARTICLE_TO_DELETE";
    $queryDeleteLiked = "DELETE FROM `likedby` WHERE postID = $_ARTICLE_TO_DELETE";
    $queryDeleteComments = "DELETE FROM `comments` WHERE articleId = $_ARTICLE_TO_DELETE";

    $resultado = mysqli_query($conexao, $query);
    $commentsResult = mysqli_query( $conexao, $queryDeleteComments);

    $resultDelete = mysqli_query($conexao, $queryDeleteLiked);

    mysqli_close($conexao);

    exit;
}

?>