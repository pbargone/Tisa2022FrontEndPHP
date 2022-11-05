<?php

require_once("accesscontrol.php");

$ErrorMsg = "";
try{
        $oApi = new API();
        $comprobantes = $oApi->getComprobanteAll();
        $comprobantesTipo = $oApi->getComprobanteTipoByStock();
        $stocks = $oApi->getStockAll();
        $stocksMovimientos = $oApi->getStockMovimientoAll();
        $proveedores = $oApi->getProveedorID();
        $paises = $oApi->getPaisAll();
        $rubro = $oApi->getRubro();
        $productos = $oApi->getProductoAll();          
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
                 $("#myModal").modal("showe");
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
                    <h1 class="h3 mb-2 text-gray-800">Administración de stock</h1>
                    <p class="mb-4"> </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ingreso de stock </h6>
                            <a href="index.php?seccion=stock/edt_stock.php&id_comprobante=0&id_stock=0">
                                                <button class="btn btn-primary" type="button" >+ crear</button></td> 
                                                </a>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID Comprobante</th>
                                            <th>Tipo de Comprobante</th>
                                            <th>Fecha</th>
                                            <th>Nro. Comprobante</th>
                                            <th>Proveedor</th>
                                            <th>ID Stock</th>
                                            <th>Producto</th>
                                            <th>Nro. lote</th>
                                            <th>Vencimiento</th>
                                            <th>Bultos</th>
                                            <th>País</th>
                                            <th>Presentación</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tipo de Comprobante</th>
                                            <th>Fecha</th>
                                            <th>Nro. Comprobante</th>
                                            <th>Proveedor</th>
                                            <th>ID Stock</th>
                                            <th>Producto</th>
                                            <th>Nro. lote</th>
                                            <th>Vencimiento</th>
                                            <th>Bultos</th>
                                            <th>País</th>
                                            <th>Presentación</th>
                                            <th>Acciones</th>                        
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach($comprobantes as $comprobante){?>
                                            <?php foreach($comprobantesTipo as $Tipocomprobante){?>
                                                <?php foreach($stocks as $stock){?>
                                                        <?php foreach($stocksMovimientos as $stockMovimiento){?>
                                                <?php if($comprobante->id_comprobante_tipo == $Tipocomprobante->id_comprobante_tipo && $Tipocomprobante->stock==1 && $stockMovimiento->id_comprobante == $comprobante->id_comprobante && $stockMovimiento->nro_stock == $stock->nro_stock){?>
                                                    <tr>
                                                        <?php ?>
                                                            <td><?php echo $comprobante->id_comprobante;?></td>
                                                            <td><?php echo $Tipocomprobante->comprobante_tipo; ?></td>
                                                            <td><?php echo $comprobante->fecha;?></td>
                                                            <td><?php echo $comprobante->nro_comprobante;?></td> 
                                                            <td><?php foreach($proveedores as $proveedor){
                                                                    if($proveedor->id_proveedor==$comprobante->id_proveedor){echo $proveedor->razon_soc; }
                                                                    if($comprobante->id_proveedor == 0){echo "Sin proveedor"; break; }
                                                                    }?></td>
                                                            <td><?php if($stockMovimiento->id_comprobante == $comprobante->id_comprobante && $stockMovimiento->nro_stock == $stock->nro_stock){echo $stock->id_stock;}?></td>
                                                            <td><?php foreach($productos as $producto){
                                                                if($stock->codigo_producto==$producto->codigo_producto){
                                                                                echo $producto->producto; break;}}?></td>
                                                            <td><?php echo $stock->nro_lote;?></td>
                                                            <td><?php echo $stock->vencimiento;?></td>
                                                            <td><?php echo $stock->bultos;?></td> 
                                                            <td><?php foreach($paises as $pais){
                                                                    if($pais->iso==$stock->iso_origen){echo $pais->nombre; }
                                                                    if($stock->iso_origen==null){echo "Sin país"; break;}
                                                                    }?></td>
                                                            <td><?php if($stock->presentacion!=null){echo $stock->presentacion; }else{echo "Sin presentación";}?></td> 
                                                            <td><a href="index.php?seccion=stock/edt_stock.php&id_comprobante=<?php echo $comprobante->id_comprobante;?>&id_proveedor=<?php echo $comprobante->id_proveedor;?>&id_stock=<?php echo $stock->id_stock;?>">
                                                                <button class="btn btn-primary" type="button" >editar</button>
                                                                </a>
                                                                <a href="index.php?seccion=stock/stock_save.php&id_comprobante=<?php echo $comprobante->id_comprobante;?>&id_stock=<?php echo $stock->id_stock;?>">
                                                                <button class="btn btn-danger" type="button" ><img src="img/trash.png"/></button>
                                                                </a>
                                                                
                                                            </td>
                                                        <?php ?>
                                                    </tr>
                                                <?php }?>
                                                <?php }?>
                                                <?php }?>
                                            <?php }?>
                                        <?php }?>                                     
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
<?php }?> 