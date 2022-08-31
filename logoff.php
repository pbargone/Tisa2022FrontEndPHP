<?php
    session_start();
    $_SESSION['TISA_TOKEN'] = '';
    $_SESSION['TISA_USERNAME'] = '';
    header("Location:login.php");
?>