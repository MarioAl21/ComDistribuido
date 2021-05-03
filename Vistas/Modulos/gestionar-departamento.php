<?php
  $tabla = "empleados";
  $item = "puesto";
  $puestos = ControladorFormularios::ctrGetRegistro($tabla, $item, null, null, null);
?>

<div class="d-flex justify-content-center text-center">

  <form class="p-5 bg-light" method="post">

    <div class="form-group">       
      <label for="rol">Ingresar puesto:</label>
 
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-id-card-alt"></i></span>
        </div>

        <select class="form-control" id="rol" name="puesto">
	<?php foreach($puestos as $key => $dato): ?>
          <option value='<?php echo $dato["puesto"]; ?>'><?php echo $dato["puesto"]; ?></option>
        <?php endforeach ?>
       
        </select>
      </div>
    </div>

    <div class="form-group passwd-form">
      <label for="key">Contrase&#241a</label>
     
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-lock"></i></span> 
        </div>
	  
        <input type="password" class="form-control" id="key" name="pwd">
      </div>
    </div>

    <?php
      if(isset($_POST["puesto"]))
      {
       $puesto = $_POST["puesto"];
            
       if($puesto == "Vendedor")
	    echo "<script>
                       if(window.history.replaceState)
                         window.history.replaceState(null, null, window.location.href);
                          
	               window.location = 'index.php?vista=registrar-pedido'; 	       
                     </script>";
       if(!empty($_POST["pwd"]))
       {
          $item = "password";
          $password = $_POST["pwd"]; 
          $respuesta = ControladorFormularios::ctrGetRegistro($tabla, $item, $password, PDO::PARAM_STR, null);
         
         if(($respuesta["password"] == $password) && ($respuesta["puesto"] == $puesto))
          {
            switch($puesto)
            {
              case "Gerente": 
	        $_SESSION["validar_loginGere"] = "ok";
 
 	        echo "<script>
                        if(window.history.replaceState)
                        window.history.replaceState(null, null, window.location.href);
                            
	              window.location = 'index.php?vista=reporte-ventas'; 	       
                    </script>";
 
 	      break;
	      case "Facturista":
                $_SESSION["validar_loginFac"] = "ok";
 
 	        echo "<script>
                        if(window.history.replaceState)
                        window.history.replaceState(null, null, window.location.href);
                            
	              window.location = 'index.php?vista=editar-ordenes'; 	       
                    </script>";
	      break;
	      case "Almacenista": 
		"<script>
                       if(window.history.replaceState)
                         window.history.replaceState(null, null, window.location.href);
                          	       
                     </script>";
	      break;	
	      case "HHRR": 
	  	echo "<div class='alert alert-success'>Hi HHRR</div>";
	      break;
	      default: echo "<div class='alert alert-danger'>Qui&#233n eres!</div>";	  
            }
          }
          else 
            echo "<script>
		   if(window.history.replaceState) 
	   	     window.history.replaceState(null, null, window.location.href);	
	          </script>
                  <div class='alert alert-danger'>contrase&#241a incorrecta</div>";          
        } 
        else 
          echo "<script>
	         if(window.history.replaceState) 
	   	   window.history.replaceState(null, null, window.location.href);	
	        </script>
                <div class='alert alert-warning'>No olvides tu contrase&#241a</div>";  
    }
    ?> 

    <button type="submit" class="btn btn-primary">Ingresar</button>
    
  </form>

</div>