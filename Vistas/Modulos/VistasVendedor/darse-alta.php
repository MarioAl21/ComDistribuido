<div class="d-flex justify-content-center text-center">

  <form class="p-5 bg-light" method="post">

    <div class="from-group"> 
      <!-- ú=&#250 -->      
      <label for="idv">Activa tu N&#250mero de vendedor:</label>
    
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-id-card-alt"></i></span>
        </div>
          <input type="text" class="form-control" id="idv" name="id_vend"> 
      </div>
    </div>

    <div class="form-group">
      <label for="pass">Registra tu contrase&#241a:</label>
    
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-lock"></i></span>
        </div>
          <input type="text" class="form-control" id="pass" name="pwd_vend"> 
      </div>

    </div>

    <?php

      if
      (
        isset($_POST["seller_number"]) && isset($_POST["seller_pwd"]) &&
        !empty($_POST["seller_number"]) &&
	!empty($_POST["seller_pwd"])
      )
      {

        echo '<script>

  	       if(window.history.replaceState)// if the browser has info in its historical, delete it
	         window.history.replaceState(null, null, location.href);	

	     </script>';	
        
        echo '<div class="alert alert-success">Alta de vendedor'.$_POST["seller_number"].' exitosa</div>';
      } 	 
 
    ?>

    <button type="submit" class="btn btn-primary">Alta</button>
    
  </form>

<div>
