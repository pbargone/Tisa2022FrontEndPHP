<?php

require_once("accesscontrol.php");



try{
        
        // valido lo recibido del form
        if (isset($_POST["id_proveedor"])){
            if(empty($_POST["cod_provincia"])){
                $_POST["cod_provincia"] = null;
            }
            $jsonProveedor = '{
                                "id_proveedor": '.$_POST["id_proveedor"].',
                                "razon_soc": "'.$_POST["razon_soc"].'",
                                "cuit": "'.$_POST["cuit"].'",
                                "calle": "'.$_POST["calle"].'",
                                "numero_calle": "'.$_POST["numero_calle"].'",
                                "localidad": "'.$_POST["localidad"].'",
                                "cod_provincia": "'.$_POST["cod_provincia"].'",
                                "telefono": "'.$_POST["telefono"].'",
                                "email": "'.$_POST["email"].'"
                                
                               
                            }';

            $oApi = new API();
            if (empty($_POST["id_proveedor"])){
                $oApi->crearProveedor($jsonProveedor); 
                $Msg = "Proveedor Creado correctamente";
            }else{
                $oApi->actualizarProveedor($jsonProveedor); 
                $Msg = "Proveedor Actualizado correctamente";
            }   
        }else{
            if (isset($_GET["id_proveedor"])){
                $oApi = new API();
                $oApi->borrarProveedor($_GET["id_proveedor"]); 
                $Msg = "El Proveedor se eliminó correctamente";
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
                    <h5 class="modal-title" id="exampleModalLabel">Proveedor</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"><?php if (!empty($Msg)){echo $Msg;} ?></div>
                <div class="modal-footer">
                    <a href="index.php?seccion=proveedores.php">
                    <button class="btn btn-primary" type="button" >OK</button> 
                    </a>                   
                </div>
            </div>
        </div>
    </div>
    <!-- fin error Modal-->



