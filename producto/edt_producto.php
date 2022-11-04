<?php

require_once("accesscontrol.php");


$ErrorMsg = "";
if(isset($_GET["id"])){try{

        $oApi = new API();
        
        if(!empty($_GET["id"])){
            // si el id no es cero es editar de producto
            $productos = $oApi->getproductoById($_GET["id"]);            
            $producto = $productos[0];
            $titulo = "Edición de producto";
        }else{
            // si el id es cero es alta
            $titulo = "Alta de producto";
            $jsonModel = '{
                            "id_producto": 0,
                            "codigo_producto": "",
                            "producto": "",
                            "detalle": "",
                            "id_rubro": ""                          
                        }';


            $producto = json_decode($jsonModel);

        } 

        $rubros = $oApi->getRubrosAll();

    }catch (Exception $e){
        $ErrorMsg =  $e->getMessage();
    }
}else{
    $ErrorMsg = "Falta el parámetro id_producto";
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
        <li class="breadcrumb-item"><a href="./index.php?seccion=productos.php">Administracion de productos</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
    </ol>
</nav>
                    
                    <h1 class="h3 mb-2 text-gray-800">Administración de productos</h1>
                    <p class="mb-4"> </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo $titulo ; ?></h6>
                        </div>
                        <div class="card-body">                            
                            <div>
                               <form id="form_producto" method="post" action="index.php?seccion=producto/producto_save.php">
                                  <!-- 2 column grid layout with text inputs for the first and last names -->
                                  <div class="row mb-4">
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="id_producto" id="id_producto" disabled="" class="form-control"  value="<?php echo $producto->id_producto;?>" />
                                        <input type="hidden" name="id_producto" id="id_producto" class="form-control"  value="<?php echo $producto->id_producto;?>" />
                                        <label class="form-label" for="id_producto">ID</label>
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="codigo_producto" id="codigo_producto" class="form-control" <?php if(!empty($_GET["id"])) echo 'disabled="" ';?>

                                            value="<?php echo $producto->codigo_producto;?>" />
                                        <label class="form-label" for="codigo_producto">Codigo</label>
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="producto" id="producto" class="form-control" value="<?php echo $producto->producto;?>"/>
                                        <label class="form-label" for="producto">Producto</label>
                                      </div>
                                    </div>
                                  </div>

                                    <div class="row mb-4">
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="detalle" id="detalle" class="form-control" value="<?php echo $producto->detalle;?>" />
                                        <label class="form-label" for="detalle">Detalle</label>
                                      </div>
                                    </div>
                                    <div class="col">
                                          <div class="form-outline">
                                          <select class="form-control" name="id_rubro" id="id_rubro">
                                            <?php foreach($rubros as $rubro){ ?>
                                                <option value="<?php echo $rubro->id_rubro;?>">
                                                    <?php echo $rubro->rubro;?></option>
                                                <?php } ?>
                                            </select>
                                          </div>
                                          <label  class="form-label" for="id_rubro">Rubro</label>
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
