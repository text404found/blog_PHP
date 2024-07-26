<?php
include '../connectionArticles.php';
session_start();
if (!isset($_SESSION["user-id"])) {
    header('Location: http://localhost/src/views/loginView.php');
    exit;
}

if (!isset($_GET['id'])) {
    echo 'Link Nao Existe';
    exit;
}

$_ID = $_GET['id'];

$query = "SELECT * FROM `articlee` WHERE id = $_ID";
$queryGetComments = "SELECT * FROM `comments` WHERE articleId = $_ID";

$resultado = mysqli_query($conexao, $query);
$getCommentsResult = mysqli_query($conexao, $queryGetComments);

$linha = mysqli_fetch_assoc($resultado);

if (!isset($linha['html'])) {
    echo 'Pagina nao existe';
    header('Location: http://localhost/src/views/articlesView.php');
}

$_POSTED_LIKED = false;

$_IS_EDITING = false;

?>

<!DOCTYPE html>
<html lang="en">

<style>
    <?php require_once ("C:/xampp/htdocs/public/css/mainFullArticle.css") ?>
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artigos Page</title>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <div class="accountDetail">
        <div class="fotoIcon"></div>
        <div class="name">
            <h3 id="name">Por: <?php echo $linha['por'] ?></h3>
            <h4>Likes: <?php echo $linha['likes'] ?></h4>
            <button class="addLike">Dar like</button>
            <?php
            if ($linha['por'] == $_SESSION['user-name']) {

                echo
                    '
                 <button class="articleEditBtn">Editar</button>
                 <button class="sendChangesBtn">enviar</button>
                 <button class="deleteArticle">deletar</button>
                 ';

            } else {

            }
            ?>

        </div>
    </div>

    <div class="article_comments">
        <div class="articles">
            <div id="editor"></div>
            <?php
            echo htmlspecialchars_decode($linha['html']);
            ?>
        </div>
        <div class="comments">
            <input class="inputCommentValue" type="text" placeholder="comentar">
            <button class="sendCommentBtn">Enviar Comentario</button>
            <?php

            while ($row = mysqli_fetch_assoc($getCommentsResult)) {
                $content = $row['commentValue'];
                $commentBy = $row['por'];
                $likes = $row['likes'];
                $commentId = $row['id'];

                if ($commentBy === $_SESSION['user-name']) {
                    echo
                        "
                    <div class='comment' id='$commentId'>
                        <button class='deleteCommentBtn'>Deletar Comentario</button>
                        <h1>Por: $commentBy</h1>
                        <h2>Likes: $likes</h2>
                        <h3>Conteudo: </h3>
                        <p>$content</p>
                    </div>
                    ";
                } else {
                    echo
                        "
                    <div class='comment' id='$commentId'>
                        <h1>Por: $commentBy</h1>
                        <h2>Likes: $likes</h2>
                        <h3>Conteudo: </h3>
                        <p>$content</p>
                    </div>
                    ";
                }
                ;
            }
            ;

            ?>
        </div>
    </div>



    <script>
        const socket = new WebSocket("ws:localhost:8080/chat");
        const sendComment = document.querySelector('.sendCommentBtn');
        const inputComment = document.querySelector('.inputCommentValue');
        const deleteCommentBtn = document.querySelectorAll('.deleteCommentBtn');

        deleteCommentBtn?.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                const commentId = e.target.parentElement.attributes.id.value;
                $.post('http://localhost/src/deleteComment.php', {id: commentId}, (res) => {
                    console.log(res);
                })
            })
        })

        sendComment.addEventListener('click', (e) => {
            const inputValue = inputComment.value;
            if (inputValue.length > 0) {
                $.post('http://localhost/src/createComment.php', { content: inputValue, articleId: <?php echo $_ID ?> }, (res) => {
                    console.log(res)
                    socket.send('new comment');
                });
            }
        })

        socket.addEventListener("open", (e) => {
            console.log("Conectado com webscoket");
        });

        socket.addEventListener("message", (event) => {
            console.log(event.data);
            if (event.data == "reload") {
                location.reload();
            }
        });

        const quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ header: [1, 2, false] }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block'],
                ],
            },
        });
        <?php require_once ("C:/xampp\htdocs/public/js/jquery-3.7.1.min.js") ?>

        const btnLike = document.querySelector('.addLike');
        const btnEdit = document.querySelector('.articleEditBtn');
        const sendChangeBtn = document.querySelector('.sendChangesBtn');
        const article = document.querySelector('.articles');
        const deleteArticleBtn = document.querySelector('.deleteArticle');

        const editorTools = document.querySelector('.ql-toolbar');
        const editor = document.querySelector('#editor');
        const htmlEditor = document.querySelector('.ql-editor');

        deleteArticleBtn?.addEventListener('click', () => {
            $.post('http://localhost/src/deleteArticle.php', { articleId: <?php echo $_ID ?> }, (res) => {
                console.log(res);
                socket.send("new article");
                console.log("Mensagem Enviada");
            })
        })

        const clickEvent = () => {
            editor.style.display = 'block';
            editorTools.style.display = 'block';
            htmlEditor.innerHTML = article.innerHTML;


            const clickSendEvent = () => {
                editor.style.display = 'none';
                editorTools.style.display = 'none';
                sendChangeBtn.removeEventListener('click', clickSendEvent);
                $_HTMLCOD = quill.getSemanticHTML();

                $.post('http://localhost/src/editArticle.php', { articleId: <?php echo $_ID ?>, html: $_HTMLCOD }, (res) => {
                    console.log(res);

                    if (res = 'sucess') {
                        socket.send("new article");
                        console.log("Mensagem Enviada");
                    }
                })
            }

            sendChangeBtn.addEventListener('click', clickSendEvent);
        }

        $.post('http://localhost/src/isLiked.php', { articleId: <?php echo $_ID ?>, likedBy: <?php echo $_SESSION['user-id'] ?> }, (res) => {
            if (res == 'Voce ja curtiu') {
                btnLike.style.backgroundColor = "Red";
            }
        })


        btnLike.addEventListener('click', (e) => {
            $.post('http://localhost/src/addlike.php', { articleId: <?php echo $_ID ?>, likedBy: <?php echo $_SESSION['user-id'] ?> }, (res) => {
                console.log(res);
                socket.send("new article");
                console.log("Mensagem Enviada");
            })
        })

        btnEdit?.addEventListener('click', clickEvent);

    </script>
</body>

</html>