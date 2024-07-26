<?php 
    include "connectionArticles.php";

    $_HTML = '<h1>Ola Mundo</h1>';

    $_HTMLCOD = htmlspecialchars($_HTML);

    $query = "INSERT INTO  articlee ( id ,  html , por , likes) VALUES ('1','$_HTMLCOD', 'NON', '10')";

    $resultado = mysqli_query($conexao, $query);

    mysqli_close($conexao);
?>