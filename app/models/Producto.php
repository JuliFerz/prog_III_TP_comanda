<?php

class Producto {
    private int $_id;
    private string $_nombre;
    private int $_idSector;
    private int $_precio;
    private int $_stock;
    private int $_tiempoPreparacion;
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
        return $consulta->fetchObject('Producto');
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

    public static function obtenerProductoDisponible($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT *
            FROM productos p
            WHERE id = :id
                AND p.stock > 0
                AND p.fecha_baja IS NULL;");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchObject('Producto');
    }

    public function crearProducto()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO productos (nombre, id_sector, precio, stock, tiempo_preparacion, estado, fecha_creacion) 
            VALUES (:nombre, :id_sector, :precio, :stock, :tiempo_preparacion, :estado, :fecha_creacion)");
        $consulta->bindValue(':nombre', $this->_nombre, PDO::PARAM_STR);
        $consulta->bindValue(':id_sector', $this->_idSector, PDO::PARAM_INT);
        $consulta->bindValue(':precio', $this->_precio, PDO::PARAM_INT);
        $consulta->bindValue(':stock', $this->_stock, PDO::PARAM_INT);
        $consulta->bindValue(':tiempo_preparacion', $this->_tiempoPreparacion, PDO::PARAM_INT);
        $consulta->bindValue(':estado', $this->_estado, PDO::PARAM_BOOL);
        $consulta->bindValue(':fecha_creacion', date_format($this->_fechaCreacion, 'Y-m-d H:i:s'));
        $consulta->execute();
        return $objAccesoDatos->obtenerUltimoId();
    }

    public function modificarProducto($externo = false)
    {
        if($externo){
            $this->_id = $this->{'id'};
            $this->_nombre = $this->{'nombre'};
            $this->_precio = $this->{'precio'};
            $this->_stock = $this->{'stock'};
            $this->_tiempoPreparacion = $this->{'tiempo_preparacion'};
            $this->_estado = $this->{'estado'};
        }
        if (!Producto::obtenerProductoPorId($this->_id)){ 
            return false;
        }
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE productos SET 
                nombre = :nombre,
                precio = :precio,
                stock = :stock,
                tiempo_preparacion = :tiempo_preparacion,
                estado = :estado,
                fecha_modificacion = :fecha_modificacion
            WHERE id = :id");
        $fecha = new DateTime(date("d-m-Y"));
        $consulta->bindValue(':id', $this->_id, PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $this->_nombre, PDO::PARAM_STR);
        $consulta->bindValue(':precio', $this->_precio, PDO::PARAM_INT);
        $consulta->bindValue(':stock', $this->_stock, PDO::PARAM_INT);
        $consulta->bindValue(':tiempo_preparacion', $this->_tiempoPreparacion, PDO::PARAM_INT);
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
    public function getTiempoPreparacion(){
        return $this->_tiempoPreparacion;
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
    public function setTiempoPreparacion($valor){
        $this->_tiempoPreparacion = $valor;
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