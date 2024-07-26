<?php
include "connectionArticles.php";
session_start();

if (isset($_SESSION['user-id'])) {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $_HTML = htmlspecialchars($_POST['html']);

        $queryGetLastId = "select * from articlee ORDER BY id DESC LIMIT 1";

        $resultadoLastId = mysqli_query($conexao, $queryGetLastId);

        $linha = mysqli_fetch_assoc($resultadoLastId);

        if (!isset($linha['id'])) {
            $_nextId = 1;
        } else {
            $_nextId = $linha['id'] + 1;
        }

        $_NAME = $_SESSION['user-name'];
        $_SESSION['state'] = 'reload';

        $query = "INSERT INTO `articlee`(`id`, `html`, `por`, `likes`) VALUES ('$_nextId','$_HTML','$_NAME','0')";
        
        // foreach ($_POST['image'] as $key => $value) {
        //     $queryImages = "INSERT INTO `images`(`id`, `src`) VALUES ('$_nextId','$value')";
        //     $resultado = mysqli_query($conexao, $queryImages);
        // }

        $resultado = mysqli_query($conexao, $query);

        mysqli_close($conexao);


        echo json_encode($_HTML);

        exit;
    }
} else {
    exit;
}

?>