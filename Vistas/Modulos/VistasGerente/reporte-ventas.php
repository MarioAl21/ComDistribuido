<?php
  if(!isset($_SESSION["validar_loginGere"]))
  {
    echo '<script>
           window.location="index.php"; 
           alert("Identificase primero con su password");
         </script>';
    return; 
  }
  else
  {
    if($_SESSION["validar_loginGere"] != "ok")
    {
      echo '<script>
           window.location="index.php"; 
           alert("Identificase con su password")
         </script>';
      return; 
    }
  }

  $tabla = "productos";    	
  $productos = ControladorFormularios::ctrGetRegistro($tabla, null, null, null, null);
  $tam = sizeof($productos);

  $tabla = "clientes";
  $clientes = ControladorFormularios::ctrGetRegistro($tabla, null, null, null, null);
  
?>



</script><script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.1/chart.min.js" integrity="sha512-BqNYFBAzGfZDnIWSAEGZSD/QFKeVxms2dIBPfw11gZubWwKUjEgmFUtUls8vZ6xTRZN/jaXGHD/ZaxD9+fDo0A==" crossorigin="anonymous"></script>
 