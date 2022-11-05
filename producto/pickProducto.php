<?php

$ErrorMsg = "";
try{
        $oApi = new API();
        $productos = $oApi->getProductosAll(); 
        $rubros = $oApi->getRubrosAll();           
    }catch (Exception $e){
        $ErrorMsg =  $e->getMessage();
    }
?>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Codigo</th>
                    <th>Producto</th>                    
                    <th>Rubro</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Codigo</th>
                    <th>Producto</th>
                    <th>Rubro</th>               
                </tr>
            </tfoot>
            <tbody>
            <?php foreach($productos as $producto){ ?>
                <tr>
                    <td><?php echo $producto->id_producto;?></td>
                    <td><?php echo $producto->codigo_producto;?></td>
                    <td><?php echo $producto->producto;?></td>
                    <td><?php foreach($rubros as $rubro){if($producto->id_rubro==$rubro->id_rubro)echo $rubro->rubro;}?></td>
                </tr>  
            <?php }?>                                      
            </tbody>
        </table>
    </div>
</div>