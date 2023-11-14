<?php

class Usuario {
    private int $_id;
    private string $_usuario;
    private string $_clave;
    // private array $_mesasACargo;
    // private string $_nombre;
    // private string $_apellido;
    private string $_sector;
    private int $_prioridad;
    // private DateTime $fechaAlta;
    private DateTime $_fechaBaja;

    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT id, usuario, clave, sector, prioridad, fecha_baja FROM usuarios");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Usuario');
    }

    public static function obtenerUsuario($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT id, usuario, clave, sector, prioridad, fecha_baja FROM usuarios WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchObject('Usuario');
    }

    public function crearUsuario()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO usuarios (usuario, clave, sector, prioridad) VALUES (:usuario, :clave, :sector, :prioridad)");
        $claveHash = password_hash($this->_clave, PASSWORD_DEFAULT);
        $consulta->bindValue(':usuario', $this->_usuario, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $claveHash);
        $consulta->bindValue(':sector', $this->_sector, PDO::PARAM_STR);
        $consulta->bindValue(':prioridad', $this->_prioridad, PDO::PARAM_INT);
        $consulta->execute();
        return $objAccesoDatos->obtenerUltimoId();
    }

    public function modificarUsuario()
    {
        $bdUser = Usuario::obtenerUsuario($this->_id);
        if (!$bdUser){
            return $bdUser;
        }
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE usuarios SET usuario = :usuario, clave = :clave, sector = :sector, prioridad = :prioridad WHERE id = :id");
        $consulta->bindValue(':id', $this->_id, PDO::PARAM_INT);
        $consulta->bindValue(':usuario', $this->_usuario, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $this->_clave, PDO::PARAM_STR); // Hashear?
        $consulta->bindValue(':sector', $this->_sector, PDO::PARAM_STR);
        $consulta->bindValue(':prioridad', $this->_prioridad, PDO::PARAM_INT);
        $consulta->execute();
        return true;
    }

    public static function borrarUsuario($id)
    {
        $bdUser = Usuario::obtenerUsuario($id);
        if (!$bdUser){
            return $bdUser;
        }
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE usuarios SET fecha_baja = :fechaBaja WHERE id = :id");
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
    
    public function getUsuario(){
        return $this->_usuario;
    }
    
    public function getClave(){
        return $this->_clave;
    }
    
    public function getSector(){
        return $this->_sector;
    }
    
    public function getPrioridad(){
        return $this->_prioridad;
    }
    public function getFechaBaja(){
        return $this->_fechaBaja;
    }

    //-- Setter
    public function setId($valor){
        $this->_id = $valor;
    }
    public function setUsuario($valor){
        $this->_usuario = $valor;
    }
    public function setClave($valor){
        $this->_clave = $valor;
    }
    public function setSector($valor){
        $this->_sector = $valor;
    }
    public function setPrioridad($valor){
        $this->_prioridad = $valor;
    }
    public function setFechaBaja($valor){
        $this->_fechaBaja = $valor;
    }
    
}

?>