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
  $stmt = "SELECT DISTINCT DATE_FORMAT(fecha, '%y-%m') FROM ".$tabla;
    	
  $ordenes = ControladorFormularios::ctrGetRegistro(null, null, null, null, $stmt);
?>
 
<div class="d-flex justify-content-center text-center">

  <form class="p-5 bg-light" method="post">

    <div class="form-group ">       
      <label for="rol">Elegir por fecha:</label>
 
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-table"></i></span>
        </div>

         <select class="form-control" id="date" name="fecha">
	 <?php if($ordenes != "") foreach($ordenes as $key => $dato): ?>
           <option><?php echo $dato[0] ?></option>
         <?php endforeach ?>
         </select>

       </div>

      </div>
 
    <button type="submit" class="btn btn-primary">Acceder</button>   

  </form>    
</div>

<?php

  if(isset($_POST['fecha'])) { 
    $stmt = "SELECT * FROM ordenes WHERE fecha LIKE '%".$_POST['fecha']."%'";
    $facturas = ControladorFormularios::ctrGetRegistro($tabla, null, null, null, $stmt);
?>

<div class="py-5" id="tabla_facturas">
  <table class="table table-striped">
      <thead>
        <tr>
          <th>#Orden</th>
          <th>Fecha</th>
          <th>Receptor</th>
          <th>Ciudad</th>
          <th>Id Cliente</th>
	  <th>Emisor</th>
          <th>Seleccionar</th> 
        </tr>
      </thead>
      <tbody>


      <?php foreach($facturas as $key => $dato): ?> 
        <tr>
          <td><?php echo $dato["id_orden"]; ?></td>
          <td><?php echo $dato["fecha"]; ?></td>
          <td><?php echo $dato["receptor"]; ?></td>
          <td><?php echo $dato["ciudad"]; ?></td>
          <td><?php echo $dato["id_cliente"]; ?></td>
         
          <td>Depto. Ventas</td>
	  <td>
	    <div class="btn-group">
              <div class="px-1">
                <a href="index.php?vista=abrir-factura&idfactura=<?php echo $dato["id_orden"]; ?>" class="btn btn-info"><i class="fas fa-folder-open"></i></a>
	      </div>
          </td>
        </tr>	
        <?php endforeach ?>

      </tbody>
    </table>

</div>

<?php } ?>   