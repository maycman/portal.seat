<?php
	if ($_POST )
	{
		require_once "data/cliente.php";
		require_once "data/automovil.php";
		require_once "data/cita.php";
		require_once "data/consultas.php";
		//traemos los valores de POST
		foreach ($_POST as $key => $value)
		{
			${$key} = $_POST[$key];
		}
		#Le damos formato a la fecha para guardarla en la base de datos
		$arreglo = explode("/",$fecha);
		$formato = $arreglo[2]."-".$arreglo[0]."-".$arreglo[1];
		#Codificamos UTF para acentos y caracteres especiales
		$nombre_auto = utf8_encode($autoCl);
		$nombre_cliente = utf8_encode($nombreCl);
		$apellido_cliente = utf8_encode($apellidoCl);
		//Verificamos que el asesor no tenga citas ya programadas
		$agendar = new Query($asesorCl,$tecnicoCl,$formato,$hora);
		$dato = $agendar->asesorDisponible();
		if($dato=="ok")
		{
			//Verificamos que el tecnico este disponible
			$dat = $agendar->tecnicoDisponible();
			if ($dat == "ok")
			{
				// Ingresamos primero el auto a la base de datos para despues enlazarlo con el cliente
				$auto = new Automovil($nombre_auto,$kmCl,$colorCl);
				$auto->save();
				// traemos el id del auto recien ingresado
				$idAuto = $auto->getId();
				// Ahora con el id del auto podemos registrar a nuestro cliente
				$cliente = new Cliente($nombre_cliente,$apellido_cliente,$telefonoCl,$emailCl,$idAuto);
				$cliente->save();
				//Ahora obtenemos tambien el id del cliente para registrar su cita
				$icliente = $cliente->getId();
				//Registramos la cita en la base de datos
				$cita = new Cita($icliente,$asesorCl,$tecnicoCl,$servicioCl,$formato,$hora,"Abierta");
				$cita->save();
				echo '<div class="container">
						<div class="row jump-max">
							<div class="col-md-6 col-md-offset-3">
								<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Cita '.$cita->getId().' agregada correctamente</strong></div>
							</div>
						</div>
					</div>';
				?><meta http-equiv="Refresh" content="2;url=index.php?p=citas"><?php
			}
			else
			{
				echo '<div class="container">
						<div class="row jump-max">
							<div class="col-md-6 col-md-offset-3">
								<div class="alert alert-dismissible alert-warning"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Técnico no disponible</strong></div>
							</div>
						</div>
					</div>';
				?><meta http-equiv="Refresh" content="3;url=index.php?p=citas"><?php
			}
		}
		else
		{
			echo '<div class="container">
					<div class="row jump-max">
						<div class="col-md-6 col-md-offset-3">
							<div class="alert alert-dismissible alert-warning"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Asesor no disponible</strong></div>
						</div>
					</div>
				</div>';
			?><meta http-equiv="Refresh" content="3;url=index.php?p=citas"><?php
		}
		exit;
	}
	else
	{
		echo "Post vacio";
	}
?>