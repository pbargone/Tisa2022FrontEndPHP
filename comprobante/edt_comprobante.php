<?php

require_once("accesscontrol.php");

date_default_timezone_set("America/Argentina/Buenos_Aires");

$ErrorMsg = "";
if(isset($_GET["id"])){try{

        $oApi = new API();
        
        if(!empty($_GET["id"])){
            // si el id no es cero es editar de comprobante
            $comprobantes = $oApi->getComprobanteById($_GET["id"]);            
            $comprobante = $comprobantes[0];
            $titulo = "Edición de datos de comprobante";
        }else{
            // si el id es cero es alta
            $titulo = "Ingreso de comprobante";
            $jsonModel = '{
                            "id_comprobante": 0,
                            "id_comprobante_tipo": "",
                            "fecha": "",
                            "fecha_ingreso": "",
                            "nro_comprobante": "",
                            "id_proveedor": ""                            
                        }';


            $comprobante = json_decode($jsonModel);

        }
        $tiposComprobantes = $oApi->getComprobanteTipoByStock();
        $rubros = $oApi->getRubro();
        $proveedores = $oApi->getProveedorID();
    }catch (Exception $e){
        $ErrorMsg =  $e->getMessage();
    }
}else{
    $ErrorMsg = "Falta el parámetro id_comprobante";
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
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo $titulo ; ?></h6>
                        </div>
                        <div class="card-body">                            
                            <div>
                               <form id="form_comprobante" method="post" action="index.php?seccion=stock/stock_save.php">
                                  <!-- 2 column grid layout with text inputs for the first and last names -->
                                  <div class="row mb-4">
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="id_comprobante_sh" id="id_comprobante_sh" disabled="" class="form-control"  value="<?php echo $comprobante->id_comprobante;?>" />
                                        <input type="hidden" name="id_comprobante" id="id_comprobante" class="form-control"  value="<?php echo $comprobante->id_comprobante;?>" />
                                        <label class="form-label" for="id_comprobante">ID</label>
                                      </div>
                                      </div>
                                  </div>
                                      <div class="row mb-4">                         
                                        <div class="col">
                                            <div class="form-outline">
                                                <select class="js-example-basic-single" name="id_comprobante_tipo" style="width: 20%" id="id_comprobante_tipo">
                                                    <?php foreach($tiposComprobantes as $tipoComprobante){?>
                                                        <option value="<?php echo $tipoComprobante->id_comprobante_tipo; ?>" <?php if($tipoComprobante->id_comprobante_tipo==$comprobante->id_comprobante_tipo && $tipoComprobante->stock==1){
                                                            echo 'selected';
                                                        }?>><?php echo $tipoComprobante->comprobante_tipo;?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <label  class="form-label" for="id_comprobante_tipo">Tipo comprobante</label>
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
                                        <input type="text" name="nro_comprobante" id="nro_comprobante" class="form-control" value="<?php echo $comprobante->nro_comprobante;?>"/>
                                        <label class="form-label" for="nro_comprobante">Nro. de comprobante</label>
                                      </div>
                                    </div>
                                    <div class="col">
                                          <div class="form-outline">
                                          <select class="js-example-basic-single" name="state" style="width: 80%" id="id_proveedor">
                                            <?php if($comprobante->id_proveedor==null) { ?>
                                                <option value="">Sin proveedor </option>
                                            <?php } ?>
                                            <?php foreach($proveedores as $proveedor){ ?>
                                                <option value="<?php echo $proveedor->id_proveedor;?>" <?php if($proveedor->id_proveedor==$comprobante->id_proveedor){
                                                    echo 'selected';
                                                }?>><?php echo $proveedor->razon_soc;?></option>
                                                <?php } ?>
                                            </select>
                                          </div>
                                          <label  class="form-label" for="id_proveedor">ID proveedor</label>
                                      </div>
                                  </div>

                                  <!-- Submit button -->
                                  <button type="submit" class="btn btn-primary btn-block mb-4">Guardar</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
<?php }?>
<script type="text/javascript">
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>