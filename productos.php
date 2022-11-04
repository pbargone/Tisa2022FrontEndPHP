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
                            data-toggle="tooltip" data-placement="bottom" title=" Crear producto ">
                            <i class="fas fa-box-open"></i>
                                </a>                    
                            </h6> 
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Codigo</th>
                                            <th>Producto</th>
                                            <th>Detalle</th>
                                            <th>Rubro</th>
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

                                            <td>

                                               <div class=btn-group>
                                                
                                                
                                                <a class="btn btn-outline-success" href="index.php?seccion=producto/edt_producto.php&id=<?php echo $producto->id_producto;?>"
                                                data-toggle="tooltip" data-placement="bottom" title=" Editar producto ">
                                                <i class="fas fa-pencil-alt"> </i>
                                                </a>
                                                
                                                
                                                <a class="btn btn-outline-danger" href="" data-toggle="modal" data-toggle="tooltip"
                                                data-placement="bottom" title=" Dar de baja producto " data-target="#ModalEditar<?php echo $producto->id_producto;?>">
                                                <i class="fas fa-trash-alt"> </i>
                                                </a>
                                                </div>
                                            </td> 
                                        </tr>  

                                        <!-- Modal Borrar -->
                            <div class="modal fade" id="ModalEditar<?php echo $producto->id_producto; ?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">¿Esta seguro que quiere dar de baja el producto?</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="index.php?seccion=producto/producto_save.php&id_producto=<?php echo $producto->id_producto;?>" autocomplete="off" enctype="multipart/form-data">

                                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light btn-lg" data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-outline-danger btn-lg"><i class="fas fa-trash-alt mr-2"></i>Dar de baja</button>
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

<script>
    $('#dataTable').DataTable({
        "language": {
            "url": "lenguaje.json"
        }
    });
</script>