<?php

require_once("accesscontrol.php");

$Msg = "Datos guardados correctamente";
try{
        
        // valido lo recibido del form
        if (isset($_POST["id_comprobante"])){
            echo $_POST["id_proveedor"];
            if(empty($_POST["id_proveedor"])){
                $_POST["id_proveedor"] = null;
            }
            $jsonComprobante = '{
                                "id_comprobante": '.$_POST["id_comprobante"].',
                                "id_comprobante_tipo": "'.$_POST["id_comprobante_tipo"].'",
                                "fecha": "'.$_POST["fecha"].'",
                                "nro_comprobante": "'.$_POST["nro_comprobante"].'",
                                "id_proveedor": "'.$_POST["id_proveedor"].'"
                            }';

            $oApi = new API();
            if (empty($_POST["id_comprobante"])){
                var_dump($jsonComprobante);
                $oApi->crearComprobante($jsonComprobante);
                
            } 
        }else{
            if (isset($_GET["id_comprobante"])){
                $oApi = new API();
                $oApi->borrarComprobante($_GET["id_comprobante"]); 
                $Msg = "El comprobante se eliminó correctamente";
            }else{
                $Msg = "Faltan datos para completar la operación aca";
            }
        }
        
}catch (Exception $e){
    $Msg =  $e->getMessage();
}

try{
        
    // valido lo recibido del form
    if (isset($_POST["id_stock"])){

        if(empty($_POST["iso_origen"])){
            $_POST["iso_origen"] = null;
        }
        if(empty($_POST["presentacion"])){
            $_POST["presentacion"] = null;
        }
        $jsonStock = '{
            "id_stock": '.$_POST["id_stock"].',
            "codigo_producto": "'.$_POST["codigo_producto"].'",
            "nro_lote": "'.$_POST["nro_lote"].'",
            "vencimiento": "'.$_POST["vencimiento"].'",
            "bultos": "'.$_POST["bultos"].'",
            "iso_origen": "'.$_POST["iso_origen"].'",
            "presentacion": "'.$_POST["presentacion"].'"
        }';

        $oApi = new API();
        if (empty($_POST["id_stock"])){
            $oApi->crearStock($jsonStock);
            
        }
    }else{
        if (isset($_GET["id_stock"])){
            $oApi = new API();
            $oApi->borrarComprobante($_GET["id_stock"]); 
            $Msg = "El comprobante se eliminó correctamente";
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
                    <h5 class="modal-title" id="exampleModalLabel">Error cargando datos</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"><?php if (!empty($Msg)){echo $Msg;} ?></div>
                <div class="modal-footer">
                    <a href="index.php?seccion=stock/edt_stock.php&id_comprobante=0&id_stock=0">
                    <button class="btn btn-primary" type="button" >OK</button> 
                    </a>                   
                </div>
            </div>
        </div>
    </div>
    <!-- fin error Modal-->



