<?php

require_once('./controllers/FileController.php');

class Pedido {
    private string $_PATH = './images/pedidos/';
    private int $_id;
    private int $_codigoPedido;
    private int $_idProducto;
    private int $_idMesa;
    private int $_idUsuario;
    private string $_nombreCliente;
    private string $_descripcion;
    private string $_foto;
    private bool $_estado;
    private DateTime $_fechaBaja;


    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM pedidos");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Pedido');
    }

    public static function obtenerTodosPorUsuario($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM pedidos WHERE id_usuario = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Pedido');
    }

    public static function obtenerPedidoPorId($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM pedidos WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->execute();
        // return $consulta->fetchObject('Pedido');
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Pedido');
    }

    public static function obtenerPedidosPorCodigo($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        // simplificar query
        // $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM pedidos WHERE codigo_pedido = :codPedido;");
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM pedidos
            WHERE codigo_pedido = (SELECT codigo_pedido FROM pedidos WHERE id = :id)");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Pedido');
    }

    public static function obtenerCodigoExistente($idCodigo)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM pedidos WHERE codigo_pedido = :codPedido;");
        $consulta->bindValue(':codPedido', $idCodigo, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Pedido');
    }

    public function crearPedido()
    {
        $bdPedido = Pedido::obtenerCodigoExistente($this->_codigoPedido);
        $bdPedido = $bdPedido ? $bdPedido[0]->fecha_baja : null;
        if ($bdPedido){ 
            return false;
        }
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO pedidos (codigo_pedido, id_producto, id_mesa, id_usuario, nombre_cliente, foto, estado) 
            VALUES (:codigo_pedido, :id_producto, :id_mesa, :id_usuario, :nombre_cliente, :foto, :estado)");
        $consulta->bindValue(':codigo_pedido', $this->_codigoPedido, PDO::PARAM_INT);
        $consulta->bindValue(':id_producto', $this->_idProducto, PDO::PARAM_INT);
        $consulta->bindValue(':id_mesa', $this->_idMesa, PDO::PARAM_INT);
        $consulta->bindValue(':id_usuario', $this->_idUsuario, PDO::PARAM_INT);
        $consulta->bindValue(':nombre_cliente', $this->_nombreCliente, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $this->_foto, PDO::PARAM_STR);
        $consulta->bindValue(':estado', $this->_estado, PDO::PARAM_BOOL);
        $consulta->execute();
        return $objAccesoDatos->obtenerUltimoId();
    }

    public function modificarPedido()
    {
        $bdPedido = Pedido::obtenerPedidoPorId($this->_id);
        if (!$bdPedido /* || ($bdPedido && $bdPedido->codigo_pedido < $this->_codigoPedido) */){ 
            return false;
        }
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE pedidos SET 
            -- codigo_pedido = :codigo_pedido,
            id_producto = :id_producto,
            id_mesa = :id_mesa,
            id_usuario = :id_usuario,
            nombre_cliente = :nombre_cliente,
            estado = :estado
            WHERE id = :id");
        $consulta->bindValue(':id', $this->_id, PDO::PARAM_INT);
        // $consulta->bindValue(':codigo_pedido', $this->_codigoPedido, PDO::PARAM_STR);
        $consulta->bindValue(':id_producto', $this->_idProducto, PDO::PARAM_INT);
        $consulta->bindValue(':id_mesa', $this->_idMesa, PDO::PARAM_STR);
        $consulta->bindValue(':id_usuario', $this->_idUsuario, PDO::PARAM_STR);
        $consulta->bindValue(':nombre_cliente', $this->_nombreCliente, PDO::PARAM_INT);
        $consulta->bindValue(':estado', $this->_estado, PDO::PARAM_INT);
        $consulta->execute();
        return true;
    }

    public static function borrarPedido($id)
    {
        if (!Pedido::obtenerPedidosPorCodigo($id)){
            return false;
        }
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE pedidos 
            SET fecha_baja = :fechaBaja
            WHERE codigo_pedido = (select codigo_pedido from pedidos WHERE id = :id)");
        $fecha = new DateTime(date("d-m-Y"));
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':fechaBaja', date_format($fecha, 'Y-m-d H:i:s'));
        $consulta->execute();
        return true;
    }

    public function actualizarFoto($datosImg, $idUsuario)
    {
        $bdPedidos = Pedido::obtenerPedidosPorCodigo($this->_id);
        if (!$bdPedidos) {
            return false;
        }
        $fileController = new FileController($this->_PATH);
        // TODO: Cambiar el nombre de imagen
        $nombreImg = $bdPedidos[0]->{'codigo_pedido'}
            . '_' . $bdPedidos[0]->{'id_mesa'} . '_';
        foreach ($bdPedidos as $objPedido) {
            $nombreImg .= explode(' ', $objPedido->nombre_cliente)[0];
        }
        $fileController->setImage($datosImg, $nombreImg);


        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE pedidos 
            SET foto = :foto
            WHERE codigo_pedido = (select codigo_pedido from pedidos WHERE id = :id)");
        $consulta->bindValue(':id', $this->_id, PDO::PARAM_INT);
        $consulta->bindValue(':foto', $nombreImg . '.png');
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
    public function getIdProducto(){
        return $this->_idProducto;
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
    public function getFoto(){
        return $this->_foto;
    }
    public function getEstado(){
        return $this->_estado;
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
    public function setIdProducto($valor){
        $this->_idProducto = $valor;
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
    public function setFoto($valor){
        $this->_foto = $valor;
    }
    public function setEstado($valor){
        $this->_estado = $valor;
    }
    public function setFechaBaja($valor){
        $this->_fechaBaja = $valor;
    }
}

?>