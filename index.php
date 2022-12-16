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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proyecto TISA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

<div class="intro-container">
    <div class="carousel-container">
        <div id="carruselInicio" class="carousel slide carousel-fade" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php
                $contador = 0;
                $carpeta = dir('./imgcarrousel');
                while (($archivoimg = $carpeta->read()) !== false) 
                {
                    //echo $archivoimg;
                    if ($archivoimg != "." && $archivoimg != "..") { ?>
                        <li data-target="#carruselInicio" data-slide-to="<?php echo $contador; ?>" class="<?php if ($contador == 0) {
                            echo 'active';
                        } ?>">
                        </li>
                    <?php 
                    } 
                    $contador++;
                } ?>
            </ol>

            <div class="carousel-inner" role="listbox">
                <?php $contador = 0;
               
                $carpeta = dir('./imgcarrousel');
                while (($archivoimg = $carpeta->read()) !== false)
                {
                    if ($archivoimg != "." && $archivoimg != "..") 
                    {  
                       // echo "./imgcarrousel/" . $archivoimg . $contador;
                        ?>

                        <div class="carousel-item <?php if ($contador == 0) {
                                                        echo ' active';
                                                    } ?>">
                            <div class="carousel-container">
                                <div class="carousel-content">
                                    <img class="d-block w-100 mx-auto" src="<?php echo "./imgcarrousel/" . $archivoimg; ?>" alt="">
                                </div>
                            </div>
                        </div>
                <?php $contador++;}
                    
                } ?>
            </div>
            <a class="carousel-control-prev" href="#carruselInicio" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon ion-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>

            <a class="carousel-control-next" href="#carruselInicio" role="button" data-slide="next">
                <span class="carousel-control-next-icon ion-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>
    </div>
</div>
</body></html>

<?php } ?>
<?php include_once FOOTER_FILE; ?>