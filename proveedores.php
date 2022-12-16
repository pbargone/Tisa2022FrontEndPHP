<?php

require_once("accesscontrol.php");
$ErrorMsg = "";
try{
        $oApi = new API();
        $proveedores = $oApi->getProveedoresAll();     
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
		<li class="breadcrumb-item active" aria-current="page">Administración de proveedores</li>
    </ol>
</nav>
<!-- Creo 2 etiquetas para dar color -->
<style>
 p { color: red; }
 g { color: green; }
</style>
<script type="text/javascript" src="main.js"></script>
		
                    <h1 class="h3 mb-2 text-gray-800">Administración de proveedores</h1>
                    <p class="mb-4">   </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Proveedores del sistema
							
							<a class="btn btn-outline-primary" href="index.php?seccion=proveedor/edt_proveedor.php&id=0"
                            data-toggle="tooltip" data-placement="bottom" title=" Registrar nuevo proveedor ">
                            <i class="fas fa-user-plus"> </i>
								</a>					
							</h6> 
                    
							
                </div>
                    
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">

                            <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"/>
                                <script src="//code.jquery.com/jquery-1.12.4.js"></script>
                                <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
                                
                                <thead>
                                        <tr>
                                        <th>id_proveedor</th>
                                            <th>Razón Social</th>
                                            <th>Cuit</th>
                                            <th>Calle</th>
                                            <th>N°Calle</th>
                                            <th>Localidad</th> 
                                            <th>Código Provincia</th> 
                                            <th>Teléfono</th>  
                                            <th>Email</th> 
                                            <th>Estado</th>  
                                            <th>Acciones</th>   
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php foreach($proveedores as $proveedor){ ?>
                                    <tr>
                                    <td><?php echo $proveedor->id_proveedor;?></td>
                                    <td><?php echo $proveedor->razon_soc;?></td>
                                    <td><?php echo $proveedor->cuit;?></td>
                                    <td><?php echo $proveedor->calle;?></td>
                                    <td><?php echo $proveedor->numero_calle;?></td>
                                    <td><?php echo $proveedor->localidad;?></td>
                                    <td><?php if($proveedor->cod_provincia == '') {echo "No Posee";} ?></td>
                                    <td><?php echo $proveedor->telefono;?></td>
                                    <td><?php echo $proveedor->email;?></td>
                                    <td><g><?php if($proveedor->activo == '1') {echo "Activo";}?></g>
                                        <p><?php if($proveedor->activo == '0'){echo "Inactivo";}?></p></td>
                                    <td>
                                            
                                            
											
											<div class=btn-group>
												
												
												<a class="btn btn-outline-success" href="index.php?seccion=proveedor/edt_proveedor.php&id=<?php echo $proveedor->id_proveedor;?>"
                                                data-toggle="tooltip" data-placement="bottom" title=" Editar proveedor">
                                                <i class="fas fa-pencil-alt"> </i>
												</a>
												
												<!-- fas fa-trash-alt -->
												<a <?php if($proveedor->activo == '1') {?> class="btn btn-outline-danger" title=" Baja " <?php }else{?> class="btn btn-outline-success" <?php }?> href="" data-toggle="modal" data-toggle="tooltip"
												data-placement="bottom" title=" Alta " data-target="#ModalEditar<?php echo $proveedor->id_proveedor;?>">
                                                <?php if($proveedor->activo == '1') {?> <i class="fas fa-user-slash"> </i><?php }?>
                                                <?php if($proveedor->activo == '0') {?> <i class="fas fa-user-check"> </i><?php }?>
												</a>
																						                                             
												
												</div>																				
                                        </tr>  
                                  
                                    
									<!-- Modal Borrar -->
                            <div class="modal fade" id="ModalEditar<?php echo $proveedor->id_proveedor;?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <?php if($proveedor->activo == '1') {?> <h4 class="modal-title">¿Esta seguro de querer dar de baja al proveedor <b><?php echo $proveedor->razon_soc;?></b> ?</h4><?php }?>
                                        <?php if($proveedor->activo == '0') {?> <h4 class="modal-title">¿Esta seguro de querer dar de alta al proveedor <b><?php echo $proveedor->razon_soc;?></b> ?</h4><?php }?>
                                            <!--<h4 class="modal-title">Esta seguro de dar la baja al Proveedor <b>--><?php //echo $proveedor->razon_soc;?><!--</b> ?</h4>-->
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="index.php?seccion=proveedor/proveedor_save.php&id_proveedor=<?php echo $proveedor->id_proveedor;?>&activo=<?php echo $proveedor->activo;?>" autocomplete="off" enctype="multipart/form-data">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light btn-lg" data-dismiss="modal">Cerrar</button>

                                                    <?php if($proveedor->activo == '1') {?><button type="submit" class="btn btn-outline-danger btn-lg"><i class="fas fa-user-slash"></i> Dar de Baja</button><?php }?>

                                                    <?php if($proveedor->activo == '0') {?><button type="submit" class="btn btn-outline-success btn-lg"><i class="fas fa-user-check"></i> Dar de Alta</button><?php }?>
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
  $('#dataTable2').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
  });

});</script>