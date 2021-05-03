<div class="d-flex justify-content-center text-center">

  <form class="p-5 bg-light" method="post">

    <div class="form-group">
      <label for="idv">N&#250mero de vendedor:</label>
    
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-id-card-alt"></i></span>
        </div>
          <input type="text" class="form-control" id="idv" name="id_vend" />
      </div>

    </div>

    <div class="form-group">
      <label for="pass">Contrase&#241a:</label>
    
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-lock"></i></span>
        </div>
          <input type="password" class="form-control" id="pass" name="pwd_vend"> 
      </div>

    </div>


    <?php	 
      $login = new ControladorFormularios();
      $login -> ctrLoginVendedor();       
    ?>

    <button type="submit" class="btn btn-primary">Ingresar</button>    
  </form>

<div>