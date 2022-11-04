<?php

require_once("accesscontrol.php");
$ErrorMsg = "";
try{
        $oApi = new API();
        $rubros = $oApi->getRubrosAll();            
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
        <li class="breadcrumb-item active" aria-current="page">Administración de rubros</li>
    </ol>
</nav>
                    <h1 class="h3 mb-2 text-gray-800">Administración de rubros</h1>
                    <p class="mb-4">   </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Rubros habilitados 
                            <a class="btn btn-outline-primary" href="index.php?seccion=rubro/edt_rubro.php&id=0"
                              data-toggle="tooltip" data-placement="bottom" title=" Crear rubro ">
                            <i class="fas fa-tag"></i>
                            <a> 
                            </h6>                 
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Rubro</th>
                                            <th>Sigla</th>
                                            <th>Acciones</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Rubro</th>
                                            <th>Sigla</th> 
                                            <th>Acciones</th>                       
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php foreach($rubros as $rubro){ ?>
                                        <tr>
                                            <td><?php echo $rubro->id_rubro;?></td>
                                            <td><?php echo $rubro->rubro;?></td>
                                            <td><?php echo $rubro->sigla_rubro;?></td>
                                            <td>
                                                <div class=btn-group>
                                                
                                                
                                                <a class="btn btn-outline-success" href="index.php?seccion=rubro/edt_rubro.php&id=<?php echo $rubro->id_rubro;?>"
                                                data-toggle="tooltip" data-placement="bottom" title=" Editar rubro ">
                                                <i class="fas fa-pencil-alt"> </i>
                                                </a>
                                                
                                                
                                                <a class="btn btn-outline-danger" href="" data-toggle="modal" data-toggle="tooltip"
                                                data-placement="bottom" title=" Dar de baja rubro " data-target="#ModalEditar<?php echo $rubro->id_rubro;?>">
                                                <i class="fas fa-trash-alt"> </i>
                                                </a>
                                        </tr>  
                                        <div class="modal fade" id="ModalEditar<?php echo $rubro->id_rubro; ?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">¿Esta seguro que quiere dar de baja este rubro?</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="index.php?seccion=rubro/rubro_save.php&id_rubro=<?php echo $rubro->id_rubro;?>" autocomplete="off" enctype="multipart/form-data">
                                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light btn-lg" data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-outline-danger btn-lg"><i class="fas fa-trash-alt mr-2"></i>Dar de baja</button>
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

<script>
    $('#dataTable').DataTable({
        "language": {
            "url": "lenguaje.json"
        }
    });
</script>