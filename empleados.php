<?php

require_once("accesscontrol.php");


$ErrorMsg = "";
try{
        $oApi = new API();
        $empleados = $oApi->getEmpleadosAll();            
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
                    <h5 class="modal-title" id="exampleModalLabel">Error de carga de datos</h5>
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
                    <h1 class="h3 mb-2 text-gray-800">Administración de empleados</h1>
                    <p class="mb-4"> </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Empleados registrados </h6>
                            <a href="index.php?seccion=empleado/edt_empleado.php&id=0">
                                                <button class="btn btn-primary" type="button" >+ Crear empleado</button></td> 
                                                </a>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Calle</th>
                                            <th>nro</th>
                                            <th>Localidad</th>
                                            <th>Prov.</th>
                                            <th>Email</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Calle</th>
                                            <th>nro</th>
                                            <th>Localidad</th>
                                            <th>Prov.</th>
                                            <th>Email</th>
                                            <th>Acciones</th>                           
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php foreach($empleados as $empleado){ ?>
                                        <tr>
                                            <td><?php echo $empleado->id_empleado;?></td>
                                            <td><?php echo $empleado->nombre;?></td>
                                            <td><?php echo $empleado->apellido;?></td>
                                            <td><?php echo $empleado->calle;?></td>
                                            <td><?php echo $empleado->numero_calle;?></td> 
                                            <td><?php echo $empleado->localidad;?></td> 
                                            <td><?php echo $empleado->provincia;?></td> 
                                            <td><?php echo $empleado->email;?></td> 
                                            <td><a href="index.php?seccion=empleado/edt_empleado.php&id=<?php echo $empleado->id_empleado;?>">
                                                <button class="btn btn-primary" type="button" >Editar</button>
                                                </a>
                                                <a href="index.php?seccion=empleado/empleado_save.php&id_empleado=<?php echo $empleado->id_empleado;?>">
                                                <button class="btn btn-danger" type="button" ><img src="img/trash.png"/></button>
                                                </a>
                                                </td> 
                                        </tr>  
                                    <?php }?>                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
<?php }?> 
