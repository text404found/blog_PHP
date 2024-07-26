<?php 
    header("Content-Type: application/json");
    include "connectionArticles.php";

    $query = "SELECT * FROM `articlee` WHERE 1";
    

    $resultado = mysqli_query($conexao, $query);
    
    $_HTMLRESULTS = array();
    $_LIKESRESULTS = array();
    $_PORRESULTS = array();

    while($ROW = mysqli_fetch_assoc($resultado))
    {
       
        $_HTMLRESULTS[] = [$ROW['id'],htmlspecialchars_decode($ROW['html'])];
        $_LIKESRESULTS[] = [$ROW['id'],htmlspecialchars_decode($ROW['likes'])];
        $_PORRESULTS[] = [$ROW['id'],htmlspecialchars_decode($ROW['por'])];
    }

    $_RESULTS = [
        $_HTMLRESULTS,
        $_LIKESRESULTS,
        $_PORRESULTS,
    ];

    echo json_encode($_RESULTS);

    mysqli_close($conexao);
?>