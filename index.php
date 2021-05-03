<?php

	//|••••••••••••••••••••••••••••••••••••••••
	//|	:::::: Documento PHP :::::::
	//|••••••••••••••••••••••••••••••••••••••••

	/*
		Estudiante
		|Escuela: Benemérita Universidad Autónoma de Puebla
		|Estudiante: Mario A. Núñez Zavala
		|Facebook: ----
		|Twitter: ----
		|Linked in: ----
		|GitHub: ----
	
		Documento
		|Fecha-documento: 2021-03-04
			
		Descripción
			Se quiere un programa que permita, al generarse un pedido por parte de un
	                cliente, llenar una factura con los datos necesarios para procesar y registrar
	  		dicho pedido.
                Consideraciones
	                Si es la primera vez que un usuario relaiza un pedido, este tiene que registrarse
                        antes de confirmar su "encargo".
	 		Se solicita al cliente el número de vendedor para que este reciba su comisión.
			Este dato puede ser nulo dependiendo de si hay o no un vendedor detrás de la venta.
                        El inventario (la cantidad de producto) se actualiza antes de emitir el pedido.
                        En la factura además de los datos de quien ordena, también han de incluirse los datos
			del producto (los relevantes) y el vendedor asociado a la venta de ese producto. 	 	
		Solución propuesta
			1. Se proporciona un formulario que solicite al usuario los detalles del o los producto a
			   pedir.
			2. Se evalúa si este exista en la BBDD.
		          2.1 Si no existe, se pide antes su registro para proceder con su pedido
			3. Se pide el número del vendedor que le atendió, si no hay tal, se confirma su pedido.
			*Nota: se tiene que evaluar la existencia del producto y de no estar disponible, se le
			       notifica al cliente.
                        4. Si todo está en orden, se realiza con éxito el pedido.
			5. Con la información del cliente, el producto el vendedor (si existe) se procede a capturar
			   la factura.
                        *Nota: para facturar, se debe proporcionar la información de cada pedido.
               Disign
	   		1. Se crea una base de datos relacional con la tabla Cliente, Producto, Vendedor, Pedido, Empleado,
 			   Facturista, Factura y Factura Complemento.
			*Nota: la razón por la que nos es conveniente agregar la tabla Factura Complemento, es la de tener
			       un espacio especializado según la carga de información a distribuir.
  			2. Se emplea la arquitectura MVC y por ende el paradigma POO.
			3. Se trabaja con PHP y tecnologías núcleo front-end.    	 
	*/
	
	
	# En nuestro archivo index.php, mostraremos las salidas al usuario
	# así como tambíen las respuestas emitidas por el controlador a sus solicitudes.
        echo "<script src='js/sweetalert.js'></script>";
         
        require_once "Controladores/controlador-plantilla.php";
        require_once "Controladores/controlador-formularios.php";
        require_once "Modelos/modelo-plantilla.php";
        require_once "Modelos/modelo-formularios.php";
          
        $ctr_plantilla = new ControladorPlantilla();
	$ctr_plantilla -> ctrGetPlantilla();

   