<?php
	require_once "data/maria.php";
	class Cita
	{
		private $id;
		private $icliente;
		private $iasesor;
		private $itecnico;
		private $servicio;
		private $inFecha;
		private $inHora;
		private $estado;
		const TABLA = "citas";
		public function getId()
		{
			return $this->id;
		}
		public function getIdCliente()
		{
			return $this->icliente;
		}
		public function getIdAsesor()
		{
			return $this->iasesor;
		}
		public function getIdTecnico()
		{
			return $this->itecnico;
		}
		public function getIdServicio()
		{
			return $this->iservicio;
		}
		public function getFecha()
		{
			return $this->inFecha;
		}
		public function setIdCliente($cliente)
		{
			$this->icliente = $cliente;
		}
		public function setIdAsesor($asesor)
		{
			$this->iasesor = $asesor;
		}
		public function setIdTecnico($tecnico)
		{
			$this->itecnico = $tecnico;
		}
		public function setIdServicio($servicio)
		{
			$this->iservicio = $servicio;
		}
		public function setFecha($fecha)
		{
			$this->inFecha = $fecha;
		}
		public function __construct($cliente,$asesor,$tecnico,$servicio,$infecha,$inHora,$estado,$id=null)
		{
			$this->icliente = $cliente;
			$this->iasesor = $asesor;
			$this->itecnico = $tecnico;
			$this->iservicio = $servicio;
			$this->inFecha = $infecha;
			$this->inHora = $inHora;
			$this->estado = $estado;
			$this->id = $id;
		}
		public function save()
		{
			$conn = new Conexion("seat_citas");
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if ($this->id)
			{
				$modifica = $conn->prepare("update ". self::TABLA ." set id_cliente = :cliente, id_asesor = :asesor, id_tecnico = :tecnico, id_servicio = :servicio, fecha = :infecha, hora = :inHora, estado_cita = :estado where id_cita = :id");
				$modifica->bindParam(":cliente", $this->icliente);
				$modifica->bindParam(":asesor", $this->iasesor);
				$modifica->bindParam(":tecnico", $this->itecnico);
				$modifica->bindParam(":servicio", $this->iservicio);
				$modifica->bindParam(":infecha", $this->inFecha);
				$modifica->bindParam(":inHora", $this->inHora);
				$modifica->bindParam(":estado", $this->estado);
				$modifica->bindParam(":id", $this->id);
				$modifica->execute();
			}
			else
			{
				$agrega = $conn->prepare("insert into ". self::TABLA ." (id_cliente,id_asesor,id_tecnico,id_servicio,fecha,hora,estado_cita) values(:cliente, :asesor, :tecnico, :servicio, :infecha, :inHora, :estado)");
				$agrega->bindParam(":cliente", $this->icliente);
				$agrega->bindParam(":asesor", $this->iasesor);
				$agrega->bindParam(":tecnico", $this->itecnico);
				$agrega->bindParam(":servicio", $this->iservicio);
				$agrega->bindParam(":infecha", $this->inFecha);
				$agrega->bindParam(":inHora", $this->inHora);
				$agrega->bindParam(":estado", $this->estado);
				$agrega->execute();
				$this->id = $conn->lastInsertId();
			}
			$conn = null;
		}
	}
?>