<?php

require_once("accesscontrol.php");
$ErrorMsg = "";
try{
        $oApi = new API();
        $productos = $oApi->getProductosAll(); 
        $rubros = $oApi->getRubrosAll();           
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
                    <h5 class="modal-title" id="exampleModalLabel">Mensaje</h5>
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

<style>
 p { color: red; }
 g { color: green; }
</style>
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./index.php">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Administración de productos</li>
    </ol>
</nav>
                    
                    <h1 class="h3 mb-2 text-gray-800">Administración de productos</h1>
                    <p class="mb-4"> </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">

                            <h6 class="m-0 font-weight-bold text-primary">Productos registrados 
                            
                            <a class="btn btn-outline-primary" href="index.php?seccion=producto/edt_producto.php&id=0"
                            data-toggle="tooltip" data-placement="bottom" title=" Registrar nuevo producto ">
                            <i class="fas fa-box-open"></i>
                                </a>                    
                            </h6> 
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                               
                               <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"/>
                                <script src="//code.jquery.com/jquery-1.12.4.js"></script>
                                <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

                                <table class="table table-bordered" id="dataTable5" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Codigo</th>
                                            <th>Producto</th>
                                            <th>Detalle</th>
                                            <th>Rubro</th>
                                            <th>Estado</th> 
                                            <th>Acciones</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Codigo</th>
                                            <th>Producto</th>
                                            <th>Detalle</th> 
                                            <th>Rubro</th> 
                                            <th>Estado</th> 
                                            <th>Acciones</th>                          
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php foreach($productos as $producto){ ?>
                                        <tr>
                                            <td><?php echo $producto->id_producto;?></td>
                                            <td><?php echo $producto->codigo_producto;?></td>
                                            <td><?php echo $producto->producto;?></td>
                                            <td><?php echo $producto->detalle;?></td>

                                            <td><?php foreach($rubros as $rubro){if($producto->id_rubro==$rubro->id_rubro)echo $rubro->rubro;}?></td>

                                            
                                            <td><g><?php if($producto->activo == '1') {    echo "Habilitado";}?></g>
                                                 <p><?php if($producto->activo == '0'){echo "Inhabilitado";}?></p></td>

                                                 
                                            <td>


                                               <div class=btn-group>
                                                
                                                
                                                <a class="btn btn-outline-success" href="index.php?seccion=producto/edt_producto.php&id=<?php echo $producto->id_producto;?>"
                                                data-toggle="tooltip" data-placement="bottom" title=" Editar producto ">
                                                <i class="fas fa-pencil-alt"> </i>
                                                </a>
                                                
                                                
                                               <a <?php if($producto->activo == '1') {?> class="btn btn-outline-danger" title=" Dar de baja producto " <?php }else{?> class="btn btn-outline-success" <?php }?> href="" data-toggle="modal" data-toggle="tooltip"
                                                data-placement="bottom" title=" Dar de alta producto " data-target="#ModalEditar<?php echo $producto->id_producto;?>">

                                                <?php if($producto->activo == '1') {?> <i class="fas fa-trash-alt"> </i><?php }?>

                                                <?php if($producto->activo == '0') {?><i class="fas fa-box"></i><?php }?>
                                                </a>
                                              

                                                </div>
                                            </td> 
                                        </tr>  

                                        <!-- Modal Borrar -->
                            <div class="modal fade" id="ModalEditar<?php echo $producto->id_producto;?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <?php if($producto->activo == '1') {?> <h4 class="modal-title">¿Esta seguro de querer dar de baja al producto <b><?php echo $producto->producto;?></b>? </h4><?php }?>
                                        <?php if($producto->activo == '0') {?> <h4 class="modal-title">¿Esta seguro de querer dar de alta al producto <b><?php echo $producto->producto;?></b>?</h4><?php }?>
                                            

                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="index.php?seccion=producto/producto_save.php&id_producto=<?php echo $producto->id_producto;?>&activo=<?php echo $producto->activo;?>" autocomplete="off" enctype="multipart/form-data">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light btn-lg" data-dismiss="modal">Cerrar</button>

                                                    <?php if($producto->activo == '1') {?><button type="submit" class="btn btn-outline-danger btn-lg"><i class="fas fa-trash-alt"></i> Dar de baja producto</button><?php }?>

                                                    <?php if($producto->activo == '0') {?><button type="submit" class="btn btn-outline-success btn-lg"><i class="fas fa-box"></i> Dar de alta producto</button><?php }?>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                                    <?php }?>                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

<?php } 
include_once FOOTER_FILE;?>

<script>$(document).ready(function() {
  $('#dataTable5').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
  });

});</script>
