<?php

require_once("accesscontrol.php");


$ErrorMsg = "";
if(isset($_GET["id"])){try{

        $oApi = new API();
        
        if(!empty($_GET["id"])){
            // si el id no es cero es editar de empleado
            $empleados = $oApi->getEmpleadoById($_GET["id"]);            
            $empleado = $empleados[0];
            $titulo = "Edición de empleado";
        }else{
            // si el id es cero es alta
            $titulo = "Alta de empleado";
            $jsonModel = '{
                            "id_empleado": 0,
                            "nombre": "",
                            "apellido": "",
                            "calle": "",
                            "numero_calle": "",
                            "localidad": "",
                            "cod_provincia": null,
                            "email": ""                            
                        }';


            $empleado = json_decode($jsonModel);

        }
        $provincias = $oApi->getProvincias(); 
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
              
        <!-- /.acá poner el form yu cargarle los valores -->
       <div class="container-fluid">

                    <!-- Page Heading -->
					<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./index.php">Inicio</a></li>
		<li class="breadcrumb-item"><a href="./index.php?seccion=empleados.php">Administración de empleados</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
    </ol>
</nav>
                    <h1 class="h3 mb-2 text-gray-800">Administración de empleados</h1>
                    <p class="mb-4"> </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo $titulo ; ?></h6>
                        </div>
                        <div class="card-body">                            
                            <div>
                               <form id="form_empleado" method="post" action="index.php?seccion=empleado/empleado_save.php">
                                  <!-- 2 column grid layout with text inputs for the first and last names -->
                                  <div class="row mb-4">
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="id_empleado_sh" id="id_empleado_sh" disabled="" class="form-control"  value="<?php echo $empleado->id_empleado;?>" />
                                        <input type="hidden" name="id_empleado" id="id_empleado" class="form-control"  value="<?php echo $empleado->id_empleado;?>" />
                                        <label class="form-label" for="nombre">ID</label>
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $empleado->nombre;?>" />
                                        <label class="form-label" for="nombre">Nombre</label>
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="apellido" id="apellido" class="form-control" value="<?php echo $empleado->apellido;?>"/>
                                        <label class="form-label" for="apellido">Apellido</label>
                                      </div>
                                    </div>
                                  </div>

                                    <div class="row mb-4">
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="calle" id="calle" class="form-control" value="<?php echo $empleado->calle;?>" />
                                        <label class="form-label" for="calle">Calle</label>
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="numero_calle" id="numero_calle" class="form-control" value="<?php echo $empleado->numero_calle;?>"/>
                                        <label class="form-label" for="numero_calle">Nro.</label>
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="localidad" id="localidad" class="form-control" value="<?php echo $empleado->localidad;?>" />
                                        <label class="form-label" for="nombre">Localidad</label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row mb-4">
                                  <div class="col">
                                      <!-- Email input -->
                                      <div class="form-outline">
                                        <input type="email" name="email" id="email" class="form-control" value="<?php echo $empleado->email;?>" />
                                        <label class="form-label" for="email">Email</label>
                                      </div>                                 
                                  </div>                                  
                                  <div class="col">
                                      <div class="form-outline">
                                        
                                        <select name="cod_provincia" class="form-control" id="provincia" >
                                            <?php if($empleado->cod_provincia==null) { ?>
                                                <option value="">Sin provincia </option>
                                            <?php } ?>
                                            <?php foreach($provincias as $provincia){ ?>
                                                <option value="<?php echo $provincia->cod_provincia;?>" <?php if($provincia->cod_provincia==$empleado->cod_provincia){
                                                    echo 'selected';
                                                }?>><?php echo $provincia->provincia;?></option>
                                            <?php } ?>
                                        </select>
                                        <label  class="form-label" for="provincia">Provincia</label>
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
<?php } 
