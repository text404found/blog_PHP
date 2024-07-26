<?php
include 'connectionArticles.php';


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $_UPDATED_ARTICLE = $_POST['articleId'];
    $_HTML_TO_SEND = htmlspecialchars($_POST['html']);

    $query = "UPDATE `articlee` SET `html`='$_HTML_TO_SEND' WHERE id = $_UPDATED_ARTICLE";

    $resultado = mysqli_query($conexao, $query);

    mysqli_close($conexao);

    echo "sucess";
    exit;
}

?>