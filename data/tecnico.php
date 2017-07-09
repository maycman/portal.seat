<?php
	require_once 'data/maria.php';
	class Tecnico
	{
		private $id;
		private $nombre;
		private $tipo;
		private $obs;
		private $ver;
		private $flag;
		const TABLA = 'tecnicos';
		public function getid()
		{
			return $this->id;
		}
		public function getNombre()
		{
			return $this->nombre;
		}
		public function getTipo()
		{
			return $this->tipo;
		}
		public function getObs()
		{
			return $this->obs;
		}
		public function getVer()
		{
			return $this->ver;
		}
		public function getFlag()
		{
			return $this->flag;
		}
		public function setNombre($param)
		{
			$this->nombre = $param;
		}
		public function setTipo($param)
		{
			$this->tipo = $param;
		}
		public function setObs($param)
		{
			$this->Obs = $param;
		}
		public function setFlag($param)
		{
			$this->flag = $param;
		}
		public function __construct($nombre, $tipo, $obser, $ver, $flag, $id=null)
		{
			$this->nombre = $nombre;
			$this->tipo = $tipo;
			$this->obs = $obser;
			$this->ver = $ver;
			$this->flag = $flag;
			$this->id = $id;
		}
		public function save()
		{
			$conn = new Conexion("seat_citas");
			$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if($this->id) /*Modifica*/
			{
				$consulta = $conn->prepare('UPDATE ' . self::TABLA .' SET nombre_tecnico = :nombre, tipo_tecnico = :tipo, obs_tecnico = :obs, ver_tecnico = :ver, flag_tecnico = :flag WHERE id_tecnico = :id');
				$consulta->bindParam(':nombre', $this->nombre);
				$consulta->bindParam(':tipo', $this->tipo);
				$consulta->bindParam(':obs', $this->obs);
				$consulta->bindParam(':ver', $this->ver);
				$consulta->bindParam(':flag', $this->flag);
				$consulta->bindParam(':id', $this->id);
				$consulta->execute();
			}
			else /*Inserta*/
			{
				$consulta = $conn->prepare('INSERT INTO ' . self::TABLA .' (nombre_tecnico, tipo_tecnico, obs_tecnico, ver_tecnico, flag_tecnico) VALUES(:nombre, :tipo, :obs, :ver, :flag)');
				$consulta->bindParam(':nombre', $this->nombre);
				$consulta->bindParam(':tipo', $this->tipo);
				$consulta->bindParam(':obs', $this->obs);
				$consulta->bindParam(':ver', $this->ver);
				$consulta->bindParam(':flag', $this->flag);
				$consulta->execute();
				$this->id = $conn->lastInsertId();
			}
			$conn = null;
		}
	}
?>