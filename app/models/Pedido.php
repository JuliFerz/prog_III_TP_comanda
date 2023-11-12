<?php

class Pedido {
    private int $_id;
    private int $_codigoPedido;
    private int $_idMesa;
    private int $_idUsuario;
    private string $_nombreCliente;
    private string $_descripcion;
    private bool $_estado;
    // private int $_tipoId;


    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT id, codigo_pedido, id_mesa, id_usuario, nombre_cliente, descripcion, estado FROM pedidos");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Pedido');
    }

    public static function obtenerPedido($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT id, codigo_pedido, id_mesa, id_usuario, nombre_cliente, descripcion, estado FROM pedidos WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchObject('Pedido');
    }

    public function crearPedido()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO pedidos (codigo_pedido, id_mesa, id_usuario, nombre_cliente, descripcion, estado) VALUES (:codigo_pedido, :id_mesa, :id_usuario, :nombre_cliente, :descripcion, :estado)");
        $consulta->bindValue(':codigo_pedido', $this->_codigoPedido, PDO::PARAM_INT);
        $consulta->bindValue(':id_mesa', $this->_idMesa, PDO::PARAM_INT);
        $consulta->bindValue(':id_usuario', $this->_idUsuario, PDO::PARAM_INT);
        $consulta->bindValue(':nombre_cliente', $this->_nombreCliente, PDO::PARAM_STR);
        $consulta->bindValue(':descripcion', $this->_descripcion, PDO::PARAM_STR);
        $consulta->bindValue(':estado', $this->_estado, PDO::PARAM_BOOL);
        $consulta->execute();
        return $objAccesoDatos->obtenerUltimoId();
    }

    // public function modificarUsuario()
    // {
    //     $bdUser = Usuario::obtenerUsuario($this->_id);
    //     if (!$bdUser){
    //         return $bdUser;
    //     }
    //     $objAccesoDato = AccesoDatos::obtenerInstancia();
    //     $consulta = $objAccesoDato->prepararConsulta("UPDATE usuarios SET usuario = :usuario, clave = :clave, sector = :sector, prioridad = :prioridad WHERE id = :id");
    //     $consulta->bindValue(':id', $this->_id, PDO::PARAM_INT);
    //     $consulta->bindValue(':usuario', $this->_usuario, PDO::PARAM_STR);
    //     $consulta->bindValue(':clave', $this->_clave, PDO::PARAM_STR); // Hashear?
    //     $consulta->bindValue(':sector', $this->_sector, PDO::PARAM_STR);
    //     $consulta->bindValue(':prioridad', $this->_prioridad, PDO::PARAM_INT);
    //     $consulta->execute();
    //     return true;
    // }

    // public static function borrarUsuario($id)
    // {
    //     $bdUser = Usuario::obtenerUsuario($id);
    //     if (!$bdUser){
    //         return $bdUser;
    //     }
    //     $objAccesoDato = AccesoDatos::obtenerInstancia();
    //     $consulta = $objAccesoDato->prepararConsulta("UPDATE usuarios SET fecha_baja = :fechaBaja WHERE id = :id");
    //     $fecha = new DateTime(date("d-m-Y"));
    //     $consulta->bindValue(':id', $id, PDO::PARAM_INT);
    //     $consulta->bindValue(':fechaBaja', date_format($fecha, 'Y-m-d H:i:s'));
    //     $consulta->execute();
    //     return true;
    // }

    // //-- Getter
    public function getId(){
        return $this->_id;
    }
    public function getCodigoPedido(){
        return $this->_codigoPedido;
    }
    public function getIdMesa(){
        return $this->_idMesa;
    }
    public function getIdUsuario(){
        return $this->_idUsuario;
    }
    public function getNombreCliente(){
        return $this->_nombreCliente;
    }
    public function getDescripcion(){
        return $this->_descripcion;
    }
    public function getEstado(){
        return $this->_estado;
    }

    // //-- Setter
    public function setId($valor){
        $this->_id = $valor;
    }
    public function setCodigoPedido($valor){
        $this->_codigoPedido = $valor;
    }
    public function setIdMesa($valor){
        $this->_idMesa = $valor;
    }
    public function setIdUsuario($valor){
        $this->_idUsuario = $valor;
    }
    public function setNombreCliente($valor){
        $this->_nombreCliente = $valor;
    }
    public function setDescripcion($valor){
        $this->_descripcion = $valor;
    }
    public function setEstado($valor){
        $this->_estado = $valor;
    }
}

?>