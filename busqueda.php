<?php
	if (isset($_SESSION["user"]))
	{
?>
<div class="container-fluid">
	<div class="row">
		<div class=" col-md-2 jump-max">
			<span id="edvac"></span>
			<div class="btn-group-vertical" role="group" aria-label="...">
				<a class="btn btn-danger btn-lg" href="index.php?p=citas">Citas en curso</a>
				<a class="btn btn-danger btn-lg" href="index.php?p=busqueda">Citas programadas</a>
				<a class="btn btn-danger btn-lg" href="index.php?p=altas">Panel de control</a>
			</div>
		</div>
		<div class="col-md-10 jump-min">
			<div class="row">
				<div class="col-md-12">
					<div class="jumbotron">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-6">
									<h1>Busqueda</h1>
								</div>
								<div class="col-md-offset-3 col-md-3">
									<h3><span class="glyphicon glyphicon-user"></span> Usuario: <?php echo $_SESSION['user']; ?></h3>
									<a class="btn btn-warning" href="index.php?p=logout">Cerrar Sesión</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 throw-down">
					<form name="buscar" method="post" action="index.php?p=postBuscar">
						<div class="form-group">
							<div class="row">
								<div class="col-md-3">
									<label>Fecha de las citas a buscar</label>
									<div class='input-group date' id='dates'>
										<input type='text' id="fechaB" name="fechaB" class="form-control" />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-danger btn-lg">Buscar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	}
	else
	{
		print '<script type="text/javascript">
            	$(location).attr("href","index.php?p=login");
        	</script>';
	}
?>