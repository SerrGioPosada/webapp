<?php 
class Usuarios{
    private $idUsuario;
    private $email;
    private $password;
    private $nivelAcceso;
    public function __construct() {
    }

    public function getIdUsuario() {
            return $this->idUsuario;
    }
    
    public function setIdUsuario($idUsuario){
     $this->idUsuario = $idUsuario;
   } 

   public function getEmail(){
    return $this->email;
  } 
  public function setEmail($email){
    $this->email = $email;
  } 
  public function getPassword(){
   return $this->password;
  } 
  public function setPassword($password){
    $this->password = $password;
  } 
  public function getNivelAcceso(){
    return $this->nivelAcceso;
  } 
  public function setNivelAcceso($nivelAcceso){
    $this->nivelAcceso = $nivelAcceso;
  } 

    public function actualizar($bd) {
         $comandoSql= "UPDATE usuarios SET
         email='".$this->email."'
         WHERE idUsuario =".$this->idUsuario;
        $resultado = $bd->ejecutarConsulta($comandoSql);
        return $resultado;    
    } 
    
    public function existeNombreUsuario($bd, $nombreUsuario) {
        $comandoSql = "SELECT * FROM usuarios WHERE email = '".$nombreUsuario."'";
        $resultado = $bd->ejecutarConsulta($comandoSql);
        $numeroFilas = $bd->numeroFilas($resultado);
        if ($numeroFilas == 0){
        return false;
        } 
        else{
            $registro = $bd->obtenerFila($resultado);
            $this->idUsuario = $registro['idUsuario'];
            $this->email = $registro['email'];
            $this->password = $registro['password'];
            return true;
            } 
    } 

    public function existe($bd, $codigo) {
        $comandoSql = "SELECT * FROM usuarios WHERE idUsuario = ".$codigo;
        $resultado = $bd->ejecutarConsulta($comandoSql);
        $numeroFilas = $bd->numeroFilas($resultado);
        if ($numeroFilas == 0){
        return false;
        } 
        else{
            $registro = $bd->obtenerFila($resultado);
            $this->idUsuario = $registro['idUsuario'];
            $this->email = $registro['email'];
            $this->password = $registro['password'];
            return true;
            } 
    } 
 
    
    public function listado($bd){
        $comandoSql = "SELECT * FROM usuarios ORDER BY idUsuario ASC";
        $resultado = $bd->ejecutarConsulta($comandoSql);
        return $resultado;
    }
    public function eliminar($bd, $codigo){
        $comandoSql = "SELECT * FROM usuarios WHERE idUsuario =".$codigo;
        $resultado = $bd->ejecutarConsulta($comandoSql);
        return $resultado;
    }
    public function adicionar($bd){
        $this->password = md5( $this->password );
        $consulta = "INSERT INTO usuarios (
        email,
        password
        ) VALUES (
        '".$this->email."',
        '".$this->password."'
        )";
        $resultado = $bd->ejecutarConsulta($consulta);
        return $resultado;
    }
    public function disponible($bd, $email) {
        $comandoSql = "SELECT * FROM usuarios WHERE email = '".$email."'";
        $resultado = $bd->ejecutarConsulta($comandoSql);
        $numeroFilas = $bd->numeroFilas($resultado);
        if ($numeroFilas == 0){
        return true;
        } 
        else{
            return false;
            } 
    } 
    public function cambiarPassword($bd, $email, $pass, $passNuevo) {
        $pass = md5($pass);
        $comandoSql = "SELECT * FROM usuarios WHERE email = '".$email."'";
        $resultado = $bd->ejecutarConsulta($comandoSql);
        $registro = $bd->obtenerFila($resultado);
        $passdb = $registro['password'];
        if ($pass == $passdb){
            $passNuevo = md5( $passNuevo );
            $cons = "UPDATE usuarios SET password='".$passNuevo."' WHERE email = '".$email."'";
            $resultado = $bd->ejecutarConsulta($cons);
        
        if ( $resultado )
            return true;
        }
        return false;
    } 
    public function restablecerClave($bd, $email, $passNuevo) {
        $passNuevo = md5( $passNuevo );
        $comandoSql = "UPDATE usuarios SET password='".$passNuevo. "'WHERE email = '".$email."'";
        $resultado = $bd->ejecutarConsulta($comandoSql);
        if ($resultado)
        return true;
        else
            return false;
         
    } 
 
}
?>