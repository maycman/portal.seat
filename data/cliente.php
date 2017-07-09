<?php
	require_once "data/maria.php";
	/**
	* 
	*/
	class Cliente
	{
		private $id;
		private $nombre;
		private $apellido;
		private $tel;
		private $email;
		private $idAuto;
		const TABLA = "clientes";
		public function getId()
		{
			return $this->id;
		}
		public function getNombre()
		{
			return $this->nombre;
		}
		public function getApellido()
		{
			return $this->apellido;
		}
		public function getTelefono()
		{
			return $this->tel;
		}
		public function getEmail()
		{
			return $this->email;
		}
		public function getIdAuto()
		{
			return $this->idAuto;
		}
		public function setNombre($nombre)
		{
			$this->nombre = $nombre;
		}
		public function setApellido($apellido)
		{
			$this->apellido = $apellido;
		}
		public function setTelefono($tel)
		{
			$this->tel = $tel;
		}
		public function setEmail($email)
		{
			$this->email = $email;
		}
		public function setIdAuto($idAuto)
		{
			$this->idAuto = $idAuto;
		}
		public function __construct($nombre,$apellido,$tel,$email,$idA,$id=null)
		{
			$this->nombre = $nombre;
			$this->apellido = $apellido;
			$this->tel = $tel;
			$this->email = $email;
			$this->idAuto = $idA;
			$this->id = $id;
		}
		public function save()
		{
			$conn = new Conexion("seat_citas");
			$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if ($this->id)
			{
				$modifica = $conn->prepare("update ". self::TABLA ." set nombre_cliente = :nombre, apellidos_cliente = :apellido, telefono_cliente = :tel, email_cliente = :email, id_automovil = :idA where id_cliente = :id");
				$modifica->bindParam(':nombre', $this->nombre);
				$modifica->bindParam(':apellido', $this->apellido);
				$modifica->bindParam(':tel', $this->tel);
				$modifica->bindParam(':email', $this->email);
				$modifica->bindParam(':idA', $this->idAuto);
				$modifica->execute();
			}
			else
			{
				$agrega = $conn->prepare("insert into ". self::TABLA ." (nombre_cliente, apellidos_cliente, telefono_cliente, email_cliente, id_automovil) values(:nombre, :apellido, :tel, :email, :idA)");
				$agrega->bindParam(':nombre', $this->nombre);
				$agrega->bindParam(':apellido', $this->apellido);
				$agrega->bindParam(':tel', $this->tel);
				$agrega->bindParam(':email', $this->email);
				$agrega->bindParam(':idA', $this->idAuto);
				$agrega->execute();
				$this->id = $conn->lastInsertId();
			}
			$conn = null;
		}
	}
?>