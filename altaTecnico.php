<?php
	require_once 'data/tecnico.php';
	foreach ($_POST as $clave => $value) #Crea variables automaticamente de cada campo de post con su respectivo nombre
    {
        ${$clave}=$_POST[$clave];
    }
	$tec = new Tecnico($nombreT,$tipoT,$obsT,1,null);
	$tec->save();
	echo '<div class="container">
				<div class="row jump-max">
					<div class="col-md-6 col-md-offset-3">
						<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Tecnico '.$tec->getNombre().' agregado correctamente</strong></div>
					</div>
				</div>
			</div>';
?>
<meta http-equiv="Refresh" content="2;url=index.php?p=altas">