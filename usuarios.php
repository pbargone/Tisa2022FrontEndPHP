<?php

require_once("accesscontrol.php");
$ErrorMsg = "";
try{
        $oApi = new API();
        $usuarios = $oApi->getUsuariosAll();            
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
					<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./index.php">Inicio</a></li>
		<li class="breadcrumb-item active" aria-current="page">Administración de usuarios</li>
    </ol>
</nav>
					
					
					
                    <h1 class="h3 mb-2 text-gray-800">Administración de usuarios</h1>
                    <p class="mb-4">   </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Usuarios del sistema
							
							<a class="btn btn-outline-primary" href="index.php?seccion=usuario/edt_usuario.php&id=0"
                            data-toggle="tooltip" data-placement="bottom" title=" Nuevo ">
                            <i class="fas fa-user-plus"> </i>
								</a>					
							</h6> 
													
							
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Usuario</th>
                                            <th>Email</th>
                                            <th>Activo</th>
                                            <th>Permiso</th>
                                            <th>Acciones</th>                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Usuario</th>
                                            <th>Email</th>
                                            <th>Activo</th>
                                            <th>Permiso</th>
                                            <th>Acciones</th>                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php foreach($usuarios as $usuario){ ?>
                                        <tr>
                                            <td><?php echo $usuario->id_usuario;?></td>
                                            <td><?php echo $usuario->usuario;?></td>
                                            <td><?php echo $usuario->email;?></td>
                                            <td><?php echo $usuario->activo;?></td>
                                            <td><?php echo $usuario->perfil;?></td> 
                                            <td>
											
											<div class=btn-group>
												
												
												<a class="btn btn-outline-success" href="index.php?seccion=usuario/edt_usuario.php&id=<?php echo $usuario->id_usuario;?>"
                                                data-toggle="tooltip" data-placement="bottom" title=" Editar ">
                                                <i class="fas fa-pencil-alt"> </i>
												</a>
												
												
												<a class="btn btn-outline-danger" href="" data-toggle="modal" data-toggle="tooltip"
												data-placement="bottom" title=" Borrar " data-target="#ModalEditar<?php echo $usuario->id_usuario;?>">
                                                <i class="fas fa-trash-alt"> </i>
												</a>
																						                                             
												
												</div>											
											
											
											
											
                                        </tr>  
									
									<!-- Modal Borrar -->
                            <div class="modal fade" id="ModalEditar<?php echo $usuario->id_usuario; ?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Esta seguro de eliminar el Usuario?</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="index.php?seccion=usuario/usuario_save.php&id_usuario=<?php echo $usuario->id_usuario;?>" autocomplete="off" enctype="multipart/form-data">
                                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light btn-lg" data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-outline-danger btn-lg"><i class="fas fa-trash-alt mr-2"></i>Elimimar</button>
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