<?php
  session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Pedido</title>
 
    <!----------------------------------
    CSS PLUGINS 
    -----------------------------------> 
   
    <!-- css pluggin -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    

  </head>
  <body>

    <!----------------------------------
    LOGO 
    ----------------------------------->
    <div class="container-fluid">
      <h2 class="text-center py-3"><i class="fab fa-accusoft"></i></h2>
    </div>
    
    <!----------------------------------
    Buttons/Nav options 
    ----------------------------------->
    <div class="container-fluid bg-light">
      <div class="container">

        <ul class="nav nav-justified py-2 nav-pills">
   
        <?php if(isset($_GET["vista"])): ?>      

          <!--Vendedores Menu--> 
          <?php if($_GET["vista"] == "registrar-pedido"): ?>
 	    <li class="nav-item">
	      <a class="nav-link active" href="index.php?vista=registrar-pedido">Registrar Pedido</a>	
	    </li>
	  <?php endif ?>

          <?php if($_GET["vista"] == "orden"): ?>
 	    <li class="nav-item">
	      <a class="nav-link active" href="index.php?vista=orden">Orden</a>	
	    </li>
          <?php endif ?>

	  <?php if($_GET["vista"] == "gestionar-departamento"): ?>
	    <li class="nav-item">
	      <a class="nav-link active" href="index.php?vista=gestionar-departamento">Gestionar departamento</a>
	    </li>
          <?php endif ?>

	  <?php if($_GET["vista"] == "editar-ordenes" ||
	 	   $_GET["vista"] == "ver-facturas" || 
	           $_GET["vista"] == "abrir-factura" || 
		   $_GET["vista"] == "editar-factura"): ?>
	    <li class="nav-item">
	      <a class="nav-link active" href="index.php?vista=editar-ordenes">Facturas</a>
	    </li>
          <?php endif ?>
         
          <?php if($_GET["vista"] != "registrar-pedido" && 
	    	   $_GET["vista"] != "orden" && 
                   $_GET["vista"] != "editar-ordenes" &&
                   $_GET["vista"] != "abrir-factura" &&
		   $_GET["vista"] != "editar-factura" &&
		   $_GET["vista"] != "gestionar-departamento"): ?>    
            <li class="nav-item">
	      <a class="nav-link" href="index.php?vista=gestionar-departamento">Gestionar departamento</a>
	    </li> 
          <?php endif ?>
       
          <?php if($_GET["vista"] == "salir"): ?>  
            <li class="nav-item">
	      <a class="nav-link active" href="index.php?vista=salir">Exit</a>
	    </li>
          <?php else: ?>
	    <li class="nav-item">
	      <a class="nav-link" href="index.php?vista=salir">Exit</a>
	    </li>
	  <?php endif ?>  
          
        <?php else: ?>
            <a class="nav-link active" href="index.php?vista=gestionar-departamento">Gestionar Departamento</a>
          </li>
          <li class="nav-item">
	      <a class="nav-link" href="index.php?vista=salir">Exit</a>
	  </li>
	
        <?php endif ?>

	</ul>
      </div>
    </div>
    
    <!----------------------------------
    Content/Request View
    ----------------------------------->    
    <div class="container-fluid">
      <div class="container py-5">
      <?php
          $ctr_plantilla = new ControladorPlantilla();
          $ctr_plantilla -> ctrGetVista();              
      ?>
      </div>
    </div>

    <!----------------------------------
    scripts
    ----------------------------------->	

    
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    <!-- Sript Font Awesome(latest compiled) -->
    <script src="https://kit.fontawesome.com/a6fb1f4ccf.js" crossorigin="anonymous"></script>
   
    <script src="Assets/scripts/scripts.js"></script>	
   
  </body>
</html>