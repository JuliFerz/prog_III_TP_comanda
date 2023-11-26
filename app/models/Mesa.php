<?php

/*
Estados de la mesa:
    • "libre" [X] Cuando se crea mesa. Cuando socio edita desde PUT 
    • "con cliente esperando pedido" [X] cuando se crea pedido
    • "con cliente comiendo" [X] cuando se completa pedido
    • "con cliente pagando" [X] cuando se va a cobrar el pedido
    • "cerrada" [X] cuando socio cierra (se bajan los pedidos)
*/

class Mesa {
    private int $_id;
    private ?string $_codigoPedido;
    private ?int $_tiempoPreparacion;
    private ?int $_vecesUsada;
    private string $_estado;
    private DateTime $_fechaBaja;


    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM mesas");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Mesa');
    }

    public static function obtenerMasUsadas()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM mesas 
            ORDER BY veces_usada DESC;");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Mesa');
    }

    public static function obtenerMesaPorId($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM mesas WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchObject('Mesa');
    }

    public static function obtenerMesaPorCodigo($codigo)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT DISTINCT m.*, p.estado as estado_pedido 
            FROM mesas m
            INNER JOIN pedidos p ON m.codigo_pedido = p.codigo_pedido 
            where m.codigo_pedido = :codigo;");
        $consulta->bindValue(':codigo', $codigo, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchObject('Mesa');
    }

    public static function obtenerMesaDisponible($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT *
            FROM mesas m
            WHERE id = :id
                AND estado = 'libre';");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchObject('Mesa');
    }

    public function crearMesa()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO mesas (estado) VALUES (:estado)");
        $consulta->bindValue(':estado', $this->_estado, PDO::PARAM_STR);
        $consulta->execute();
        return $objAccesoDatos->obtenerUltimoId();
    }

    public function modificarMesa($externo = false)
    {
        if ($externo){
            $this->_id = $this->{'id'};
            $this->_estado = $this->{'estado'};
            $this->_codigoPedido = $this->{'codigo_pedido'};
            $this->_tiempoPreparacion = $this->{'tiempo_preparacion'} ?? null;
            $this->_vecesUsada = $this->{'veces_usada'} ?? null;
        }
        if (!Mesa::obtenerMesaPorId($this->_id)){ 
            return false;
        }
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE mesas 
            SET codigo_pedido = :codigo_pedido,
                tiempo_preparacion = :tiempo_preparacion,
                veces_usada = :veces_usada,
                estado = :estado
            WHERE id = :id");
        $consulta->bindValue(':id', $this->_id, PDO::PARAM_INT);
        $consulta->bindValue(':codigo_pedido', $this->_codigoPedido, PDO::PARAM_STR);
        $consulta->bindValue(':tiempo_preparacion', $this->_tiempoPreparacion, PDO::PARAM_STR);
        $consulta->bindValue(':veces_usada', $this->_vecesUsada, PDO::PARAM_INT);
        $consulta->bindValue(':estado', $this->_estado, PDO::PARAM_STR);
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
            SET fecha_baja = :fechaBaja,
                tiempo_preparacion = :tiempo_preparacion
                estado = :estado
            WHERE id = :id");
        $fecha = new DateTime(date("d-m-Y"));
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':fechaBaja', date_format($fecha, 'Y-m-d H:i:s'));
        $consulta->bindValue(':tiempo_preparacion', NULL);
        $consulta->bindValue(':estado', 0);
        $consulta->execute();
        return true;
    }

    // //-- Getter
    public function getId(){
        return $this->_id;
    }
    public function getCodigoPedido(){
        return $this->_codigoPedido;
    }
    public function getTiempoPreparacion(){
        return $this->_tiempoPreparacion;
    }
    public function getVecesUsada(){
        return $this->_vecesUsada;
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
    public function setCodigoPedido($valor){
        $this->_codigoPedido = $valor;
    }
    public function setTiempoPreparacion($valor){
        $this->_tiempoPreparacion = $valor;
    }
    public function setVecesUsada($valor){
        $this->_vecesUsada = $valor;
    }
    public function setEstado($valor){
        $this->_estado = $valor;
    }
    public function setFechaBaja($valor){
        $this->_fechaBaja = $valor;
    }
}

?>