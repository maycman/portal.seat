<?php
	require_once "data/maria.php";
	class Automovil
	{
		private $id;
		private $modelo;
		private $km;
		private $placas;
		const TABLA = "automoviles";
		public function getId()
		{
			return $this->id;
		}
		public function getModelo()
		{
			return $this->modelo;
		}
		public function getKm()
		{
			return $this->km;
		}
		public function getPlacas()
		{
			return $this->color;
		}
		public function setModelo($modelo)
		{
			$this->modelo = $modelo;
		}
		public function setKm($km)
		{
			$this->km = $km;
		}
		public function setPlacas($placas)
		{
			$this->placas = $placas;
		}
		public function __construct($modelo,$km,$placas,$id=null)
		{
			$this->modelo = $modelo;
			$this->km = $km;
			$this->placas = $placas;
			$this->id = $id;
		}
		public function save()
		{
			$conn = new Conexion("seat_citas");
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if ($this->id)
			{
				$modifica = $conn->prepare("update ". self::TABLA ." set modelo_automovil = :modelo, km_automovil = :km, placas_automovil = :placas where id_automovil = :id");
				$modifica->bindParam(":modelo", $this->modelo);
				$modifica->bindParam(":km", $this->km);
				$modifica->bindParam(":placas", $this->placas);
				$modifica->bindParam(":id", $this->id);
				$modifica->execute();
			}
			else
			{
				$agrega = $conn->prepare("insert into ". self::TABLA ." (modelo_automovil, km_automovil, placas_automovil) values(:modelo, :km, :placas)");
				$agrega->bindParam(":modelo", $this->modelo);
				$agrega->bindParam(":km", $this->km);
				$agrega->bindParam(":placas", $this->placas);
				$agrega->execute();
				$this->id = $conn->lastInsertId();
			}
			$conn = null;
		}
	}
?>