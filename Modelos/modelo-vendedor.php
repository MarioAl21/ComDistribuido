<?php

  class ModeloVendedor
  { 
    /*-----------------------
    Vistas del vendedor
    -----------------------*/
    public static function mdlGetVista($vista)
    {
      if
      (
        $vista == "ingresar" ||
 	$vista == "darse-alta"  
      )
        $vista = "Vistas/Modulos/VistasVendedor/".$vista.".php";
      else
        $vista = "Vistas/Modulos/VistasVendedor/ingresar.php";

      return $vista;
    } 

  }