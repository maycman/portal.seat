<?php
	if (isset($_SESSION["user"]))
	{
		require_once "data/maria.php";
		$conn = new Conexion("seat_citas");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$fecha = date('Y-m-d');
		$cliente = $conn->prepare("select * from automoviles au inner join (clientes c inner join citas ci on c.id_cliente = ci.id_cliente) on au.id_automovil = c.id_automovil where ci.fecha = :fecha");
		$cliente->bindParam(':fecha', $fecha);
		$cliente->execute();

?>
<div class="container-fluid">
	<div class="row">
		<div class=" col-md-2 jump-max">
			<span id="edvac"></span>
			<div class="btn-group-vertical" role="group" aria-label="...">
				<a class="btn btn-danger btn-lg" href="index.php?p=citas">Citas en curso</button>
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
									<h1>Citas</h1>
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
					<button class="btn btn-warning btn-lg" data-toggle="modal" data-target="#nCita">Nueva Cita</button>
					<?php require_once "register.php"; ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<td>Cliente</td>
									<td>Detalles</td>
									<td>Automovil</td>
									<td>Detalles</td>
									<td>Servicio</td>
									<td>Asesor que atiende</td>
									<td>Tecnico que atiende</td>
									<td>Fecha de ingreso</td>
									<td>Hora de ingreso</td>
								</tr>
							</thead>
							<tbody>
							<?php 
								while ($datos = $cliente->fetch())
								{
									$servicio = $conn->prepare("select * from servicios s inner join citas c on s.id_servicio=c.id_servicio where c.id_cita = :cita");
									$asesor = $conn->prepare("select * from asesores a inner join citas c on a.id_asesor = c.id_asesor where c.id_cita = :cita");
									$tecnico = $conn->prepare("select * from tecnicos t inner join citas c on t.id_tecnico = c.id_tecnico where c.id_cita = :cita");
									$servicio->bindParam(':cita', $datos['id_cita']);
									$asesor->bindParam(':cita', $datos['id_cita']);
									$tecnico->bindParam(':cita', $datos['id_cita']);
									$servicio->execute();
									$asesor->execute();
									$tecnico->execute();
									$dato2 = $servicio->fetch();
									$dato3 = $asesor->fetch();
									$dato4 = $tecnico->fetch();
							?>
								<tr>
									<td><?php echo $datos['nombre_cliente']; ?></td>
									<td><button class="btn btn-warning" data-toggle="modal" data-target="#cli<?php echo $datos['id_cliente']; ?>">Ver</button></td>
									<td><?php echo utf8_decode($datos['modelo_automovil']); ?></td>
									<td><button class="btn btn-warning" data-toggle="modal" data-target="#au<?php echo $datos['id_automovil']; ?>">Ver</button></td>
									<td><?php echo $dato2['nombre_servicio']; ?></td>
									<td><?php echo $dato3['nombre_asesor']; ?></td>
									<td><?php echo $dato4['nombre_tecnico']; ?></td>
									<td><?php echo $datos['fecha']; ?></td>
									<td><?php echo $datos['hora']; ?></td>
								</tr>
								<!-- Este es el modal que trae la información del cliente -->
								<div id="cli<?php echo $datos['id_cliente']; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												Datos Del Cliente
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											</div>
											<div class="modal-body">
												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label>Nombre Del Cliente</label>
															<input class="form-control" type="text" disabled value="<?php echo utf8_decode($datos['nombre_cliente']); ?>">
														</div>
														<div class="col-md-6">
															<label>Apellidos</label>
															<input class="form-control" type="text" disabled value="<?php echo utf8_decode($datos['apellidos_cliente']); ?>">
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label>Telefono</label>
															<input class="form-control" type="text" disabled value="<?php echo $datos['telefono_cliente']; ?>">
														</div>
														<div class="col-md-9">
															<label>Correo Electronico</label>
															<input class="form-control" type="text" disabled value="<?php echo $datos['email_cliente']; ?>">
														</div>
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
											</div>
										</div>
									</div>
								</div>
								<div id="au<?php echo $datos['id_automovil']; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												Datos Del Vehiculo
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											</div>
											<div class="modal-body">
												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label>Modelo de automovil</label>
															<input class="form-control" type="text" disabled value="<?php echo utf8_decode($datos['modelo_automovil']); ?>">
														</div>
														<div class="col-md-6">
															<label>Kilometraje del automovil</label>
															<input class="form-control" type="text" disabled value="<?php echo utf8_decode($datos['km_automovil']); ?>">
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label>Placas</label>
															<input class="form-control" type="text" disabled value="<?php echo $datos['placas_automovil']; ?>">
														</div>
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
							</tbody>
						</table>
					</div>
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