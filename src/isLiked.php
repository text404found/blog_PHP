<?php
include 'connectionArticles.php';


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $_ID_ARTICLE = $_POST['articleId'];
    $_USER_ID = $_POST['likedBy'];

    $query = "SELECT * FROM `likedby` WHERE postID = $_ID_ARTICLE";

    $resultado = mysqli_query($conexao, $query);

    while ($row = mysqli_fetch_assoc($resultado)) {
        if ($row['userID'] == $_POST['likedBy']) {
            echo "Voce ja curtiu";
            exit;
        } else {}
    }

    mysqli_close($conexao);
    exit;
}

?>