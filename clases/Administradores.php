<?php
class Administradores{
	private $idAdministrador;
	private $nombres;
	private $apellidos;
	private $direccion;
	private $telefono;
	private $usuarios_idUsuario;
	
    function __construct() {
    }

    public function getIdAdministrador() {
        return $this->idAdministrador;
    }

    public function setIdAdministrador($idAdministrador) {
        $this->idAdministrador = $idAdministrador;
    }

    public function getNombres() {
        return $this->nombres;
    }

    public function setNombres($nombre) {
        $this->nombres = $nombre;
    }
	
    public function getApellidos() {
        return $this->apellidos;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function getUsuarios_idUsuario() {
        return $this->usuarios_idUsuario;
    }

    public function setUsuarios_idUsuario($usuarios_idUsuario) {
        $this->usuarios_idUsuario = $usuarios_idUsuario;
    }
	
    public function actualizar($bd){
		$comandoSql = "UPDATE administradores SET 
		nombres ='".$this->nombres."',
		apellidos ='".$this->apellidos."', 
		direccion ='".$this->direccion."',
		telefono ='".$this->telefono."', 
		usuarios_idUsuario =".$this->usuarios_idUsuario." 
		WHERE idAdministrador =".$this->idAdministrador;
		$resultado = $bd->ejecutarConsulta($comandoSql);
		return $resultado;
	}

    public function existe($bd, $codigo) {
		$comandoSql = "SELECT * FROM administradores WHERE idAdministrador = ".$codigo;
		$resultado = $bd->ejecutarConsulta($comandoSql);
		$numeroFilas = $bd->numeroFilas($resultado);
		if ( $numeroFilas == 0 ){
			return false;
		}
		else{
			$registro = $bd->obtenerFila($resultado);
			$this->idAdministrador = $registro['idAdministrador'];
			$this->nombres = $registro['nombres'];
			$this->apellidos = $registro['apellidos'];
			$this->direccion = $registro['direccion'];
			$this->telefono = $registro['telefono'];
			$this->usuarios_idUsuario = $registro['usuarios_idUsuario'];
			return true;
		}
	}

    public function existeIdUsuario($bd, $codigo) {
		$comandoSql = "SELECT * FROM administradores WHERE usuarios_idUsuario = ".$codigo;
		$resultado = $bd->ejecutarConsulta($comandoSql);
		$numeroFilas = $bd->numeroFilas($resultado);
		if ( $numeroFilas == 0 ){
			return false;
		}
		else{
			$registro = $bd->obtenerFila($resultado);
			$this->idAdministrador = $registro['idAdministrador'];
			$this->nombres = $registro['nombres'];
			$this->apellidos = $registro['apellidos'];
			$this->direccion = $registro['direccion'];
			$this->telefono = $registro['telefono'];
			$this->usuarios_idUsuario = $registro['usuarios_idUsuario'];
			return true;
		}
	}

	public function listado($bd){
		$comandoSql = "SELECT * FROM administradores ORDER BY idAdministrador ASC";
		$resultado = $bd->ejecutarConsulta($comandoSql);
		return $resultado;
	}

    public function eliminar($bd, $codigo){
		$comandoSql = "DELETE FROM administradores WHERE idAdministrador =".$codigo;
		$resultado = $bd->ejecutarConsulta($comandoSql);
		return $resultado;
	}

    public function adicionar($bd){
        $consulta = "INSERT INTO administradores ( 
		nombres,
		apellidos, 
		direccion, 
		telefono, 
		usuarios_idUsuario 
		) VALUES ( 
		'".$this->nombres."', 
		'".$this->apellidos."', 
		'".$this->direccion."', 
		'".$this->telefono."', 
		".$this->usuarios_idUsuario."
		)";
        $resultado = $bd->ejecutarConsulta($consulta);
        return $resultado;
    }

}
?>