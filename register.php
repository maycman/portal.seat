<?php
	$query = $conn->prepare("select id_asesor, nombre_asesor from asesores where ver_asesor=1");
	$query2 = $conn->prepare("select id_tecnico, nombre_tecnico from tecnicos where ver_tecnico=1");
	$query3 = $conn->prepare("select id_servicio, nombre_servicio from servicios where ver_servicio=1");
	$query->execute();
	$query2->execute();
	$query3->execute();
?>
<div id="nCita" class="modal fade bs-example-modal-lg" role="dialog">
	<div class="modal-dialog modal-barra modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				Registro de Cliente
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form name="registroClientes" method="post" autocomplete="off" action="index.php?p=nuevaCita">
				<div class="modal-body body-barra">
					<div class="container-fluid">
						<div class="form-group">
							<label role="nombre">Nombre</label>
							<input type="text" id="nombreCl" name="nombreCl" class="form-control" required autofocus>
						</div>
						<div class="form-group">
							<label role="apellidos">Apellidos</label>
							<input type="text" id="apellidoCl" name="apellidoCl" class="form-control" required>
						</div>
						<div class="form-group">
							<label role="telefono">Telefono</label>
							<input type="text" id="telefonoCl" name="telefonoCl" class="form-control" maxlength="10"><!-- estos datos son para el el formato del telefono onkeyup="format(this)" onchange="format(this)"-->
						</div>
						<div class="form-group">
							<label role="email">Correo Eléctronico</label>
							<input type="text" id="emailCl" name="emailCl" class="form-control">
						</div>
						<div class="form-group">
							<label role="automovil">Modelo del Automovil</label>
							<input type="text" id="autoCl" name="autoCl" class="form-control" required>
						</div>
						<div class="form-group">
							<label role="kilometraje">Kilometros Recorridos</label>
							<input type="text" id="kmCl" name="kmCl" class="form-control" required>
						</div>
						<div class="form-group">
							<label role="color">Placas del Automovil</label>
							<input type="text" id="colorCl" name="colorCl" class="form-control" required uppercase>
						</div>
						<div class="form-group">
							<label role="asesor">Asesores Disponibles</label>
							<select id="asesorCl" name="asesorCl" class="form-control">
								<?php while ($dato = $query->fetch()){ ?>
								<option value="<?php echo $dato['id_asesor']; ?>"><?php echo $dato['nombre_asesor']; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label role="tecnico">Tecnicos Disponibles</label>
							<select id="tecnicoCl" name="tecnicoCl" class="form-control">
								<?php while ($dato2 = $query2->fetch()){ ?>
								<option value="<?php echo $dato2['id_tecnico']; ?>"><?php echo $dato2['nombre_tecnico']; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label role="servicio">Servicio</label>
							<select id="servicioCl" name="servicioCl" class="form-control">
								<?php while ($dato3 = $query3->fetch()){ ?>
								<option value="<?php echo $dato3['id_servicio']; ?>"><?php echo $dato3['nombre_servicio']; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label role="fecha">Fecha</label>
									<div class='input-group date' id='dates'>
										<input type='text' id="fecha" name="fecha" class="form-control" />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label role="Hora">Hora</label>
									<select class="form-control" id="hora" name="hora">
										<option>9:00 AM</option>
										<option>9:30 AM</option>
										<option>10:00 AM</option>
										<option>10:30 AM</option>
										<option>11:00 AM</option>
										<option>11:30 AM</option>
										<option>12:00 PM</option>
										<option>12:30 PM</option>
										<option>01:00 PM</option>
										<option>01:30 PM</option>
										<option>02:00 PM</option>
										<option>02:30 PM</option>
										<option>03:00 PM</option>
										<option>03:30 PM</option>
										<option>04:00 PM</option>
										<option>04:30 PM</option>
									</select>
									<!--div class='input-group date' id='time'>
										<input type='text' id="hora" name="hora" class="form-control" />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-time"></span>
										</span>
									</div-->
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button id="saveCita" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-save"></span> Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>