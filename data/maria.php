<?php
	class Conexion extends PDO
	{
		private $tipo_de_base = "mysql";
		private $host = "localhost";
		private $nombre_base;
		private $usuario = "root";
		private $passwd = "root";
		public function __construct(/*$tipo,$hos,*/$nombre/*,$user,$pass*/)
		{
			#$this->tipo_de_base = $tipo;
			#$this->host = $hos;
			$this->nombre_base = $nombre;
			#$this->usuario = $user;
			#$this->passwd = $pass;
			//Metodo constructor sobreescrito
			try
			{
				parent::__construct($this->tipo_de_base.':host='.$this->host.';dbname='.$this->nombre_base,$this->usuario,$this->passwd);
			}
			catch(PDOException $err)
			{
				print 'Algo ha salido mal con la conexion'.$err->getMessage();
				exit;
			}
		}
	}
?>