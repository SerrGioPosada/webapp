<?php 
class BaseDatos{
    private $servidor;
    private $puerto;
    private $usuario;
    private $clave;
    private $dbName;
    private $conexion;
    
    public function __construct($servidor, $puerto, $usuario, $clave, $dbName){

        $this->servidor = $servidor;
        $this->puerto = $puerto; 
        $this->usuario = $usuario; 
        $this->clave = $clave; 
        $this->dbName = $dbName;
    }

    public function conectar(){
         $this->conexion = mysqli_connect($this->servidor, $this->usuario, $this->clave);
        if ( !$this->conexion ){
            return 0;
        }
        else{
            $select_db = mysqli_select_db($this->conexion, $this->dbName);
           if (!$select_db){
            return 0;
           }else{
            return $this->conexion;
        }
    }
}
public function getConexion(){
    return $this->conexion;
}
    
    public function ejecutarConsulta($consulta) {
         $resultado=mysqli_query($this->conexion, $consulta);
         if (!$resultado)  {// add this check.
            die('Invalid query: ' . mysqli_error($this->conexion));
        }
        return $resultado;    
    } 
    
    public function obtenerFila($resultado) {
        return mysqli_fetch_array($resultado);
    } 

    public function numeroFilas($resultado) {
        return mysqli_num_rows($resultado);
    }   
    
    public function desconectar(){
        mysqli_close($this->conexion);
    }

    public function __destruct(){
        $this->desconectar();
    }  
}
?>