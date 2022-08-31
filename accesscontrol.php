<?php



if (!isset($_SESSION['TISA_TOKEN']) || empty($_SESSION['TISA_TOKEN']) || !isset($_SESSION['TISA_USERNAME']) || empty($_SESSION['TISA_USERNAME'])){
    header("Location:login.php");
    //echo $_SESSION['TISA_TOKEN']." - ".$_SESSION['TISA_USERNAME'];
   
}



?>