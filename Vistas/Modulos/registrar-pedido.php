<div class="d-flex justify-content-center text-center">
  <div class="py-4">
    <a href="index.php?vista=registrar-pedido&vista_vend=darse-alta" class="btn btn-primary">Darse de alta</a>
    <a href="index.php?vista=registrar-pedido&vista_vend=ingresar" class="btn btn-primary">Ingresar</a> 
  </div>
</div>

<div class="container">
 
  <?php
    require_once "Controladores/controlador-vendedor.php";
    require_once "Modelos/modelo-vendedor.php";

    $ctr_vendedor = new ControladorVendedor();
    $ctr_vendedor -> ctrGetVista();            
  ?>

</div>
