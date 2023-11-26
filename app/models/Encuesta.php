<?php

class Encuesta {
    private $_id;
    private $_codigoPedido;
    private $_puntosMesa;
    private $_puntosRestaurante;
    private $_puntosMozo;
    private $_puntosCocinero;
    private $_comentarios;
    private DateTime $_fechaBaja;


    public static function obtenerMejores()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM encuestas
            ORDER BY (puntos_mesa + puntos_restaurante + puntos_cocinero + puntos_mozo) DESC;");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Encuesta');
    }

    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM encuestas");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Encuesta');
    }

    public static function obtenerEncuestaPorId($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM encuestas WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Encuesta');
    }

    public static function obtenerPedidoYaCalificado($codigoPedido)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM encuestas WHERE codigo_pedido = :codigo_pedido;");
        $consulta->bindValue(':codigo_pedido', $codigoPedido, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchObject('Encuesta');
    }

    public function crearEncuesta()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO encuestas (codigo_pedido, puntos_mesa, puntos_restaurante, puntos_mozo, puntos_cocinero, comentarios)
            VALUES (:codigo_pedido, :puntos_mesa, :puntos_restaurante, :puntos_mozo, :puntos_cocinero, :comentarios)");
        $consulta->bindValue(':codigo_pedido', $this->_codigoPedido, PDO::PARAM_STR);
        $consulta->bindValue(':puntos_mesa', $this->_puntosMesa, PDO::PARAM_INT);
        $consulta->bindValue(':puntos_restaurante', $this->_puntosRestaurante, PDO::PARAM_INT);
        $consulta->bindValue(':puntos_mozo', $this->_puntosMozo, PDO::PARAM_INT);
        $consulta->bindValue(':puntos_cocinero', $this->_puntosCocinero, PDO::PARAM_INT);
        $consulta->bindValue(':comentarios', $this->_comentarios, PDO::PARAM_STR);
        $consulta->execute();
        return $objAccesoDatos->obtenerUltimoId();
    }

    public function modificarEncuesta()
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE encuestas SET 
            puntos_mesa = :puntos_mesa,
            puntos_restaurante = :puntos_restaurante,
            puntos_mozo = :puntos_mozo,
            puntos_cocinero = :puntos_cocinero,
            comentarios = :comentarios
            WHERE id = :id");
        $consulta->bindValue(':id', $this->_id, PDO::PARAM_INT);
        $consulta->bindValue(':puntos_mesa', $this->_puntosMesa, PDO::PARAM_INT);
        $consulta->bindValue(':puntos_restaurante', $this->_puntosRestaurante, PDO::PARAM_INT);
        $consulta->bindValue(':puntos_mozo', $this->_puntosMozo, PDO::PARAM_INT);
        $consulta->bindValue(':puntos_cocinero', $this->_puntosCocinero, PDO::PARAM_INT);
        $consulta->bindValue(':comentarios', $this->_comentarios, PDO::PARAM_STR);
        $consulta->execute();
    }

    public static function borrarEncuesta($id)
    {
        if (!Encuesta::obtenerEncuestaPorId($id)){
            return false;
        }
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE encuestas 
            SET fecha_baja = :fechaBaja
            WHERE id = :id");
        $fecha = new DateTime(date("d-m-Y"));
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':fechaBaja', date_format($fecha, 'Y-m-d H:i:s'));
        $consulta->execute();
        return true;
    }

    //-- Getter
    public function getId(){
        return $this->_id;
    }
    public function getCodigoPedido(){
        return $this->_codigoPedido;
    }
    public function getPuntosMesa(){
        return $this->_puntosMesa;
    }
    public function getPuntosRestaurante(){
        return $this->_puntosRestaurante;
    }
    public function getPuntosMozo(){
        return $this->_puntosMozo;
    }
    public function getPuntosCocinero(){
        return $this->_puntosCocinero;
    }
    public function getComentarios(){
        return $this->_comentarios;
    }
    public function getFechaBaja(){
        return $this->_fechaBaja;
    }

    //-- Setter
    public function setId($valor){
        $this->_id = $valor;
    }
    public function setCodigoPedido($valor){
        $this->_codigoPedido = $valor;
    }
    public function setPuntosMesa($valor){
        $this->_puntosMesa = $valor;
    }
    public function setPuntosRestaurante($valor){
        $this->_puntosRestaurante = $valor;
    }
    public function setPuntosMozo($valor){
        $this->_puntosMozo = $valor;
    }
    public function setPuntosCocinero($valor){
        $this->_puntosCocinero = $valor;
    }
    public function setComentarios($valor){
        $this->_comentarios = $valor;
    }
    public function setFechaBaja($valor){
        $this->_fechaBaja = $valor;
    }
}

?>