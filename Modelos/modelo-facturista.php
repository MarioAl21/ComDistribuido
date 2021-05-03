<?php

  class ModeloFacturista
  { 
    /*-----------------------
    Vistas del facturista
    -----------------------*/
    public static function mdlGetVista($vista_facturista)
    {
      if
      (
        $vista_facturista == "vigencia-clientes" ||    
        $vista_facturista == "clientes-vigencia"
      )
        $vista_facturista = "Vistas/Modulos/VistasFacturista/".$vista_facturista.".php";
      else
        $vista_facturista = "Vistas/Modulos/VistasFacturista/ver-facturas.php";

      return $vista_facturista;
    } 

  }