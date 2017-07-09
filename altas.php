<?php
	if (isset($_SESSION["user"]))
	{
	require_once("data/maria.php");
	$conn = new Conexion("seat_citas");
	$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = $conn->prepare("select * from tecnicos where ver_tecnico=1");
	$sql2 = $conn->prepare("select * from asesores where ver_asesor=1");
	$sql3 = $conn->prepare("select * from servicios where ver_servicio=1");
	$sql->execute();
	$sql2->execute();
	$sql3->execute();
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
			<div class="jumbotron">
				<div class="row">
					<div class="col-md-12">
						<h1>Panel de Administración</h1>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<h1>Técnicos</h1>
					<div class="btn-group-vertical" role="group">
						<button type="button" id="adTecnico" class="btn btn-default btn-lg" data-toggle="modal" data-target="#agrega">Agregar</button>
					</div>
				</div>
				<div class="col-md-7">
					<span id="resultMod"></span>
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<td>Id</td>
									<td>Tecnico</td>
									<td>Tipo</td>
									<td>Acción</td>
								</tr>
							</thead>
							<tbody>
							<?php while($dato = $sql->fetch()){ ?>
								<tr>
									<td><?php echo $dato[0]; ?></td>
									<td><?php echo $dato[1]; ?></td>
									<td><?php echo $dato[2]; ?></td>
									<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#tec<?php echo $dato[0]; ?>">Editar</button></td>
								</tr>
								<div id="tec<?php echo $dato[0]; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												Modificar Técnico
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											</div>
											<form name="cambiarTecnico" method="post" action="index.php?p=modTecnico">
												<div class="modal-body">
													<input type="hidden" name="idTecnico" id="idTecnico" value="<?php echo $dato[0]; ?>">
													<div class="form-group">
														<label role="nombre">Nombre</label>
														<input type="text" id="nombreTecnico" name="nombreTecnico" class="form-control" value="<?php echo $dato[1]; ?>">
													</div>
													<div class="form-group">
														<label role="tipo">Tipo</label>
														<input type="text" id="tipoTecnico" name="tipoTecnico" class="form-control" value="<?php echo $dato[2]; ?>">
													</div>
													<div class="form-group">
														<label role="obs">Observaciones</label>
														<input type="text" id="obsTecnico" name="obsTecnico" class="form-control" value="<?php echo $dato[3]; ?>">
													</div>
													<div class="from-group">
														<div class="checkbox">
															<label>
																<input type="checkbox" id="foco" name="foco">
																Eliminar Tecnico
															</label>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
													<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-save"></span> Guardar</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div> <!-- /row -->
			<div class="row">
				<div class="col-md-2">
					<h1>Asesores</h1>
					<div class="btn-group-vertical" role="group">
						<button type="button" id="adAsesor" class="btn btn-default btn-lg" data-toggle="modal" data-target="#agrega2">Agregar</button>
					</div>
				</div>
				<div class="col-md-7">
					<span id="resultMod"></span>
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<td>Id</td>
									<td>Asesor</td>
									<td>Observaciones</td>
									<td>Acción</td>
								</tr>
							</thead>
							<tbody>
							<?php while($datoA = $sql2->fetch()){ ?>
								<tr>
									<td><?php echo $datoA[0]; ?></td>
									<td><?php echo $datoA[1]; ?></td>
									<td><?php echo $datoA[2]; ?></td>
									<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#as<?php echo $datoA[0]; ?>">Editar</button></td>
								</tr>
								<div id="as<?php echo $datoA[0]; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												Modificar Asesor
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											</div>
											<form name="cambiarAsesor" method="post" action="index.php?p=modAsesor">
												<div class="modal-body">
													<input type="hidden" name="idAsesor" id="idAsesor" value="<?php echo $datoA[0]; ?>">
													<div class="form-group">
														<label role="nombre">Nombre</label>
														<input type="text" id="nombreAsesor" name="nombreAsesor" class="form-control" value="<?php echo $datoA[1]; ?>">
													</div>
													<div class="form-group">
														<label role="Observaciones">Observaciones</label>
														<input type="text" id="obsAsesor" name="obsAsesor" class="form-control" value="<?php echo $datoA[2]; ?>">
													</div>
													<div class="from-group">
														<div class="checkbox">
															<label>
																<input type="checkbox" id="foco2" name="foco2">
																Eliminar Asesor
															</label>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
													<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-save"></span> Guardar</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div> <!-- /row -->
			<div class="row">
				<div class="col-md-2">
					<h1>Servicios</h1>
					<div class="btn-group-vertical" role="group">
						<button type="button" id="adServicio" class="btn btn-default btn-lg" data-toggle="modal" data-target="#agrega3">Agregar</button>
					</div>
				</div>
				<div class="col-md-7">
					<span id="resultMod"></span>
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<td>Id</td>
									<td>Servicio</td>
									<td>Km Servicio</td>
									<td>Costo</td>
									<td>UT Necesarios</td>
									<td>Acción</td>
								</tr>
							</thead>
							<tbody>
							<?php while($datoS = $sql3->fetch()){ ?>
								<tr>
									<td><?php echo $datoS[0]; ?></td>
									<td><?php echo $datoS[1]; ?></td>
									<td><?php echo $datoS[2]; ?></td>
									<td><?php echo $datoS[3]; ?></td>
									<td><?php echo $datoS[4]; ?></td>
									<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#serv<?php echo $datoS[0]; ?>">Editar</button></td>
								</tr>
								<div id="serv<?php echo $datoS[0]; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												Modificar Servicio
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											</div>
											<form name="cambiarServicio" method="post" action="index.php?p=modServicio">
												<div class="modal-body">
													<input type="hidden" name="idServicio" id="idServicio" value="<?php echo $datoS[0]; ?>">
													<div class="form-group">
														<label role="nombre">Nombre</label>
														<input type="text" id="nombreServicio" name="nombreServicio" class="form-control" value="<?php echo $datoS[1]; ?>">
													</div>
													<div class="form-group">
														<label role="kilometros">Km Servicio</label>
														<input type="text" id="kmServicio" name="kmServicio" class="form-control" value="<?php echo $datoS[2]; ?>">
													</div>
													<div class="form-group">
														<label role="costo">Costo</label>
														<input type="text" id="costoServicio" name="costoServicio" class="form-control" value="<?php echo $datoS[3]; ?>">
													</div>
													<div class="form-group">
														<label role="uts_necesarios">UT Necesarios</label>
														<input type="text" id="utsServicio" name="utsServicio" class="form-control" value="<?php echo $datoS[4]; ?>">
													</div>
													<div class="from-group">
														<div class="checkbox">
															<label>
																<input type="checkbox" id="foco3" name="foco3">
																Eliminar Servicio
															</label>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
													<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-save"></span> Guardar</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div> <!-- /row -->
		</div>
	</div>
</div>
<!-- ******************************************************Zona de modals************************************************************************* -->
<div id="agrega" class="modal fade" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				Agregar Técnico
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form name="agregarTecnico" method="post" action="index.php?p=altaTecnico">
			<div class="modal-body">
				<div class="form-group">
					<label role="nombre">Nombre</label>
					<input type="text" id="nombreT" name="nombreT" class="form-control">
				</div>
				<div class="form-group">
					<label role="tipo">Tipo</label>
					<input type="text" id="tipoT" name="tipoT" class="form-control">
				</div>
				<div class="form-group">
					<label role="obs">Observaciones</label>
					<input type="text" id="obsT" name="obsT" class="form-control">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button id="saveTecnico" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-save"></span> Guardar</button>
			</div>
			</form>
		</div>
	</div>
</div>
<div id="agrega2" class="modal fade" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				Agregar Asesor
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form name="agregarAsesor" method="post" action="index.php?p=altaAsesor">
			<div class="modal-body">
				<div class="form-group">
					<label role="nombre">Nombre</label>
					<input type="text" id="nombreA" name="nombreA" class="form-control">
				</div>
				<div class="form-group">
					<label role="tipo">Observaciones</label>
					<input type="text" id="obsA" name="obsA" class="form-control">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button id="saveAsesor" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-save"></span> Guardar</button>
			</div>
			</form>
		</div>
	</div>
</div>
<div id="agrega3" class="modal fade" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				Agregar Servicio
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form name="agregarServicio" method="post" action="index.php?p=altaServicio">
			<div class="modal-body">
				<div class="form-group">
					<label role="servicio">Nombre</label>
					<input type="text" id="nombreS" name="nombreS" class="form-control">
				</div>
				<div class="form-group">
					<label role="kilometros">Km Servicio</label>
					<input type="text" id="kmS" name="kmS" class="form-control">
				</div>
				<div class="form-group">
					<label role="coste">Costo</label>
					<input type="text" id="costeS" name="costeS" class="form-control">
				</div>
				<div class="form-group">
					<label role="uts_necesarios">UT necesarios</label>
					<input type="text" id="utS" name="utS" class="form-control">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button id="saveServicio" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-save"></span> Guardar</button>
			</div>
			</form>
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