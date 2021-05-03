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
   

  if(isset($_GET['idfactura']))
  {
    $id = $_GET['idfactura']; 
    $factura = ControladorFormularios::ctrGetRegistro("ordenes", "id_orden", $_GET['idfactura'], PDO::PARAM_INT, null);
    $factura2 = ControladorFormularios::ctrGetRegistro("pedidos", "id_pedido", $factura['id_orden'], PDO::PARAM_INT, null);
    
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
          <th>Editar</th> 
        </tr>
      </thead>
      <tbody>

        <tr>
          <td><?php echo $factura["id_orden"]; ?></td>
          <td><?php echo $factura["fecha"]; ?></td>
          <td><?php echo $factura["receptor"]; ?></td>
          <td><?php echo $factura["ciudad"]; ?></td>
          <td><?php echo $factura["id_cliente"]; ?></td>
         
          <td>Depto. Ventas</td>
	  <td>
	  
	    <div class="btn-group">
              <div class="px-1">
                <a href="index.php?vista=editar-factura&id=<?php echo $id; ?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
	      </div>

	      <form method="post">

                <input type=hidden value="<?php echo $factura["id_orden"]; ?>" name="delete_record" />
  
      	        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button> 

                <?php
                  $delete = new ControladorFormularios();
                  $delete -> ctrDeleteRegistro(); 
                ?> 

	      </form>	
            </div>

          </td>
        </tr>	

      </tbody>
    </table>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#Pedido</th>
          <th>#Producto</th>
          <th>Cantidad</th>
          <th>Importe</th>
          <th>#Vendedor</th>
          <th>Comisión</th> 
        </tr>
      </thead>
      <tbody>

        <tr>
          <td><?php echo $factura2["id_pedido"]; ?></td>
          <td><?php echo $factura2["id_producto"]; ?></td>
          <td><?php echo $factura2["cantidad"]; ?></td>
          <td><?php echo $factura2["importe"]; ?></td>
          <td><?php echo $factura2["id_vendedor"]; ?></td>
          <td><?php if($factura2["comision"] == null) echo "Sin"; else echo $factura2["comision"]; ?></td>
        </tr>	

      </tbody>
    </table>

</div>


<?php } ?>   