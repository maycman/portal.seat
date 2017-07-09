<?php
	require_once "data/maria.php";
	class Query
	{
		private $idAsesor;
		private $idTecnico;
		private $fecha;
		private $hora;
		#Getters######################
		public function getIdAsesor()
		{
			return $this->idAsesor;
		}
		public function getIdTecnico()
		{
			return $this->idTecnico;
		}
		public function getFecha()
		{
			return $this->fecha;
		}
		public function getHora()
		{
			return $this->hora;
		}
		#Setters#########################
		public function setAsesor($param)
		{
			$this->idAsesor = $param;
		}
		public function setTecnico($param)
		{
			$this->idTecnico = $param;
		}
		public function setFecha($param)
		{
			$this->fecha;
		}
		public function setHora($param)
		{
			$this->hora;
		}
		public function __construct($asesor,$tecnico,$fecha,$hora)
		{
			$this->idAsesor = $asesor;
			$this->idTecnico = $tecnico;
			$this->fecha = $fecha;
			$this->hora = $hora;
		}
		public function asesorDisponible()
		{
			$conn = new Conexion("seat_citas");
			$conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			if ($this->idAsesor)
			{
				$busca = $conn->prepare("select c.id_cita from citas c inner join asesores a on c.id_asesor = a.id_asesor where c.fecha like :fecha and c.id_asesor = :asesor and c.hora = :hora");
				$busca->execute(array(":asesor"=>$this->idAsesor,":fecha"=>$this->fecha,":hora"=>$this->hora));
				$data = $busca->fetch();
				$busca = $conn->prepare("select FOUND_ROWS()");
				$busca->execute();
				$fila = $busca->fetchColumn();
				if ($fila=="1")
				{
					return "np";
				}
				else
				{
					return "ok";
				}
			}
			else
			{
				echo "parameter empty";
			}
		}
		public function tecnicoDisponible()
		{
			$conn = new Conexion("seat_citas");
			$conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			if ($this->idTecnico)
			{
				$busca = $conn->prepare("select t.id_tecnico from tecnicos t inner join citas c on t.id_tecnico=c.id_tecnico where c.id_tecnico=:tecnico and c.fecha = :fecha and c.hora=:hora");
				$busca->execute(array(":tecnico"=>$this->idTecnico,":fecha"=>$this->fecha,":hora"=>$this->hora));
				$data = $busca->fetch();
				$busca =$conn->prepare("select FOUND_ROWS()");
				$busca->execute();
				$fila = $busca->fetchColumn();
				if ($fila=="1")
				{
					return "np";
				}
				else
				{
					return "ok";
				}
			}
			else
			{
				echo "Parameter empty";
			}
		}
	}
?>