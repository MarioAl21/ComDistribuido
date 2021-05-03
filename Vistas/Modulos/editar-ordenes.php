<?php
  if(!isset($_SESSION["validar_loginFac"]))
  {
    echo '<script>
           window.location="index.php"; 
           alert("Identificate primero con tu password!")
         </script>';
    return; 
  }
  else
  {
    if($_SESSION["validar_loginFac"] != "ok")
    {
      echo '<script>
           window.location="index.php"; 
           alert("Identificate primero con tu password");
         </script>';

      return; 
    }
  }
?>

<div class="d-flex justify-content-center text-center">
  <div class="py-4">
    <a href="index.php?vista=editar-ordenes&vista_facturista=ver-facturas" class="btn btn-primary">facturas</a>
    <a href="index.php?vista=editar-ordenes&vista_facturista=clientes-vigencia" class="btn btn-primary">Clientes</a> 
  </div>
</div>

<div class="container">
 
  <?php
    require_once "Controladores/controlador-facturista.php";
    require_once "Modelos/modelo-facturista.php";

    $ctr_facturista = new ControladorFacturista();
    $ctr_facturista -> ctrGetVista();            
  ?>

</div>
  