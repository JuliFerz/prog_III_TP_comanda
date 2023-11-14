<?php

class TipoProducto {
    private int $_id;
    private string $_nombre;
    private DateTime $_fechaBaja;


    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM tipo_productos");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'TipoProducto');
    }

    public static function obtenerTipoProductoPorId($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM tipo_productos WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'TipoProducto');
    }

    public static function obtenerTipoProductoPorNombre($nombre)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM tipo_productos
            WHERE nombre = :nombre");
        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'TipoProducto');
    }

    public function crearTipoProducto()
    {
        if (TipoProducto::obtenerTipoProductoPorNombre($this->_nombre)){
            return false;
        }
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO tipo_productos (nombre) VALUES (:nombre)");
        $consulta->bindValue(':nombre', $this->_nombre, PDO::PARAM_STR);
        $consulta->execute();
        return $objAccesoDatos->obtenerUltimoId();
    }

    public function modificarTpoProducto()
    {
        if (!TipoProducto::obtenerTipoProductoPorId($this->_id)){ 
            return false;
        }
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE tipo_productos SET nombre = :nombre WHERE id = :id");
        $consulta->bindValue(':id', $this->_id, PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $this->_nombre, PDO::PARAM_STR);
        $consulta->execute();
        return true;
    }

    public static function borrarTipoProducto($id)
    {
        if (!TIpoProducto::obtenerTipoProductoPorId($id)){
            return false;
        }
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE tipo_productos 
            SET fecha_baja = :fechaBaja
            WHERE id = :id");
        $fecha = new DateTime(date("d-m-Y"));
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':fechaBaja', date_format($fecha, 'Y-m-d H:i:s'));
        $consulta->execute();
        return true;
    }

    // //-- Getter
    public function getId(){
        return $this->_id;
    }
    public function getNombre(){
        return $this->_nombre;
    }
    public function getFechaBaja(){
        return $this->_fechaBaja;
    }

    // //-- Setter
    public function setId($valor){
        $this->_id = $valor;
    }
    public function setNombre($valor){
        $this->_nombre = $valor;
    }
    public function setFechaBaja($valor){
        $this->_fechaBaja = $valor;
    }
}

?>