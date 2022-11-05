<?php

require_once("accesscontrol.php");

$ErrorMsg = "";
try{
        $oApi = new API();
        $comprobantes = $oApi->getComprobanteAll();            
}catch (Exception $e){
        $ErrorMsg =  $e->getMessage();
}

try{
        $oApi = new API();
        $comprobantesTipo = $oApi->getComprobanteTipo();            
}catch (Exception $e){
        $ErrorMsg =  $e->getMessage();
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
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Registro de Comprobantes</h1>
                    <p class="mb-4"> </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Comprobantes registrados </h6>
                            <a href="index.php?seccion=comprobante/edt_comprobante.php&id=0">
                                                <button class="btn btn-primary" type="button" >+ crear</button></td> 
                                                </a>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tipo Comprobante</th>
                                            <th>Fecha</th>
                                            <th>Fecha Ingreso</th>
                                            <th>Nro. Comprobante</th>
                                            <th>ID Proveedor</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tipo Comprobante</th>
                                            <th>Fecha</th>
                                            <th>Fecha Ingreso</th>
                                            <th>Nro. Comprobante</th>
                                            <th>ID Proveedor</th>
                                            <th>Acciones</th>                         
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php foreach($comprobantes as $comprobante){?>
                                        <tr>
                                            <td><?php echo $comprobante->id_comprobante;?></td>
                                                <td><?php foreach($comprobantesTipo as $Tipocomprobante){
                                                    if($Tipocomprobante->id_comprobante_tipo == $comprobante->id_comprobante_tipo){
                                                        echo $Tipocomprobante->comprobante_tipo;
                                                        break;
                                                    }
                                            }{?></td>
                                            <?php }?>
                                            <td><?php echo $comprobante->fecha;?></td>
                                            <td><?php echo $comprobante->fecha_ingreso;?></td>
                                            <td><?php echo $comprobante->nro_comprobante;?></td> 
                                            <td><?php echo $comprobante->id_proveedor;?></td> 
                                            <td>
                                                <a href="index.php?seccion=comprobante/edt_comprobante.php&id=<?php echo $comprobante->id_comprobante;?>">
                                                    <button class="btn btn-primary" type="button" >editar</button>
                                                </a>
                                                <a href="index.php?seccion=comprobante/comprobante_save.php&id_comprobante=<?php echo $comprobante->id_comprobante;?>">
                                                <button class="btn btn-danger" type="button" ><img src="img/trash.png"/></button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php }?>                                     
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
<?php }?> 
