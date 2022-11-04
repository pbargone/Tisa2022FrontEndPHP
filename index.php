<?php
session_start();
require_once("config/constantes.php");
require_once("accesscontrol.php");
require_once("clases/API.class.php");
?>
<?php include_once HEADER_FILE; 
if (isset($_GET['seccion'])){
	include_once $_GET['seccion'];
}else{
?>
<h1>Laboratorio forbenthon</h1>

<?php } ?>
<?php include_once FOOTER_FILE; ?>