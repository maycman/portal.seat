<?php
	require_once "data/servicio.php";
	if (isset($_POST)) 
	{
		foreach ($_POST as $key => $value)
		{
			${$key} = $_POST[$key];
		}
		$signoP = '$'.$costeS;
		$servicio = new Servicio($nombreS,$kmS,$signoP,$utS,1,null);
		$servicio->save();
		echo '<div class="container">
				<div class="row jump-max">
					<div class="col-md-6 col-md-offset-3">
						<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Servicio '.$servicio->getServicio().' agregado correctamente</strong></div>
					</div>
				</div>
			</div>';
	}
	else
	{
		echo "Post vacio";
	}
?>
<meta http-equiv="Refresh" content="2;url=index.php?p=altas">