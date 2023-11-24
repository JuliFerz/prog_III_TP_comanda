<?php

class Sector {
    private int $_id;
    private string $_detalle;
    private DateTime $_fechaBaja;


    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM sectores");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Sector');
    }

    public static function obtenerSectorPorId($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM sectores WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Sector');
    }

    public static function obtenerSectorPorNombre($detalle)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM sectores
            WHERE detalle = :detalle");
        $consulta->bindValue(':detalle', $detalle, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Sector');
    }

    public function crearSector()
    {
        if (Sector::obtenerSectorPorNombre($this->_detalle)){
            return false;
        }
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO sectores (detalle) VALUES (:detalle)");
        $consulta->bindValue(':detalle', $this->_detalle, PDO::PARAM_STR);
        $consulta->execute();
        return $objAccesoDatos->obtenerUltimoId();
    }

    public function modificarSector()
    {
        if (!Sector::obtenerSectorPorId($this->_id)){ 
            return false;
        }
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE sectores SET detalle = :detalle WHERE id = :id");
        $consulta->bindValue(':id', $this->_id, PDO::PARAM_INT);
        $consulta->bindValue(':detalle', $this->_detalle, PDO::PARAM_STR);
        $consulta->execute();
        return true;
    }

    public static function borrarSector($id)
    {
        if (!Sector::obtenerSectorPorId($id)){
            return false;
        }
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE sectores 
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
    public function getDetalle(){
        return $this->_detalle;
    }
    public function getFechaBaja(){
        return $this->_fechaBaja;
    }

    // //-- Setter
    public function setId($valor){
        $this->_id = $valor;
    }
    public function setDetalle($valor){
        $this->_detalle = $valor;
    }
    public function setFechaBaja($valor){
        $this->_fechaBaja = $valor;
    }
}

?>