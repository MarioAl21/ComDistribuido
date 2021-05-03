<?php

  class ControladorFacturista
  {
    /*==========================
    Vista para editar la 
    factura
    ==========================*/
    public function ctrGetVista()
    {
      if(isset($_GET["vista_facturista"]))
        include ModeloFacturista::mdlGetVista($_GET["vista_facturista"]);   
       else
        include "Vistas/Modulos/VistasFacturista/ver-facturas.php";
    }    

  }