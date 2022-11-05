<?php

//require_once("accesscontrol.php");


?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



<script>
$('.openBtn').on('click',function(){
    $('.modal-body').load('index.php?seccion=producto/pickProducto.php',function(){
        $('#ModalPickProducto').modal({show:true});
    });
});
</script>



              
<!-- /.acá poner el form yu cargarle los valores -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Administración de productos</h1>
    <p class="mb-4"> </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Carga de remito</h6>
        </div>
        <div class="card-body">                            
            <div>
               <form id="form_producto" method="post" action="index.php?seccion=producto/producto_save.php">
                  <!-- 2 column grid layout with text inputs for the first and last names -->
                  <div class="row mb-4">
                    <div class="col">
                      <div class="form-outline">
                        <input type="text" name="codigo_producto" id="codigo_producto" class="form-control"  value="" />
                        <label class="form-label" for="id">ID</label>
                        <button type="button" class="btn btn-success openBtn">Buscar</button>
                        <!-- Modal -->
                        <div class="modal fade" id="ModalPickProducto" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                        <h4 class="modal-title">Seleccione producto</h4>
                                    </div>
                                    <div class="modal-body">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
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

