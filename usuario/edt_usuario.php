<?php

require_once("accesscontrol.php");

$ErrorMsg = "";
if(isset($_GET["id"])){try{

        $oApi = new API();
        
        if(!empty($_GET["id"])){
            // si el id no es cero es editar de empleado
            $usuarios = $oApi->getUsuarioById($_GET["id"]);            
            $usuario = $usuarios[0];
            $titulo = "Edición de datos de usuario";
        }else{
            // si el id es cero es alta
            $titulo = "Alta de usuario";
            $jsonModel = '{
                            "id_usuario": 0,
                            "usuario": "", 
                            "email": ""                   
                        }';

            $usuario = json_decode($jsonModel);
            var_dump($usuario);

        }
    }catch (Exception $e){
        $ErrorMsg =  $e->getMessage();
    }
}else{
    $ErrorMsg = "Falta el parámetro id_usuario";
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
       <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Administración de usuarios</h1>
                    <p class="mb-4"> </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo $titulo ; ?></h6>
                        </div>
                        <div class="card-body">                            
                            <div>
                               <form id="form_usuario" method="post" action="index.php?seccion=usuario/usuario_save.php">
                                  <!-- 2 column grid layout with text inputs for the first and last names -->
                                  <div class="row mb-4">
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="id_usuario_sh" id="id_usuario_sh" disabled="" class="form-control"  value="<?php echo $usuario->id_usuario;?>" />
                                        <input type="hidden" name="id_usuario" id="id_usuario" class="form-control"  value="<?php echo $usuario->id_usuario;?>" />
                                        <label class="form-label" for="id_usuario">ID</label>
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="usuario" id="usuario" name="usuario" required class="form-control" value="<?php echo $usuario->usuario;?>" />
                                        <label class="form-label" for="usuario">usuario</label>
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="email" id="email" name="email" required class="form-control" value="<?php echo $usuario->email;?>"/>
                                        <label class="form-label" for="email">email</label>
                                      </div>
                                    </div>
                                  </div>



                                  <!-- Submit button -->
                                  <button type="submit" class="btn btn-primary btn-block mb-4">Guardar</button>
                                  
                                   <!--?php echo $empleado->id_empleado;?>-->
                                   <td><a href="index.php?seccion=usuarios.php">
                                   <button class="btn btn-primary btn-block mb-4" type="button" >Volver Atras</button>
                                     </a>
                                    </td> 
                                  
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
<?php } 


