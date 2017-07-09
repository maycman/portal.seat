<?php
	require_once "data/asesor.php";
	if (isset($_POST))
	{
		foreach ($_POST as $key => $value)
		{
			${$key} = $_POST[$key];
		}
		$asesor = new Asesor($nombreA,$obsA,1,null);
		$asesor->save();
		echo '<div class="container">
				<div class="row jump-max">
					<div class="col-md-6 col-md-offset-3">
						<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Asesor '.$asesor->getNombre().' agregado correctamente</strong></div>
					</div>
				</div>
			</div>';
	}
	else
	{
		echo "Post Vacio";
	}
?>
<meta http-equiv="Refresh" content="2;url=index.php?p=altas">