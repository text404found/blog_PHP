<?php
session_start();
if (!isset($_SESSION["user-id"])) {
    header('Location: http://localhost/src/views/loginView.php');
    exit;
}

include 'C:\xampp\htdocs\public\index.html';
?>

<script>
    <?php require_once ("C:/xampp\htdocs/public/js/jquery-3.7.1.min.js") ?>
    <?php require_once ("C:/xampp/htdocs/public/js/index.js") ?>
</script>

<style>
    <?php require_once ("C:/xampp/htdocs/public/css/main.css") ?>
</style>