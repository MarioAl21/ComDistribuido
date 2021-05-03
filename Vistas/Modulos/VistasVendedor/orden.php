<?php
  if(!isset($_SESSION["validar_login"]))
  {
    echo '<script>
           window.location="index.php"; 
           alert("Identificate primero con tu id de vendedor");
         </script>';
    return; 
  }
  else
  {
    if($_SESSION["validar_login"] != "ok")
    {
      echo '<script>
           window.location="index.php"; 
           alert("Identificate primero con tu id de vendedor")
         </script>';
      return; 
    }
  }
  if($_SESSION["idVendedor"] != $_GET["id"]) // El id del vendedor no puede ser manipulado por la variable GET en la URL
  {
    $_GET["id"] = $_SESSION["idVendedor"];	    
    header("location: index.php?vista=orden&id=$_GET[id]");
  }

  $tabla = "productos";    	
  $productos = ControladorFormularios::ctrGetRegistro($tabla, null, null, null, null);
  $tam = sizeof($productos);

  $tabla = "clientes";
  $clientes = ControladorFormularios::ctrGetRegistro($tabla, null, null, null, null);

  if(isset($_GET["id"])) $idVen = $_GET["id"];
  
?>

<div class="container">
  <div class="row"> 
    <div class="col-md-8 col-md-offset-2">
      <div class="card-body d-flex justify-content-between align-items-center">
        <button class="btn btn-primary btn-sm" id="btn-pop">Verficar cliente</button>
     </div>
    </div>
  </div>
</div>


<div class="d-flex justify-content-center text-center">

  <form class="p-5 bg-light" onsubmit="return validar();" method="post">

    <div class="form-group">
      <label for="idProducto">#Producto:</label>
       
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-key"></i></span>
        </div>

        
        <select class="form-control" id="idProducto" name="id_pro">  
                 

        <?php foreach($productos as $key => $dato): ?>
          <option><?php echo $dato["id_producto"]; ?></option>
	<?php endforeach ?> 

        </select> 
      </div>  
    </div>

    <div class="form-group">
      <label for="cant">Cantidad:</label>
    
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-shopping-cart"></i></span>
        </div>

        <?php 
          if(isset($_POST["id_pro"]))
          {
            $item = "id_producto";
	    $dato = $_POST["id_pro"];
            $tipo = PDO::PARAM_INT; 
            $producto = ControladorFormularios::ctrGetRegistro($tabla, $item, $dato, $tipo, null);
	    $cant = $producto["cantidad"];
	  }
          else
           $cant = $productos[0]["cantidad"]; 
        ?>
        <input type="number" class="form-control" value="<?php echo $cant; ?>" id="cant" name="cantidad_pro" required /> 

      </div>

    </div>

    <div class="form-group">
      <label for="idCliente">#Cliente:</label>
       
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-key"></i></span>
        </div>
        <select class="form-control" id="idCliente" name="id_cli">

        <option>Registrar cliente</option>        
        <?php foreach($clientes as $key => $dato): ?> 
          <option nombre_persona="<?php echo $dato['nombre'] ?>" ciudad_persona="<?php echo $dato['ciudad']; ?>"><?php echo $dato["id_cliente"]; ?></option>
        <?php endforeach ?> 

        </select>
      </div>  

    </div>

    <div class="form-group down-fields">
      <label for="cliente">Nombre de Cliente:</label>
    
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-address-card"></i></span>
        </div>
         
        <input type="text" class="form-control" id="cliente" name="nombre_cli"> 
      </div>
    </div>

    <div class="form-group down-fields">
      <label for="ciudad">Destino:</label>
    
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-shipping-fast"></i></span>
        </div>
          <input type="text" class="form-control" id="ciudad" name="ciudad_cli"> 
      </div>
    </div>
 
    <?php
      $registrar_cliente = new ControladorFormularios();

      //llamados 
      $registrar_cliente -> ctrRegistrarCliente($idVen);	 
    ?>

    <button type="submit" class="btn btn-primary">Realizar Venta</button>
  </form>

</div>

<div class="container-fluid">
  <div class="container py-5">
    <table class="table table-striped" id="product-table-sell">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Cantidad</th>
          <th>Precio</th>
          <th>Descuento</th>
        </tr>
      </thead>
      <tbody>

	<?php foreach($productos as $key => $dato): ?>

        <tr>
          <td><?php echo $dato["id_producto"] ?></td>
          <td id = "nom_pro"><?php echo $dato["nombre_producto"]; ?></td>
          <td original_quantity='<?php echo $dato["cantidad"]; ?>'
              class='change-on-decrement-<?php echo $dato['id_producto']; ?>'>
              <?php echo $dato["cantidad"]; ?></td>
          <td><?php echo $dato["precio_venta"]; ?></td>
          <td>
          <?php 
            if($dato["descuento"] != null) echo $dato["descuento"]."%";
            else echo "No tiene descuento"; 
          ?>
          </td>
        </tr>

        <?php endforeach ?>	

      </tbody>
    </table>
  </div>
</div>

<div class="overlay" id="overlay">
  <div class="popup" id="popup">
    <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
    <h3>Registro de cliente</h3>
    <h4>Datos</h4>
     <form class="form-group">
      <div class="contenedor-inputs">
        <label class="num_pop"><h5>#Cliente</h5></label>
        <input type="number" class="num_pop" id="idcli_pop" />
        <label><h5>Nombre</h5></label>
        <input type="text" id="nom_pop" />
        <label><h5>Ciudad</h5></label>
        <input type="text" id="ciudad_pop" />
      </div> 
    </form>
  </div>
</div>

<script src="js/popup.js"></script>
<script src="js/validar.js"></script>

<link rel="stylesheet" href="css/principal.css" />  
 