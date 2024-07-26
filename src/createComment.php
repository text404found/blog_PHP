<?php 
    include 'connectionArticles.php';
    session_start();
    if($_SERVER['REQUEST_METHOD'] === "POST")
    {
        $_ARTICLEID = $_POST['articleId'];
        $_CONTENT = $_POST['content'];
        $_USERNAME = $_SESSION['user-name'];

        $query = "SELECT * FROM comments ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($conexao, $query);

        $linha = mysqli_fetch_assoc($result);

        $nextId;

        if(isset($linha["id"]))
        {
            $nextId = $linha["id"] + 1;
        }
        else
        {
            $nextId = 1;
        }

        $queryCreateComment = "INSERT INTO `comments`(`id`, `articleId`, `commentValue`, `por`, `likes`) VALUES ('$nextId','$_ARTICLEID','$_CONTENT','$_USERNAME','0')";

        $resultCreateComment = mysqli_query($conexao, $queryCreateComment);
        
        echo "Criado";

        exit;
    }
?>