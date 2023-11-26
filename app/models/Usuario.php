<?php

require_once './controllers/FileController.php';

class Usuario {
    private int $_id;
    private string $_usuario;
    private string $_clave;
    private string $_nombre;
    private string $_apellido;
    private string $_correo;
    private string $_idSector;
    private int $_prioridad;
    private bool $_estado;
    // private DateTime $fechaAlta;
    private DateTime $_fechaBaja;

    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM usuarios");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Usuario');
    }
    public static function obtenerTodosCSV()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM usuarios");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerUsuario($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM usuarios WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchObject('Usuario');
    }

    public static function obtenerUsuarioDisponible($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT *
            FROM usuarios WHERE id = :id AND estado = 1;");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchObject('Usuario');
    }

    public function crearUsuario()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO usuarios 
                (usuario, clave, nombre, apellido, correo, id_sector, prioridad, estado)
            VALUES (:usuario, :clave, :nombre, :apellido, :correo, :id_sector, :prioridad, :estado)");
        $claveHash = password_hash($this->_clave, PASSWORD_DEFAULT);
        $consulta->bindValue(':usuario', $this->_usuario, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $claveHash);
        $consulta->bindValue(':nombre', $this->_nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $this->_apellido, PDO::PARAM_STR);
        $consulta->bindValue(':correo', $this->_correo, PDO::PARAM_STR);
        $consulta->bindValue(':id_sector', $this->_idSector, PDO::PARAM_INT);
        $consulta->bindValue(':prioridad', $this->_prioridad, PDO::PARAM_INT);
        $consulta->bindValue(':estado', $this->_estado, PDO::PARAM_BOOL);
        $consulta->execute();
        return $objAccesoDatos->obtenerUltimoId();
    }

    public function modificarUsuario($externo = false)
    {
        if ($externo){
            $this->_id = $this->{'id'};
            $this->_usuario = $this->{'usuario'};
            $this->_clave = $this->{'clave'};
            $this->_nombre = $this->{'nombre'};
            $this->_apellido = $this->{'apellido'};
            $this->_correo = $this->{'correo'};
            $this->_idSector = $this->{'id_sector'};
            $this->_prioridad = $this->{'prioridad'};
            $this->_estado = $this->{'estado'};
        }
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE usuarios 
            SET usuario = :usuario,
                clave = :clave,
                nombre = :nombre,
                apellido = :apellido,
                correo = :correo,
                id_sector = :id_sector,
                prioridad = :prioridad,
                estado = :estado 
            WHERE id = :id");
        $consulta->bindValue(':id', $this->_id, PDO::PARAM_INT);
        $consulta->bindValue(':usuario', $this->_usuario, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $this->_clave, PDO::PARAM_STR);
        $consulta->bindValue(':nombre', $this->_nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $this->_apellido, PDO::PARAM_STR);
        $consulta->bindValue(':correo', $this->_correo, PDO::PARAM_STR);
        $consulta->bindValue(':id_sector', $this->_idSector, PDO::PARAM_INT);
        $consulta->bindValue(':prioridad', $this->_prioridad, PDO::PARAM_INT);
        $consulta->bindValue(':estado', $this->_estado, PDO::PARAM_BOOL);
        $consulta->execute();
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

    public static function DescargaUsuarios($usuarios){
        $fileController = new FileController('public/csv/');
        $file = $fileController->abrirArchivo('usuarios', 'csv');
        foreach ($usuarios as $usuario) {
            fputcsv($file, $usuario);
        }
        fclose($file);
    }

    public static function CargarUsuarios($archivo){
        $file = fopen($archivo, 'r');
        while (($data = fgetcsv($file)) !== FALSE) {
            $usuario = new Usuario();
            $usuario->setUsuario($data[0]);
            $usuario->setClave(password_hash($data[1], PASSWORD_DEFAULT));
            $usuario->setNombre($data[2]);
            $usuario->setApellido($data[3]);
            $usuario->setCorreo($data[4]);
            $usuario->setIdSector((int)$data[5]);
            $usuario->setPrioridad((int)$data[6]);
            $usuario->setEstado(1);
            $usuario->crearUsuario();
        }
        fclose($file);
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
    public function getNombre(){
        return $this->_nombre;
    }
    public function getApellido(){
        return $this->_apellido;
    }
    public function getCorreo(){
        return $this->_correo;
    }
    
    public function getIdSector(){
        return $this->_idSector;
    }
    
    public function getPrioridad(){
        return $this->_prioridad;
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
    public function setUsuario($valor){
        $this->_usuario = $valor;
    }
    public function setClave($valor){
        $this->_clave = $valor;
    }
    public function setNombre($valor){
        $this->_nombre = $valor;
    }
    public function setApellido($valor){
        $this->_apellido = $valor;
    }
    public function setCorreo($valor){
        $this->_correo = $valor;
    }
    public function setIdSector($valor){
        $this->_idSector = $valor;
    }
    public function setPrioridad($valor){
        $this->_prioridad = $valor;
    }
    public function setEstado($valor){
        $this->_estado = $valor;
    }
    public function setFechaBaja($valor){
        $this->_fechaBaja = $valor;
    }
    
}

?>