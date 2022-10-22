<?php

require_once("accesscontrol.php");


$ErrorMsg = "";
if(isset($_GET["id"])){try{

        $oApi = new API();
        
        if(!empty($_GET["id"])){
            // si el id no es cero es editar de empleado
            $proveedores = $oApi->getProveedorById($_GET["id"]);            
            $proveedor = $proveedores[0];
            $titulo = "Edición de datos del Proveedor";
        }else{
            // si el id es cero es alta
            $titulo = "Alta de proveedor";
            $jsonModel = '{
                            "id_proveedor": 0,
                            "razon_soc": "",
                            "cuit": "",
                            "calle": "",
                            "numero_calle": "",
                            "localidad": "",
                            "cod_provincia": null,
                            "telefono": "",
                            "email": ""                         
                        }';


            $proveedor = json_decode($jsonModel);

        }
        $provincias = $oApi->getProvincias(); 
        
    }catch (Exception $e){
        $ErrorMsg =  $e->getMessage();
    }
}else{
    $ErrorMsg = "Falta el parámetro id_proveedor";
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

  <!--Buscador con selector-->
  <link rel="stylesheet" type="text/css" href="css/select2.min.css">
  <link rel="stylesheet" href="css/seba.css">
    <script
  src="https://code.jquery.com/jquery-3.6.1.js"
  integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
  crossorigin="anonymous"></script>
    <script src="js/select2.min.js"> </script>
              
        <!-- /.acá poner el form yu cargarle los valores -->
       <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Administración de Proveedores</h1>
                    <p class="mb-4"> </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo $titulo ; ?></h6>
                        </div>
                        <div class="card-body">                            
                            <div>
                               <form id="form_proveedor" method="post" action="index.php?seccion=proveedor/proveedor_save.php">
                                  <!-- 2 column grid layout with text inputs for the first and last names -->
                                  <div class="row mb-4">
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="id_proveedor_sh" id="id_proveedor_sh" disabled="" class="form-control"  value="<?php echo $proveedor->id_proveedor;?>" />
                                        <input type="hidden" name="id_proveedor" id="id_proveedor" class="form-control"  value="<?php echo $proveedor->id_proveedor;?>" />
                                        <label class="form-label" for="id_proveedor">ID</label>
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="razon_soc" id="razon_soc" name="razon_soc" required class="form-control" value="<?php echo $proveedor->razon_soc;?>" />
                                        <label class="form-label" for="razon_soc">Razón Social</label>
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="cuit" id="cuit" name="cuit" required class="form-control" value="<?php echo $proveedor->cuit;?>"/>
                                        <label class="form-label" for="cuit">Cuit</label>
                                      </div>
                                    </div>
                                  </div>

                                    <div class="row mb-4">
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="calle" id="calle" name="calle" required class="form-control" value="<?php echo $proveedor->calle;?>" />
                                        <label class="form-label" for="calle">Calle</label>
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="number" name="numero_calle" id="numero_calle"  name="numero_calle" required class="form-control" value="<?php echo $proveedor->numero_calle;?>"/>
                                        <label class="form-label" for="numero_calle">Nro.</label>
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="localidad" id="localidad" name="localidad" required class="form-control" value="<?php echo $proveedor->localidad;?>" />
                                        <label class="form-label" for="nombre">Localidad</label>
                                      </div>
                                    </div>
                                         
                                  <div class="col">
                                      <div class="form-outline">                                    
                                        <select name="cod_provincia" class="js-example-basic-single"  id="provincia" style="width:100%">
                                            <?php if($proveedor->cod_provincia==null) { ?>
                                                <option value="">Sin provincia </option>
                                            <?php } ?>
                                            <?php foreach($provincias as $provincia){ ?>
                                                <option value="<?php echo $provincia->cod_provincia;?>" <?php if($provincia->cod_provincia==$proveedor->cod_provincia){
                                                    echo 'selected';
                                                }?>><?php echo $provincia->provincia;?></option>
                                            <?php } ?>
                                        </select>
                                        <label  class="form-label" for="provincia"></label>
                                      </div>
                                  </div>
                                  
                                  <div class="col">
                                      <div class="form-outline">
                                        <input type="tel" name="telefono" id="telefono" name="telefono" required class="form-control" value="<?php echo $proveedor->telefono;?>" />
                                        <label class="form-label" for="nombre">Telefono</label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row mb-4">
                                  <div class="col">
                                      <!-- Email input -->
                                      <div class="form-outline">
                                        <input type="email" name="email" id="email" class="form-control" value="<?php echo $proveedor->email;?>" />
                                        <label class="form-label" for="email">Email</label>
                                      </div>                                 
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
<?php } ?>
<script type="text/javascript">
$(document).ready(function() {
$('.js-example-basic-single').select2();
});
</script>