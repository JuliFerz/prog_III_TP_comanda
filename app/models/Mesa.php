<?php

class Mesa {
    private int $_id;
    private int $_numeroMesa;
    private bool $_estado;
    private DateTime $_fechaBaja;


    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM mesas");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Mesa');
    }

    public static function obtenerMesaPorId($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM mesas WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Mesa');
    }

    public static function obtenerMesasPorNumeroMesa($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM mesas
            WHERE numero_mesa = (SELECT numero_mesa FROM mesas WHERE id = :id)");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Mesa');
    }

    public static function obtenerMesaExistente($numeroMesa)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM mesas WHERE numero_mesa = :numero_mesa;");
        $consulta->bindValue(':numero_mesa', $numeroMesa, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Mesa');
    }

    public function crearMesa()
    {
        $bdPedido = Mesa::obtenerMesaExistente($this->_numeroMesa);
        $bdPedido = $bdPedido ? $bdPedido[0]->fecha_baja : null;
        if ($bdPedido){ 
            return false;
        }
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO mesas (numero_mesa, estado) VALUES (:numero_mesa, :estado)");
        $consulta->bindValue(':numero_mesa', $this->_numeroMesa, PDO::PARAM_INT);
        $consulta->bindValue(':estado', $this->_estado, PDO::PARAM_BOOL);
        $consulta->execute();
        return $objAccesoDatos->obtenerUltimoId();
    }

    public function modificarMesa()
    {
        $bdProducto = Mesa::obtenerMesaPorId($this->_id);
        if (!$bdProducto){ 
            return false;
        }
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE mesas SET 
            numero_mesa = :numero_mesa
            WHERE id = :id");
        $consulta->bindValue(':id', $this->_id, PDO::PARAM_INT);
        $consulta->bindValue(':numero_mesa', $this->_numeroMesa, PDO::PARAM_INT);
        $consulta->execute();
        return true;
    }

    public static function borrarMesa($id)
    {
        if (!Mesa::obtenerMesaPorId($id)){
            return false;
        }
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE mesas 
            SET fecha_baja = :fechaBaja
            WHERE numero_mesa = (SELECT numero_mesa FROM mesas WHERE id = :id)");
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
    public function getNumeroMesa(){
        return $this->_numeroMesa;
    }
    public function getEstado(){
        return $this->_estado;
    }
    public function getFechaBaja(){
        return $this->_fechaBaja;
    }

    // //-- Setter
    public function setId($valor){
        $this->_id = $valor;
    }
    public function setNumeroMesa($valor){
        $this->_numeroMesa = $valor;
    }
    public function setEstado($valor){
        $this->_estado = $valor;
    }
    public function setFechaBaja($valor){
        $this->_fechaBaja = $valor;
    }
}

?>