<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/config/constantes.php");
require $_SERVER['DOCUMENT_ROOT'].'/clases/API.class.php';
include_once $$_SERVER['DOCUMENT_ROOT'].HEADER_FILE;
$ErrorMsg = "";
if(isset($GET["id"])){
try{
        $oApi = new API();
        $empleados = $oApi->getEmpleadoById();            
    }catch (Exception $e){
        $ErrorMsg =  $e->getMessage();
    }
}else{
    $ErrorMsg = "Falta el parámetro id_empleado";
}

?>

<?php if (!empty($ErrorMsg )) { ?>
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
                    <h5 class="modal-title" id="exampleModalLabel">Error de cargando datos</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"><?php if (!empty($ErrorMsg)){echo $ErrorMsg;} ?></div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">OK</button>                    
                </div>
            </div>
        </div>
    </div>
    <!-- fin error Modal-->
<?php } ?>    
<!-- Begin Page Content -->
<?php if(empty($ErrorMsg)) { ?>
              
                <!-- /.acá poner el form yu cargarle los valores -->

<?php } 
include_once $_SERVER['DOCUMENT_ROOT'].FOOTER_FILE;?>