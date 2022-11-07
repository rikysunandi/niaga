<?php ob_start()?>
<?php session_start() ?>
<?php if(empty($_SESSION['username'])): ?>
    <?php header("location: login.php"); ?>
<?php endif; ?>
