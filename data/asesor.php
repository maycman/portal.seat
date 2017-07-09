<?php
	require_once "data/maria.php";
	class Asesor
	{
		private $id;
		private $nombre;
		private $obs;
		private $ver;
		private $flag;
		const TABLA = "asesores";
		public function getId()
		{
			return $this->id;
		}
		public function getNombre()
		{
			return $this->nombre;
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
		public function setNombre($nombre)
		{
			$this->nombre = $nombre;
		}
		public function setObs($obs)
		{
			$this->obs = $obs;
		}
		public function setFlag($flag)
		{
			$this->flag = $flag;
		}
		public function __construct($nombre, $obs, $ver, $flag, $id=null)
		{
			$this->nombre = $nombre;
			$this->obs = $obs;
			$this->ver = $ver;
			$this->flag = $flag;
			$this->id = $id;
		}
		public function save()
		{
			$conn = new Conexion("seat_citas");
			$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if ($this->id)
			{
				$modifica = $conn->prepare("UPDATE ". self::TABLA ." SET nombre_asesor = :nombre, obs_asesor = :obs, ver_asesor = :ver, flag_asesor = :flag where id_asesor = :id");
				$modifica->bindParam(':nombre',$this->nombre);
				$modifica->bindParam(':obs',$this->obs);
				$modifica->bindParam(':ver',$this->ver);
				$modifica->bindParam(':flag', $this->flag);
				$modifica->bindParam(':id',$this->id);
				$modifica->execute();
			}
			else
			{
				$agrega = $conn->prepare('INSERT INTO ' . self::TABLA .' (nombre_asesor, obs_asesor, ver_asesor, flag_asesor) VALUES(:nombre, :obs, :ver, :flag)');
				$agrega->bindParam(':nombre', $this->nombre);
				$agrega->bindParam(':obs', $this->obs);
				$agrega->bindParam(':ver', $this->ver);
				$agrega->bindParam(':flag', $this->flag);
				$agrega->execute();
				$this->id = $conn->lastInsertId();
			}
			$conn = null;
		}
	}
?>