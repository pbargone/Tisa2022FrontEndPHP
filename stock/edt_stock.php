<?php

require_once("accesscontrol.php");

date_default_timezone_set("America/Argentina/Buenos_Aires");

$ErrorMsg = "";
if(isset($_GET["id_comprobante"])){try{

        $oApi = new API();
        
        if(empty($_GET["id_comprobante"])){
            // si el id es cero es alta
            $tituloComprobante = "Comprobante";
            $jsonModel = '{
                            "id_comprobante": 0,
                            "id_comprobante_tipo": "",
                            "fecha": "",
                            "nro_comprobante": "",
                            "id_proveedor": ""                            
                        }';


            $comprobante = json_decode($jsonModel);
        }
        $tiposComprobantes = $oApi->getComprobanteTipoByStock();
        $proveedores = $oApi->getProveedorID();
    }catch (Exception $e){
        $ErrorMsg =  $e->getMessage();
    }
}else{
    $ErrorMsg = "Falta el parámetro id_comprobante";
}

$ErrorMsg = "";
if(isset($_GET["id_stock"])){try{

        $oApi = new API();
        
        if(empty($_GET["id_stock"])){
            // si el id es cero es alta
            $tituloStock = "Stock";
            $jsonModel = '{
                            "id_stock": 0,
                            "codigo_producto": "",
                            "nro_lote": "",
                            "vencimiento": "",
                            "bultos": "",
                            "nro_stock": "",
                            "iso_origen": "",
                            "presentacion": ""                            
                        }';


            $stock = json_decode($jsonModel);
        }
        $paises = $oApi->getPaisAll();
        $rubro = $oApi->getRubro();
        $productos = $oApi->getProductoAll();
    }catch (Exception $e){
        $ErrorMsg =  $e->getMessage();
    }
}else{
    $ErrorMsg = "Falta el parámetro id_stock";
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
    <link rel="stylesheet" type="text/css" href="css/select2.min.css">
    <script
  src="https://code.jquery.com/jquery-3.6.1.js"
  integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
  crossorigin="anonymous"></script>
    <script src="js/select2.min.js"> </script>
        <!-- /.acá poner el form yu cargarle los valores -->
       <div class="container-fluid">
        
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Ingreso de stock</h1>
                    <p class="mb-4"> </p>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo $tituloComprobante ; ?></h6>
                        </div>
                        <div class="card-body">                            
                            <div>
                               <form id="form_comprobante" method="post" action="index.php?seccion=stock/stock_save.php">
                                  <!-- 2 column grid layout with text inputs for the first and last names -->
                                  <div class="row mb-4">
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="hidden" name="id_comprobante_sh" id="id_comprobante_sh" disabled="" class="form-control"  value="<?php echo $comprobante->id_comprobante;?>" />
                                        <input type="hidden" name="id_comprobante" id="id_comprobante" class="form-control"  value="<?php echo $comprobante->id_comprobante;?>" />
                                      </div>
                                      </div>
                                  </div>
                                      <div class="row mb-4">                         
                                        <div class="col">
                                            <div class="form-outline">
                                            <select class="js-example-basic-single" name="id_comprobante_tipo" style="width: 20%" id="id_comprobante_tipo">
                                                    <option disabled selected>Seleccionar comprobante</option>
                                                    <?php foreach($tiposComprobantes as $tipoComprobante){?>
                                                        <option value="<?php echo $tipoComprobante->id_comprobante_tipo; ?>" <?php if($tipoComprobante->id_comprobante_tipo==$comprobante->id_comprobante_tipo && $tipoComprobante->stock == 1){
                                                            echo 'selected';
                                                        }?>><?php if($tipoComprobante->stock == 1){echo $tipoComprobante->comprobante_tipo;}?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <label  class="form-label" for="id_comprobante_tipo">Tipo de comprobante</label>
                                            <?php $Jid_comprobante = $tipoComprobante->comprobante_tipo; ?>
                                        </div>
                                      </div>
                                    <div class="row mb-4">
                                    <div class="col">
                                      <div class="form-outline">
                                      <input type="text" readonly="readonly" name="fecha" id="fecha" class="form-control" value="<?php echo date("Y-m-d")." ".date("h:i:s"); ?>"/>
                                        <label class="form-label" for="fecha">Fecha</label>
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-outline">
                                      <input type="text" name="nro_comprobante" id="nro_comprobante" class="form-control" placeholder="Ingrese nro. del comprobante" value="<?php echo $comprobante->nro_comprobante;?>"/>
                                        <label class="form-label" for="nro_comprobante">Nro. de comprobante</label>
                                      </div>
                                    </div>
                                    <div class="col">
                                          <div class="form-outline">
                                          <select class="js-example-basic-single" name="id_proveedor" style="width: 80%" id="id_proveedor">
                                          <?php foreach($proveedores as $proveedor){ ?>
                                            <?php if($comprobante->id_proveedor==null) { ?>
                                                <option value="">Sin proveedor </option>
                                            <?php } ?>
                                            
                                                <option value="<?php echo $comprobante->id_proveedor;?>" <?php if($proveedor->id_proveedor==$comprobante->id_proveedor){
                                                    echo 'selected';
                                                }?>><?php echo $proveedor->razon_soc;?></option>
                                                <?php } ?>
                                            </select>
                                          </div>
                                          <label  class="form-label" for="id_proveedor">Proveedor</label>
                                    </div>
                                    </div>
                                  </div>
                                    </div>
                                    </div>
                                    <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $tituloStock ; ?></h6>
                                    </div>
                                    <div class="card-body">                            
                                    <div class="row mb-4">
                                            <div class="col">
                                            <div class="form-outline">
                                                <input type="hidden" name="id_stock_sh" id="id_stock_sh" disabled="" class="form-control"  value="<?php echo $stock->id_stock;?>" />
                                                <input type="hidden" name="id_stock" id="id_stock" class="form-control"  value="<?php echo $stock->id_stock;?>" />
                                            </div>
                                        </div>          
                                    </div>
                                      <div class="row mb-4">                         
                                        <div class="col">
                                            <div class="form-outline">
                                                <select class="js-example-basic-single" name="codigo_producto" style="width: 80%" id="codigo_producto">
                                                <option disabled selected>Seleccionar producto</option>
                                                <?php foreach($productos as $producto){?>
                                                        <option value="<?php echo $producto->codigo_producto; ?>" <?php if($producto->codigo_producto==$stock->codigo_producto){
                                                            echo 'selected';
                                                        }?>><?php echo $producto->producto;?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <label  class="form-label" for="codigo_producto">Producto</label>
                                        </div>
                                        <div class="col">
                                      <div class="form-outline">
                                        <input type="text" placeholder="Ingrese nro. de lote" name="nro_lote" id="nro_lote" class="form-control" value="<?php echo $stock->nro_lote; ?>"/>
                                        <label class="form-label" for="nro_lote">Nro. de lote</label>
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="vencimiento" id="vencimiento" placeholder="Fecha de vencimiento del producto" class="form-control"  value="<?php echo $stock->vencimiento;?>"/>
                                        <label class="form-label" for="vencimiento">Vencimiento</label>
                                      </div>
                                    </div>
                                    </div>
                                    <div class="row mb-4">
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" placeholder="Ingrese la cantidad de bultos" name="bultos" id="bultos" class="form-control" style="width: 80%" value="<?php echo $stock->bultos;?>"/>
                                        <label class="form-label" for="bultos">Bultos</label>
                                      </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-outline">
                                          <select class="js-example-basic-single" name="iso_origen" style="width: 80%" id="iso_origen" readonly="readonly">
                                            <option disabled selected >Seleccione un país</option>
                                            <?php foreach($paises as $pais){ ?>
                                                <option placeholder="Seleccionar país" value="<?php echo $pais->iso;?>" <?php if($pais->iso==$stock->iso_origen){
                                                    echo 'selected';
                                                }?>><?php echo $pais->nombre;?></option>
                                                <?php } ?>
                                            </select>
                                          </div>
                                          <label  class="form-label" for="iso_origen">País</label>
                                      </div>
                                      <div class="col">
                                      <div class="form-outline">
                                        <input type="text" placeholder="Presentación del producto" name="presentacion" id="presentacion" class="form-control" style="width: 80%" value="<?php echo $stock->presentacion;?>"/>
                                        <label class="form-label" for="presentacion">Presentación</label>
                                    </div>
                                    </div>
                                    </div>
                                    
                                    <!-- Submit button -->
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary btn-block mb-4" onclick="agregarFila()">Agregar</button>
                                        <button type="button" class="btn btn-danger" onclick="eliminarFila()">Eliminar</button>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block mb-4">Guardar Stock</button>
                                    <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Stock agregado </h6>
                        </div>
                            <div class="table-responsive">
                            <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css" rel="stylesheet"/>
                            <table class="table table-bordered" id="insertStock" width="100%" cellspacing="0">
                                <tr>
                                        <th>Comprobante</th>
                                        <th>Fecha</th>
                                        <th>Nro. Comprobante</th>
                                        <th>Proveedor</th>
                                        <th>Producto</th>
                                        <th>Nro. lote</th>
                                        <th>Vencimiento</th>
                                        <th>Bultos</th>
                                        <th>País</th>
                                        <th>Presentación</th>
                                        <th>Acciones</th>
                                </tr>
                                <tbody>
                                </tbody>
                            </table>
                            
                        </div>
                            <script>
                                const agregarFila = () => {
                                document.getElementById('insertStock').insertRow(-1).innerHTML = '<td><?php echo $Jid_comprobante; ?></td>'+'<td><?php echo date("Y-m-d")." ".date("h:i:s"); ?></td>'
                                }

                                const eliminarFila = () => {
                                const table = document.getElementById('insertStock')
                                const rowCount = table.rows.length
                                
                                if (rowCount <= 1)
                                    alert('No se puede eliminar el encabezado')
                                else
                                    table.deleteRow(rowCount -1)
                                }
                            </script>  
                            </form>
                    </div>
                </div>

            </div>  <!-- /.container-fluid -->
<?php }?>

<script type="text/javascript">
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>