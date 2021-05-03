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
           alert("Identificate primero con tu password.")
         </script>';
      return; 
    }
  }
    
  $orden = ControladorFormularios::ctrGetRegistro("ordenes", "id_orden", $_GET['id'], PDO::PARAM_INT, null);
  $cliente = ControladorFormularios::ctrGetRegistro("clientes", "id_cliente", $orden['id_cliente'], PDO::PARAM_INT, null);
   
?>

<div class="d-flex justify-content-center text-center">

    <form class="p-5 bg-light" method="post">
      <div class="form-group">

        <div class="input-group">
	  <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
          </div>
          <input type="text" class="form-control" id="id_cli" placeholder="<?php echo 'Update '.$cliente['nombre']; ?>" name="nuevo_nombre" />
          <input type="hidden" value="<?php echo $cliente['nombre']; ?>" name="actual_nombre" />    
	</div>

      </div>

      <div class="form-group">

	<div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
          </div>
          <input type="text" class="form-control" id="ciudad" placeholder="Update <?php echo $cliente['ciudad']; ?>" name="nueva_ciudad" /> 
          <input type="hidden" value="<?php echo $cliente['ciudad']; ?>" name="actual_ciudad" />
	</div>

      </div>
        
      <div class="form-group">  

        <div  class="input-group">      
         <div class="input-group-prepend">
           <span class="input-group-text"><i class="fas fa-lock"></i></span>
         </div>
         <input type="password" class="form-control" id="vigencia" placeholder="Update <?php echo $cliente['vigencia']; ?>" name="nueva_vigencia">

         <input type="hidden" name="actual_vigencia" value="<?php echo $cliente['vigencia']; ?>" />
         <input type="hidden" name="id_cliente" value="<?php echo $cliente['id_cliente']; ?>">  
       </div>

      </div>

      <?php
        $update = new ControladorFormularios();
        $update -> ctrUpdateRegistro(); 
      ?>

      <button type="submit" class="btn btn-primary">actualizar</button>
    </form>

</div>

