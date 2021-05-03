<?php

	//|����������������������������������������
	//|	:::::: Documento PHP :::::::
	//|����������������������������������������

	/*
		Estudiante
		|Escuela: Benem�rita Universidad Aut�noma de Puebla
		|Estudiante: Mario A. N��ez Zavala
		|Facebook: ----
		|Twitter: ----
		|Linked in: ----
		|GitHub: ----
	
		Documento
		|Fecha-documento: 2021-03-04
			
		Descripci�n
			Se quiere un programa que permita, al generarse un pedido por parte de un
	                cliente, llenar una factura con los datos necesarios para procesar y registrar
	  		dicho pedido.
                Consideraciones
	                Si es la primera vez que un usuario relaiza un pedido, este tiene que registrarse
                        antes de confirmar su "encargo".
	 		Se solicita al cliente el n�mero de vendedor para que este reciba su comisi�n.
			Este dato puede ser nulo dependiendo de si hay o no un vendedor detr�s de la venta.
                        El inventario (la cantidad de producto) se actualiza antes de emitir el pedido.
                        En la factura adem�s de los datos de quien ordena, tambi�n han de incluirse los datos
			del producto (los relevantes) y el vendedor asociado a la venta de ese producto. 	 	
		Soluci�n propuesta
			1. Se proporciona un formulario que solicite al usuario los detalles del o los producto a
			   pedir.
			2. Se eval�a si este exista en la BBDD.
		          2.1 Si no existe, se pide antes su registro para proceder con su pedido
			3. Se pide el n�mero del vendedor que le atendi�, si no hay tal, se confirma su pedido.
			*Nota: se tiene que evaluar la existencia del producto y de no estar disponible, se le
			       notifica al cliente.
                        4. Si todo est� en orden, se realiza con �xito el pedido.
			5. Con la informaci�n del cliente, el producto el vendedor (si existe) se procede a capturar
			   la factura.
                        *Nota: para facturar, se debe proporcionar la informaci�n de cada pedido.
               Disign
	   		1. Se crea una base de datos relacional con la tabla Cliente, Producto, Vendedor, Pedido, Empleado,
 			   Facturista, Factura y Factura Complemento.
			*Nota: la raz�n por la que nos es conveniente agregar la tabla Factura Complemento, es la de tener
			       un espacio especializado seg�n la carga de informaci�n a distribuir.
  			2. Se emplea la arquitectura MVC y por ende el paradigma POO.
			3. Se trabaja con PHP y tecnolog�as n�cleo front-end.    	 
	*/
	
	
	# En nuestro archivo index.php, mostraremos las salidas al usuario
	# as� como tamb�en las respuestas emitidas por el controlador a sus solicitudes.
        echo "<script src='js/sweetalert.js'></script>";
         
        require_once "Controladores/controlador-plantilla.php";
        require_once "Controladores/controlador-formularios.php";
        require_once "Modelos/modelo-plantilla.php";
        require_once "Modelos/modelo-formularios.php";
          
        $ctr_plantilla = new ControladorPlantilla();
	$ctr_plantilla -> ctrGetPlantilla();

   