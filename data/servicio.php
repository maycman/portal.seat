<?php
	require_once "data/maria.php";
	class Servicio
	{
		private $id;
		private $servicio;
		private $km_servicio;
		private $coste;
		private $uts_necesarias;
		private $ver;
		private $flag;
		const TABLA = 'servicios';
		public function getId()
		{
			return $this->id;
		}
		public function getServicio()
		{
			return $this->servicio;
		}
		public function getKm()
		{
			return $this->km_servicio;
		}
		public function getCoste()
		{
			return $this->coste;
		}
		public function getUts()
		{
			return $this->uts_necesarias;
		}
		public function getVer()
		{
			return $this->ver;
		}
		public function getFlag()
		{
			return $this->flag;
		}
		public function setServicio($servicio)
		{
			$this->servicio = $servicio;
		}
		public function setKm($km_servicio)
		{
			$this->km_servicio = $km_servicio;
		}
		public function setCoste($coste)
		{
			$this->coste = $coste;
		}
		public function setUts($uts)
		{
			$this->uts_necesarias = $uts;
		}
		public function setFlag($flag)
		{
			$this->flag = $flag;
		}
		public function __construct($servicio, $km, $coste, $uts, $ver, $flag, $id=null)
		{
			$this->servicio = $servicio;
			$this->km_servicio = $km;
			$this->coste = $coste;
			$this->uts_necesarias = $uts;
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
				$modifica = $conn->prepare("UPDATE ". self::TABLA ." SET nombre_servicio = :nombre, km_servicio = :km, coste_servicio = :coste, uts_necesarias = :uts, ver_servicio = :ver, flag_servicio = :flag where id_servicio = :id");
				$modifica->bindParam(":nombre", $this->servicio);
				$modifica->bindParam(":km", $this->km_servicio);
				$modifica->bindParam(":coste", $this->coste);
				$modifica->bindParam(":uts", $this->uts_necesarias);
				$modifica->bindParam(":ver", $this->ver);
				$modifica->bindParam(":flag", $this->flag);
				$modifica->bindParam(":id", $this->id);
				$modifica->execute();
			}
			else
			{
				try
				{
				$agrega = $conn->prepare('INSERT INTO '. self::TABLA .' (nombre_servicio, km_servicio, coste_servicio, uts_necesarias, ver_servicio, flag_servicio) VALUES(?,?,?,?,?,?)');
				$agrega->bindParam(1, $this->servicio);
				$agrega->bindParam(2, $this->km_servicio);
				$agrega->bindParam(3, $this->coste);
				$agrega->bindParam(4, $this->uts_necesarias);
				$agrega->bindParam(5, $this->ver);
				$agrega->bindParam(6, $this->flag);
				$agrega->execute();
				$this->id = $conn->lastInsertId();
				}
				catch(PDOException $e)
				{
					echo $e->getMessage();
				}
			}
			$conn = null;
		}
	}
?>