<?php

require_once("accesscontrol.php");


$Msg = "Datos guardados correctamente";
try{
        
        // valido lo recibido del form
        if (isset($_POST["id_producto"])){
            $jsonproducto = '{
                                "id_producto": '.$_POST["id_producto"].',
                                "codigo_producto": "'.$_POST["codigo_producto"].'",
                                "producto": "'.$_POST["producto"].'",
                                "detalle": "'.$_POST["detalle"].'",

                            }';

            $oApi = new API();
            if (empty($_POST["id_producto"])){
                $oApi->crearproducto($jsonproducto); 
            }else{
                $oApi->actualizarproducto($jsonproducto); 
            }   
        }else{
            if (isset($_GET["id_producto"])){
                $oApi = new API();
                $oApi->borrarproducto($_GET["id_producto"]); 
                $Msg = "El producto se eliminó correctamente";
            }else{
                $Msg = "Faltan datos para completar la operación";
            }
        }        
    }catch (Exception $e){
        $Msg =  $e->getMessage();
    }

?>


    <!-- error Modal-->    
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script>
              $(document).ready(function()
              {         
                 $("#myModal").modal("show");
              });
    </script>
    
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Error de carga de datos</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"><?php if (!empty($Msg)){echo $Msg;} ?></div>
                <div class="modal-footer">
                    <a href="index.php?seccion=productos.php">
                    <button class="btn btn-primary" type="button" >OK</button> 
                    </a>                   
                </div>
            </div>
        </div>
    </div>
    <!-- fin error Modal-->



