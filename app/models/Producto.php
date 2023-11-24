<?php

class Producto {
    private int $_id;
    private string $_nombre;
    private int $_idSector;
    private int $_precio;
    private int $_stock;
    private bool $_estado;
    private DateTime $_fechaCreacion;
    private DateTime $_fechaModificacion;
    private DateTime $_fechaBaja;


    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM productos");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Producto');
    }

    public static function obtenerProductoPorId($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM productos WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Producto');
    }

    public static function obtenerProductosPorCodigo($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM productos
            WHERE id_sector = (SELECT id_sector FROM productos WHERE id = :id)");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Producto');
    }

    /* public static function obtenerTipoExistente($tipoId)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM productos WHERE tipo_id = :tipoId;");
        $consulta->bindValue(':tipoId', $tipoId, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Producto');
    } */

    public function crearProducto()
    {
        /* $bdPedido = Producto::obtenerTipoExistente($this->_tipoId);
        $bdPedido = $bdPedido ? $bdPedido[0]->fecha_baja : null;
        if ($bdPedido){ 
            return false;
        } */
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO productos (nombre, id_sector, precio, stock, estado, fecha_creacion) 
            VALUES (:nombre, :id_sector, :precio, :stock, :estado, :fecha_creacion)");
        $consulta->bindValue(':nombre', $this->_nombre, PDO::PARAM_STR);
        $consulta->bindValue(':id_sector', $this->_idSector, PDO::PARAM_INT);
        $consulta->bindValue(':precio', $this->_precio, PDO::PARAM_INT);
        $consulta->bindValue(':stock', $this->_stock, PDO::PARAM_INT);
        $consulta->bindValue(':estado', $this->_estado, PDO::PARAM_BOOL);
        $consulta->bindValue(':fecha_creacion', date_format($this->_fechaCreacion, 'Y-m-d H:i:s'));
        $consulta->execute();
        return $objAccesoDatos->obtenerUltimoId();
    }

    public function modificarProducto()
    {
        $bdProducto = Producto::obtenerProductoPorId($this->_id);
        if (!$bdProducto){ 
            return false;
        }
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE productos SET 
            nombre = :nombre,
            precio = :precio,
            stock = :stock,
            estado = :estado,
            fecha_modificacion = :fecha_modificacion
            WHERE id = :id");
        $fecha = new DateTime(date("d-m-Y"));
        $consulta->bindValue(':id', $this->_id, PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $this->_nombre, PDO::PARAM_STR);
        $consulta->bindValue(':precio', $this->_precio, PDO::PARAM_INT);
        $consulta->bindValue(':stock', $this->_stock, PDO::PARAM_INT);
        $consulta->bindValue(':estado', $this->_estado, PDO::PARAM_BOOL);
        $consulta->bindValue(':fecha_modificacion', date_format($fecha, 'Y-m-d H:i:s'));
        $consulta->execute();
        return true;
    }

    public static function borrarProducto($id)
    {
        if (!Producto::obtenerProductoPorId($id)){
            return false;
        }
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE productos 
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
    public function getNombre(){
        return $this->_nombre;
    }
    public function getIdSector(){
        return $this->_idSector;
    }
    public function getPrecio(){
        return $this->_precio;
    }
    public function getStock(){
        return $this->_stock;
    }
    public function getEstado(){
        return $this->_estado;
    }
    public function getFechaCreacion(){
        return $this->_fechaCreacion;
    }
    public function getFechaModificacion(){
        return $this->_fechaModificacion;
    }
    public function getFechaBaja(){
        return $this->_fechaBaja;
    }

    //-- Setter
    public function setId($valor){
        $this->_id = $valor;
    }
    public function setNombre($valor){
        $this->_nombre = $valor;
    }
    public function setIdSector($valor){
        $this->_idSector = $valor;
    }
    public function setPrecio($valor){
        $this->_precio = $valor;
    }
    public function setStock($valor){
        $this->_stock = $valor;
    }
    public function setEstado($valor){
        $this->_estado = $valor;
    }
    public function setFechaCreacion($valor){
        $this->_fechaCreacion = $valor;
    }
    public function setFechaModificacion($valor){
        $this->_fechaModificacion = $valor;
    }
    public function setFechaBaja($valor){
        $this->_fechaBaja = $valor;
    }
}

?>