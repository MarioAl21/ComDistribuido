<?php

  class ModeloPlantilla
  {
    /*--------------------
    Providing view 	 
    --------------------*/
    public static function mdlGetVista($vista)
    {
      if
      (
       $vista == "gestionar-departamento" ||
       $vista == "registrar-pedido" ||	 	
       $vista == "salir"  ||
       $vista == "editar-ordenes"   
      )
        $vista = "Vistas/Modulos/".$vista.".php";
      else if($vista == "orden")  
        $vista = "Vistas/Modulos/VistasVendedor/".$vista.".php";
      else if(
               $vista == "abrir-factura" ||
               $vista == "editar-factura"	
             ) 
	$vista = "Vistas/Modulos/VistasFacturista/".$vista.".php";
      else if($vista == "reporte-ventas")
        $vista = "Vistas/Modulos/VistasGerente/".$vista.".php"; 	 
      else
        $vista = "Vistas/Modulos/error404.php";
      
      return $vista;	
    }

  }