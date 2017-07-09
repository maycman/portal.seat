<?php
	if (isset($_SESSION["user"]))
	{
		if ($_POST)
		{
			foreach ($_POST as $key => $value)
			{
				${$key} = $_POST[$key];
			}
			$array = explode("/",$fechaB);
			$datoSql = $array[2].'-'.$array[0].'-'.$array[1];
			require_once "data/maria.php";
			$conn = new Conexion("seat_citas");
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$citas = $conn->prepare("select * from automoviles au inner join (clientes c inner join citas ci on c.id_cliente = ci.id_cliente) on au.id_automovil = c.id_automovil where ci.fecha = :fecha");
			$citas->bindParam(":fecha", $datoSql);
			$citas->execute();
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
									<h1><?php echo $fechaB;?></h1>
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
								while ($dat = $citas->fetch())
								{
									$servicio = $conn->prepare("select * from servicios s inner join citas c on s.id_servicio=c.id_servicio where c.id_cita = :cita");
									$asesor = $conn->prepare("select * from asesores a inner join citas c on a.id_asesor = c.id_asesor where c.id_cita = :cita");
									$tecnico = $conn->prepare("select * from tecnicos t inner join citas c on t.id_tecnico = c.id_tecnico where c.id_cita = :cita");
									$servicio->bindParam(':cita', $dat['id_cita']);
									$asesor->bindParam(':cita', $dat['id_cita']);
									$tecnico->bindParam(':cita', $dat['id_cita']);
									$servicio->execute();
									$asesor->execute();
									$tecnico->execute();
									$dato2 = $servicio->fetch();
									$dato3 = $asesor->fetch();
									$dato4 = $tecnico->fetch();
							?>
								<tr>
									<td><?php echo utf8_decode($dat['nombre_cliente']); ?></td>
									<td><button class="btn btn-warning" data-toggle="modal" data-target="#cli<?php echo $dat['id_cliente']; ?>">Ver</button></td>
									<td><?php echo utf8_decode($dat['modelo_automovil']); ?></td>
									<td><button class="btn btn-warning" data-toggle="modal" data-target="#au<?php echo $dat['id_automovil']; ?>">Ver</button></td>
									<td><?php echo $dato2['nombre_servicio']; ?></td>
									<td><?php echo $dato3['nombre_asesor']; ?></td>
									<td><?php echo $dato4['nombre_tecnico']; ?></td>
									<td><?php echo $dat['fecha']; ?></td>
									<td><?php echo $dat['hora']; ?></td>
								</tr>
								<!-- Este es el modal que trae la información del cliente -->
								<div id="cli<?php echo $dat['id_cliente']; ?>" class="modal fade" role="dialog">
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
															<input class="form-control" type="text" disabled value="<?php echo utf8_decode($dat['nombre_cliente']); ?>">
														</div>
														<div class="col-md-6">
															<label>Apellidos</label>
															<input class="form-control" type="text" disabled value="<?php echo utf8_decode($dat['apellidos_cliente']); ?>">
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label>Telefono</label>
															<input class="form-control" type="text" disabled value="<?php echo $dat['telefono_cliente']; ?>">
														</div>
														<div class="col-md-9">
															<label>Correo Electronico</label>
															<input class="form-control" type="text" disabled value="<?php echo $dat['email_cliente']; ?>">
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
								<div id="au<?php echo $dat['id_automovil']; ?>" class="modal fade" role="dialog">
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
															<input class="form-control" type="text" disabled value="<?php echo utf8_decode($dat['modelo_automovil']); ?>">
														</div>
														<div class="col-md-6">
															<label>Kilometraje del automovil</label>
															<input class="form-control" type="text" disabled value="<?php echo utf8_decode($dat['km_automovil']); ?>">
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<label>Placas</label>
															<input class="form-control" type="text" disabled value="<?php echo $dat['placas_automovil']; ?>">
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
			echo "Post no recibio nada";
		}
	}
	else
	{
		print '<script type="text/javascript">
            	$(location).attr("href","index.php?p=login");
        	</script>';
	}
?>