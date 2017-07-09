<?php
	require_once "data/servicio.php";
	if (isset($_POST))
	{
		foreach ($_POST as $key => $value)
		{
			${$key} = $_POST[$key];
		}
		if (isset($foco3))
		{
			$servicio = new Servicio($nombreServicio,$kmServicio,$costoServicio,$utsServicio,0,$idServicio);
			$message = '<div class="container">
				<div class="row jump-max">
					<div class="col-md-6 col-md-offset-3">
						<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Servicio Eliminado</strong></div>
					</div>
				</div>
			</div>';
		}
		else
		{
			$servicio = new Servicio($nombreServicio,$kmServicio,$costoServicio,$utsServicio,1,$idServicio);
			$message = '<div class="container">
				<div class="row jump-max">
					<div class="col-md-6 col-md-offset-3">
						<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Servicio Actualizado</strong></div>
					</div>
				</div>
			</div>';
		}
		$servicio->save();
		echo $message;
	}
	else
	{
		echo "Post vacio";
	}
?>
<meta http-equiv="Refresh" content="2;url=index.php?p=altas">