<?php

  require_once "conexion.php";

  class ModeloFormularios
  {
    /*==========================
    Trae el registro deseado
    ==========================*/
    public static function mdlGetRegistro($tabla, $item, $dato, $tipo, $statement)
    {
      if($item == null && $dato == null && $tipo == null && $statement == null)
      { 
        $stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla");
        $stmt -> execute();

        return $stmt -> fetchAll();
      }
      else if($dato == null && $tipo == null && $statement == null)
      {
        $stmt = Conexion::conectar() -> prepare("SELECT DISTINCT $item FROM $tabla");
        $stmt -> execute();

        return $stmt -> fetchAll(); 
      }
      else if($statement == null)
      {
        $stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla WHERE $item=:item");
        
        $stmt -> bindParam(":item", $dato, $tipo);

        $stmt -> execute();

        return $stmt -> fetch();
      }
      else
      {
        $stmt = Conexion::conectar() -> prepare($statement); 
        
        $stmt -> execute(); 

        return $stmt -> fetchAll();
      }
     
      $stmt -> closeCursor();
      $stmt = null;    

    }

    /*========================
    Registra clientes  
    ========================*/
    public static function mdlRegistrarCliente($tabla1, $datos1, $tabla2, $datos2, $tabla3, $datos3)
    {
      if($tabla2 == null && $datos2 == null && $tabla3 == null && $datos3 == null)
      { 
        $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla1 (nombre, ciudad) VALUES(:nombre, :ciudad)");
        $stmt -> bindParam(":nombre", $datos1["nombre"], PDO::PARAM_STR);
        $stmt -> bindParam(":ciudad", $datos1["ciudad"], PDO::PARAM_STR);
        

        if($stmt -> execute()) return "registrado";
        else echo "<div class='alert alert-danger'>"; print_r(Conexion::conectar()) -> errorInfo(); echo "</div>";
           
        $stmt -> closeCursor();
        $stmt = null;
      }
      else if($tabla1 == null && $datos1 == null && $tabla3 == null && $datos3 == null)
      {
        $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla2 (receptor, ciudad, id_cliente) VALUES(:receptor, :ciudad, :id_cliente)"); 

        $stmt -> bindParam(":receptor", $datos2["nombre"], PDO::PARAM_STR);
        $stmt -> bindParam(":ciudad", $datos2["ciudad"], PDO::PARAM_STR);
        $stmt -> bindParam(":id_cliente", $datos2["id"], PDO::PARAM_INT);

        if($stmt -> execute())
          return "orden registrada";
        else echo "<div class='alert alert-danger'>"; var_dump($datos2); echo "</div>";
     
        $stmt -> closeCursor();
        $stmt = null;
      }          
      else
      {
        $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla3 (id_pedido, id_producto, cantidad, importe, id_vendedor) VALUES(:id_pedido, :id_producto, :cantidad, :importe, :id_vendedor)");

        $stmt -> bindParam(":id_pedido", $datos3["idpedido"], PDO::PARAM_INT);       
        $stmt -> bindParam(":id_producto", $datos3["idp"], PDO::PARAM_INT);
        $stmt -> bindParam(":cantidad", $datos3["cant"], PDO::PARAM_INT);
        $stmt -> bindParam(":importe", $datos3["import"], PDO::PARAM_STR);
        $stmt -> bindParam(":id_vendedor", $datos3["idv"], PDO::PARAM_INT);

        if($stmt -> execute()) return "pedido registrado";
        else echo "<div class='alert alert-danger'>"; var_dump($datos3); echo "</div>";
     
        $stmt -> closeCursor();
        $stmt = null;
      }

    } // end ctrRegistroCliente

     /*=========================
    Actualizar U(Update)
    =========================*/
    public static function mdlUpdateRegistro($tabla, $item, $dato, $nuevo_dato, $data)
    {
      if($data == null)
      {
      $stmt = Conexion::conectar() -> prepare("UPDATE $tabla SET $item=:$item WHERE id_producto=$dato");

      $stmt -> bindParam(":".$item, $nuevo_dato, PDO::PARAM_INT);      
 
      if($stmt -> execute()) return "actualizado";
      else echo "<div class='alert alert-danger'>"; var_dump($tabla); echo "</div>";
      }
      else
      {
        $stmt = Conexion::conectar() -> prepare("UPDATE $tabla SET nombre=:nombre, ciudad=:ciudad,
                                               vigencia=:vigencia WHERE id_cliente=:id");       
	 	
      $stmt -> bindParam(":nombre", $data["nom"], PDO::PARAM_STR);
      $stmt -> bindParam(":ciudad", $data["ciu"], PDO::PARAM_STR);
      $stmt -> bindParam(":vigencia", $data["vig"], PDO::PARAM_STR);
      $stmt -> bindParam(":id", $data["id"], PDO::PARAM_INT);
       
  
      if($stmt -> execute())
        return  "ok";
      else
        print_r(Conexion::conectar() -> errorInfo());


      }  
     
      $stmt -> closeCursor();
      $stmt = null;

    } // end Update
    
    /*========================
    Borrar D(CRUD)
    ========================*/  
    public static function mdlDeleteRegistro($tabla, $dato)
    {
      $message = ""; 
      $stmt = Conexion::conectar() -> prepare("DELETE FROM $tabla WHERE id_orden=:id_orden");

      $stmt -> bindParam(":id_orden", $dato, PDO::PARAM_INT);

      if($stmt -> execute())
        $message = "ok";
      else
        echo "<div class='alert alert-danger'>".Conexion::conectar() -> errorInfo()."</div>"; 

      $stmt = Conexion::conectar() -> prepare("DELETE FROM pedidos WHERE id_pedido=:id_pedido");

      $stmt -> bindParam(":id_pedido", $dato, PDO::PARAM_INT);

      if($stmt -> execute())
        return $message;
      else
        echo "<div class='alert alert-danger'>".Conexion::conectar() -> errorInfo()."</div>"; 

      $stmt -> closeCursor();
      $stmt = null;
    }
 
  }