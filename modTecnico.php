<?php
	require_once "data/tecnico.php";
	if (count($_POST)>0)
	{
		foreach($_POST as $clave => $valor)
		{
			${$clave} = $_POST[$clave];
		}
		if (isset($foco))
		{
			$tecnico = new Tecnico($nombreTecnico,$tipoTecnico,$obsTecnico,0,$idTecnico);
			$message = '<div class="container">
				<div class="row jump-max">
					<div class="col-md-6 col-md-offset-3">
						<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Tecnico Eliminado</strong></div>
					</div>
				</div>
			</div>';
		}
		else
		{
			$tecnico = new Tecnico($nombreTecnico,$tipoTecnico,$obsTecnico,1,$idTecnico);
			$message = '<div class="container">
				<div class="row jump-max">
					<div class="col-md-6 col-md-offset-3">
						<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Tecnico Actualizado</strong></div>
					</div>
				</div>
			</div>';
		}
		$tecnico->save();
		echo $message;
	}
	else
	{
		echo "Post no trae nada";
	}
?>
<meta http-equiv="Refresh" content="2;url=index.php?p=altas">