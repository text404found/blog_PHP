<?php
session_start();
include 'C:\xampp\htdocs\public\login.html';

if (isset($_SESSION['user-id'])) {
    header("Location: http://localhost/src/views/articlesView.php");
}
?>


<script>
    <?php require_once ("C:/xampp\htdocs/public/js/jquery-3.7.1.min.js") ?>
    <?php require_once ("C:/xampp/htdocs/public/js/login.js") ?>
</script>

<style>
    <?php require_once ("C:/xampp/htdocs/public/css/form.css") ?>
</style>