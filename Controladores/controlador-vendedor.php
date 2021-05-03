<?php

  class ControladorVendedor
  {
    /*==========================
    Vista para darse de Alta
    ==========================*/
    public function ctrGetVista()
    {
      if(isset($_GET["vista_vend"]))
        include ModeloVendedor::mdlGetVista($_GET["vista_vend"]);   
       else
        include "Vistas/Modulos/VistasVendedor/ingresar.php";
    }    

  }