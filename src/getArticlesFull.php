<?php 
    header("Content-Type: application/json");
    include "connectionArticles.php";

    $query = "SELECT * FROM `articlee` WHERE 1";

    $resultado = mysqli_query($conexao, $query);
    
    $linha = mysqli_fetch_assoc($resultado);

    echo json_encode($linha['image']);

    // while($ROW = mysqli_fetch_assoc($resultado))
    // {
    //     $_HTMLRESULTS[] = htmlspecialchars_decode($ROW['html']);
    //     $_IMAGERESULTS[] = base64_decode($ROW['image']);
    // }

    // echo json_encode($_HTMLRESULTS);
    mysqli_close($conexao);
?>