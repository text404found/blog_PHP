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

    $queryGetLike = "SELECT likes FROM `articlee` WHERE id = $_ID_ARTICLE";

    $result = mysqli_query($conexao, $queryGetLike);

    $dot = mysqli_fetch_assoc($result);

    $_LIKE_TO_ADD = $dot["likes"] + 1;

    $queryAddLike = "UPDATE `articlee` SET `likes`='$_LIKE_TO_ADD' WHERE id = $_ID_ARTICLE";

    $result_ADD_LIKE = mysqli_query($conexao, $queryAddLike);

    $queryADD_LIKED_LIST = "INSERT INTO `likedby`(`postID`, `userID`) VALUES ('$_ID_ARTICLE','$_USER_ID')";

    $result_LIKED_LIST = mysqli_query($conexao, $queryADD_LIKED_LIST);
    mysqli_close($conexao);

    exit;
}

?>