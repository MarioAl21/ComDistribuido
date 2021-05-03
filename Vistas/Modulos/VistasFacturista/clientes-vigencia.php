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
   

  $tabla = "ordenes";  
  $stmt = "SELECT * FROM ".$tabla." WHERE fecha >= DATE_ADD(NOW(), interval -182 day)";
    	
  $ordenes = ControladorFormularios::ctrGetRegistro(null, null, null, null, $stmt);

  $tabla = "clientes";
  $stmt = "SELECT * FROM ".$tabla;
    	
  $clientes = ControladorFormularios::ctrGetRegistro(null, null, null, null, $stmt);
?>

<div class="container">
  <div class="row"> 
    <div class="col-md-8 col-md-offset-2">
      <div class="card-body d-flex justify-content-between align-items-center">
        <button class="btn btn-primary btn-sm" id="btn-pop">Consultar clientes</button>
     </div>
    </div>
  </div>
</div>
 
<div class="py-5" id="tabla_facturas">
  <table class="table table-striped">
      <thead>
        <tr>
          <th>#Cliente</th>
          <th>Ciudad</th>
          <th>Vigencia</th> 
        </tr>
      </thead>
      <tbody>


      <?php foreach($ordenes as $key => $dato): ?> 
        <tr>
          <td><?php echo $dato["id_cliente"]; ?></td>
          <td><?php echo $dato["ciudad"]; ?></td>
          <td><?php echo $dato["fecha"]; ?></td>
         
      <?php endforeach ?>

     </tbody>
   </table>

</div>

<div class="overlay" id="overlay">
  <div class="popup" id="popup">

  <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
    
  <div class="py-5 tablaClientes" id="tabla_facturas">
  <table class="table table-striped">
      <thead>
        <tr>
          <th>#Cliente</th>
          <th>Nombre</th>
          <th>Ciudad</th>
          <th>Vigencia</th> 
        </tr>
      </thead>
      <tbody>


      <?php foreach($clientes as $key => $dato): ?> 
        <tr>
          <td><?php echo $dato["id_cliente"]; ?></td>
	  <td><?php echo $dato["nombre"]; ?></td>	
          <td><?php echo $dato["ciudad"]; ?></td>
          <td><?php echo $dato["vigencia"]; ?></td>
         
      <?php endforeach ?>

     </tbody>
   </table>      

  </div>
</div>

<script src="js/popup.js"></script>
<link rel="stylesheet" href="css/principal.css" />   