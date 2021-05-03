<?php
  //echo "<script src='../js/sweetalert.js'></script>";
  
  class ControladorFormularios
  { 
    /*============================
    Seleccionar datos (CRUD READ) 
    =============================*/
    public static function ctrGetRegistro($tabla, $item, $dato, $tipo, $stmt)
    {
      $consulta = ModeloFormularios::mdlGetRegistro($tabla, $item, $dato, $tipo, $stmt);

      return $consulta;  
    } 

    /*===================================
    Registrar Cliente
    ===================================*/   
    public function ctrRegistrarCliente($idVendedor)
    {
      if(isset($_POST["nombre_cli"]))
      { 
        if(!empty($_POST["nombre_cli"]) && !empty($_POST["ciudad_cli"])) 
        {  
             
          // Se verifica que haya un id qué buscar y así no repetir registros! 
          if($_POST["id_cli"] == 'Registrar cliente') 
          {
            $tabla = "clientes";
            $datos = array("nombre" => $_POST["nombre_cli"],
		           "ciudad" => $_POST["ciudad_cli"]  
			  ); 
             // Procedemos a registrarlo en la tabla clientes
	     $resultado_reg = ModeloFormularios::mdlRegistrarCliente($tabla, $datos, null, null, null, null);
              
             // Evaluamos el resultado
             if($resultado_reg == "registrado")
               echo "<script>
		    if(window.history.replaceState)
                      window.history.replaceState(null, null, window.location.href);
                  </script>
                  <div class='alert alert-success'>Cliente Registrado</div>";
             else
               echo "<div class='alert alert-danger'>El cliente ya existe</div>"; 	
          }   
 
          // se busca el id del cliente dentro de toda la tabla para levantar el pedido            
          $cliente = ModeloFormularios::mdlGetRegistro("clientes", "nombre", $_POST["nombre_cli"], PDO::PARAM_STR, null);

          $tabla = "ordenes";
          $datos = array("id" => $cliente["id_cliente"],
                         "nombre" => $_POST["nombre_cli"],
                         "ciudad" => $_POST["ciudad_cli"]
			);                       

          $respuesta_ord = ModeloFormularios::mdlRegistrarCliente(null, null, $tabla, $datos, null, null); // se registra la orden a nombre de
                              
          if($respuesta_ord == "orden registrada")
            echo "<script>
		    if(window.history.replaceState)
                      window.history.replaceState(null, null, window.location.href);
                  </script>
                  <div class='alert alert-success'>Orden registrada</div>";
          else
            echo "<div class='alert alert-danger'>La orden no se registro</div>"; 

          // Se busca el id del producto
          $producto = ModeloFormularios::mdlGetRegistro("productos", "id_producto", $_POST['id_pro'], PDO::PARAM_INT, null);
          
          $importe = $producto['precio_venta'] * $_POST['cantidad_pro'];

          if($producto['descuento'] != null) $importe = $importe - (($importe * $producto['descuento'])/100);                           
 
          $ordenes = ModeloFormularios::mdlGetRegistro("ordenes",  null, null, null, null);
     
          foreach($ordenes as $key => $dato)
            $orden = $dato[0];

          $tabla = "pedidos";
          $datos = array("idpedido" => $orden,	
			 "idp" => $producto['id_producto'],
	 		 "cant" => $_POST['cantidad_pro'],
			 "import" => $importe,
                         "idv" => $idVendedor	 
                   );

          ModeloFormularios::mdlRegistrarCliente(null, null, null, null, $tabla, $datos);
          
          // Actualizamos el registro de la cantidad de producto vendidos
          $nueva_cantidad = $producto['cantidad'] - $_POST['cantidad_pro'];
 
          $tabla = "productos";
          $item = "cantidad";
          $dato = $producto['id_producto'];
          $nuevo = $nueva_cantidad;

          $actualiza = ModeloFormularios::mdlUpdateRegistro($tabla, $item, $dato, $nuevo, null);

          if($actualiza == "actualizado")
            echo '<script>
	  	   if(window.history.replaceState) 
                     window.history.replaceState(null, null, window.location.href);         

                   setTimeout(function(){ location.reload(); }, 3000);
                 </script>';  

        }
        else
        {
          $message = ""; 
          if(empty($_POST["nombre_cli"]))
            $message .= "Se te olvidado el nombre del cliente <br />";    
          if(empty($_POST["ciudad_cli"]))
            $message .= "Se te olvidado la ciudad del cliente";

          echo "<script>
		  if(window.history.replaceState)
                    window.history.replaceState(null, null, window.location.href);
                </script>
                <div class='alert alert-warning'>$message</div>";
        }  
      }



    } // ctrRegistroCliente   

    /*=========================
    Validar Ingreso al vendedor
    que solicita acceso 
    =========================*/
    public function ctrLoginVendedor()
    {
      if(isset($_POST["id_vend"]))
      { 
        if(!empty($_POST["id_vend"]))
        {  
          $tabla = "vendedores";
          $item = "id_vendedor";
          $dato = $_POST["id_vend"];
          $tipo = PDO::PARAM_INT;
        
          $vendedor = ModeloFormularios::mdlGetRegistro($tabla, $item, $dato, $tipo, null); 
 
          if(empty($vendedor))
          {
            echo "<script>
                   if(window.history.replaceState)
		     window.history.replaceState(null, null, window.location.href); 	
		  </script>";        
	    echo "<div class='alert alert-danger'>N&#250mero de vendedor no existe</div>";
            return;
          }

          $tabla = "empleados";
          $item = "id_empleado";
          $dato = $vendedor["id_empleado"];      

          $empleado = ModeloFormularios::mdlGetRegistro($tabla, $item, $dato, $tipo, null); 
          if(empty($vendedor)) return;       
  
          if($empleado["id_empleado"] == $vendedor["id_empleado"] && $_POST["pwd_vend"] == $empleado["password"]) 
          {
            $_SESSION["validar_login"] = "ok";
            $_SESSION["idVendedor"] = $vendedor["id_vendedor"];
     
            echo '<script>
	           if(window.history.replaceState)
                     window.history.replaceState(null, null, window.location.href);  
                   
	          // window.location = "index.php?vista=orden";     
	         </script>';
 
            header("location: index.php?vista=orden&id=$_POST[id_vend]");   
          } 
	  else 
          {
            echo "<script>
                   if(window.history.replaceState)
		     window.history.replaceState(null, null, window.location.href); 	
		  </script>";
           echo "<div class='alert alert-danger'>password incorrecto</div>";        
          }
        }
        else
        {     
          echo "<script>
                 if(window.history.replaceState)
		   window.history.replaceState(null, null, window.location.href); 	
	       </script>";
          echo "<div class='alert alert-warning'>No olvides tu n&#250mero de vendedor!</div>";        
        }          

      } // Main IF end
        
    } // ctrLoginVendedor end

    /*=========================
    Actualizar U(Update)
    =========================*/
    public static function ctrUpdateRegistro()
    {

      if(isset($_POST["nuevo_nombre"]))
      {
        if
        (
          empty($_POST["nuevo_nombre"]) && 
          empty($_POST["nueva_ciudad"]) && 
          empty($_POST["nueva_vigencia"])
        )
        { 
          echo "<div class='alert alert-warning'>Nothing to update :(</div> 
          <script> setTimeout(function(){ window.location='index.php?vista=editar-ordenes';}, 3000); 
          </script>";
 
          return;
        }
  
        if(empty($_POST["nuevo_nombre"]))
         $nombre = $_POST["actual_nombre"];
        else
         $nombre = $_POST["nuevo_nombre"];

        if(empty($_POST["nueva_ciudad"]))
         $ciudad = $_POST["actual_ciudad"];
        else
         $ciudad = $_POST["nueva_ciudad"];    

        if($_POST["nueva_vigencia"] != "")
          $vigencia = $_POST["nueva_vigencia"];
        else 
          $vigencia = $_POST["actual_vigencia"];

        $tabla = "clientes";
        $data = array("id" => $_POST["id_cliente"],
		      "nom" => $nombre,
                      "ciu" => $ciudad,
		      "vig" => $vigencia
		     );
              
        $answer = ModeloFormularios::mdlUpdateRegistro($tabla, null, null, null, $data);  
	
        if($answer == "ok")
        {
          echo '<script>
		  if(window.history.replaceState) 
                    window.history.replaceState(null, null, window.location.href);        
	       </script> 

               <div class="alert alert-success">User has been updated successfully</div> 

               <script>
                 setTimeout(function() { window.location = "index.php?vista=editar-ordenes"; }, 3000);
               </script>'; 
 
        }
      }   

    } // end Update


    /*==========================
    Borrar facturas	
    ==========================*/
    public function ctrDeleteRegistro()
    {
      if(isset($_POST["delete_record"]))
      {
        $tabla = "ordenes";
        $dato = $_POST["delete_record"];  

        $answer = ModeloFormularios::mdlDeleteRegistro($tabla, $dato);

        if($answer == "ok") 
          echo "<script>
                 if(window.history.replaceState)
                   window.history.replaceState(null, null, window.location.href);
                 
		 swal('Borrado exitoso', 'Factura eliminada con éxito', 'success');
                 setTimeout(function(){ window.location='index.php?vista=ver-facturas'; }, 3000); 
               </script>";
      }         

    }
    
  } // end ControladorFormularios class	  