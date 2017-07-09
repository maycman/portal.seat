<?php
	session_destroy();
	session_unset();
	echo '<div class="container">
	<div class="row jump-max">
		<div class="col-md-6 col-md-offset-3">
			<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Se ha cerrado la sesión correctamente</strong></div>
		</div>
	</div>
	</div>';
?>
<meta http-equiv="Refresh" content="2;url=/portalseat">