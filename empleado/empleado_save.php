<?php

require_once("accesscontrol.php");


$Msg = "Datos guardados correctamente";
try{
        
        // valido lo recibido del form
        if (isset($_POST["id_empleado"])){
            if(empty($_POST["cod_provincia"])){
                $_POST["cod_provincia"] = null;
            }
            $jsonEmpleado = '{
                                "id_empleado": '.$_POST["id_empleado"].',
                                "nombre": "'.$_POST["nombre"].'",
                                "apellido": "'.$_POST["apellido"].'",
                                "calle": "'.$_POST["calle"].'",
                                "numero_calle": "'.$_POST["numero_calle"].'",
                                "localidad": "'.$_POST["localidad"].'",
                                "cod_provincia": "'.$_POST["cod_provincia"].'",
                                "email": "'.$_POST["email"].'"
                            }';

            $oApi = new API();
            if (empty($_POST["id_empleado"])){
                $oApi->crearEmpleado($jsonEmpleado); 
                $Msg = "Empleado creado correctamente";
            }else{
                $oApi->actualizarEmpleado($jsonEmpleado); 
                $Msg = "Empleado actualizado correctamente";
            }   
        }else{
            if (isset($_GET["id_empleado"])){
                $oApi = new API();
                $oApi->borrarEmpleado($_GET["id_empleado"]); 
                $Msg = "El empleado se eliminó correctamente";
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
                    <h5 class="modal-title" id="exampleModalLabel"><?php? echo $Msg></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"><?php if (!empty($Msg)){echo $Msg;} ?></div>
                <div class="modal-footer">
                    <a href="index.php?seccion=empleados.php">
                    <button class="btn btn-primary" type="button" >OK</button> 
                    </a>                   
                </div>
            </div>
        </div>
    </div>
    <!-- fin error Modal-->



