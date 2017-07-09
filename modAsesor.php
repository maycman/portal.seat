<?php
	require_once "data/asesor.php";
	if (count($_POST)>0)
	{
		foreach ($_POST as $key => $value)
		{
			${$key} = $_POST[$key];
		}
		if (isset($foco2))
		{
			$asesor = new Asesor($nombreAsesor,$obsAsesor,0,$idAsesor);
			$message = '<div class="container">
				<div class="row jump-max">
					<div class="col-md-6 col-md-offset-3">
						<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Asesor Eliminado</strong></div>
					</div>
				</div>
			</div>';	
		}
		else
		{
			$asesor = new Asesor($nombreAsesor,$obsAsesor,1,$idAsesor);
			$message = '<div class="container">
				<div class="row jump-max">
					<div class="col-md-6 col-md-offset-3">
						<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Asesor Actualizado</strong></div>
					</div>
				</div>
			</div>';
		}
		$asesor->save();
		echo $message;
	}
	else
	{
		echo "Post vacio";
	}
?>
<meta http-equiv="Refresh" content="2;url=index.php?p=altas">