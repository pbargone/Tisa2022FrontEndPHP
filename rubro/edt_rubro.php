<?php

require_once("accesscontrol.php");


$ErrorMsg = "";
if(isset($_GET["id"])){try{

        $oApi = new API();
        
        if(!empty($_GET["id"])){
            // si el id no es cero es editar de rubro
            $rubros = $oApi->getRubroById($_GET["id"]);            
            $rubro = $rubros[0];
            $titulo = "Edición de rubro";
        }else{
            // si el id es cero es alta
            $titulo = "Alta de rubro";
            $jsonModel = '{
                            "id_rubro": 0,
                            "rubro": "",
                            "sigla_rubro": ""                        
                        }';


            $rubro = json_decode($jsonModel);

        } 

        $rubros = $oApi->getRubrosAll();

    }catch (Exception $e){
        $ErrorMsg =  $e->getMessage();
    }
}else{
    $ErrorMsg = "Falta el parámetro id_rubro";
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
                            <li class="breadcrumb-item"><a href="./index.php?seccion=rubros.php">Administracion de rubros</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
                        </ol>
                    </nav>
                    <h1 class="h3 mb-2 text-gray-800">Administración de rubros</h1>
                    <p class="mb-4"> </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo $titulo ; ?></h6>
                        </div>
                        <div class="card-body">                            
                            <div>
                               <form id="form_rubro" method="post" action="index.php?seccion=rubro/rubro_save.php">
                                  <!-- 2 column grid layout with text inputs for the first and last names -->
                                  <div class="row mb-4">
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="id_rubro" id="id_rubro" disabled="" class="form-control"  value="<?php echo $rubro->id_rubro;?>" />
                                        <input type="hidden" name="id_rubro" id="id_rubro" class="form-control"  value="<?php echo $rubro->id_rubro;?>" />
                                        <label class="form-label" for="id_rubro">ID</label>
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="rubro" id="rubro" class="form-control" value="<?php echo $rubro->rubro;?>" />
                                        <label class="form-label" for="rubro">Rubro</label>
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="sigla_rubro" id="sigla_rubro" class="form-control" value="<?php echo $rubro->sigla_rubro;?>"/>
                                        <label class="form-label" for="sigla_rubro">Sigla</label>
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
