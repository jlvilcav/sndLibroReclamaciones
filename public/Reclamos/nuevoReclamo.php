<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="shortcut icon" href="../images/sunedu-favicon.png">
	<link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">
	<link href="../bootstrap/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<link href="../bootstrap/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet" type="text/css">
	<link href="../bootstrap/plugins/select2/select2.min.css" rel="stylesheet" type="text/css">
	<link href="../bootstrap/dist/css/AdminLTE.css" rel="stylesheet" type="text/css">
	<link href="../bootstrap/dist/css/skins/skin-sunedu.css" rel="stylesheet" type="text/css">
	<link href="../bootstrap/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css">
	<link href="../bootstrap/plugins/morris/morris.css" rel="stylesheet" type="text/css">
	<link href="../bootstrap/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css">
	<link href="../bootstrap/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css">
	<link href="../bootstrap/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css">
	<link href="../bootstrap/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css">

	<script src="../bootstrap/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="../bootstrap/plugins/jQueryUI/jquery-ui.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		$.widget.bridge('uibutton', $.ui.button);
	</script>
	<script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../bootstrap/plugins/select2/select2.full.min.js" type="text/javascript"></script>
	<script src="../bootstrap/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
	<script src="../bootstrap/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
	<script src="../bootstrap/plugins/datatables/extensions/Responsive/js/dataTables.responsive.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="../bootstrap/plugins/morris/morris.min.js" type="text/javascript"></script>
	<script src="../bootstrap/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
	<script src="../bootstrap/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
	<script src="../bootstrap/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
	<script src="../bootstrap/plugins/knob/jquery.knob.js" type="text/javascript"></script>
	<script src="../bootstrap/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
	<script src="../bootstrap/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
	<script src="../bootstrap/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
	<script src="../bootstrap/plugins/daterangepicker/moment.js" type="text/javascript"></script>
	<script src="../bootstrap/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
	<script src="../bootstrap/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
	<script src="../bootstrap/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
	<script src="../bootstrap/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="../bootstrap/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
	<script src="../bootstrap/dist/js/app.js" type="text/javascript"></script>
	<script src="../bootstrap/dist/js/app.js" type="text/javascript"></script>
	<script src="../bootstrap/Scripts/reclamosLibro.js" type="text/javascript"></script>
	<script>
		var sunePath = 'http://localhost/';
	</script>
	<script src="../bootstrap/Scripts/Common.js" type="text/javascript"></script>
	<script src="../bootstrap/Scripts/licenciamiento.js" type="text/javascript"></script>
	<script>
		(function($) {
			$.fn.goTo = function() {
				$('html, body').animate({
					scrollTop: $(this).offset().top + 'px'
				}, 'fast');
				return this; // for chaining...
			}
		})(jQuery);
	</script>
	<script>
		$(document).ready(function(){
			$(document).ajaxStart(function(){
				//$('#layout_wrapper').addClass('disabled-content');
				$('#liLoading').show();
			});
			$(document).ajaxStop(function(){
				//$('#layout_wrapper').removeClass('disabled-content');
				$('#liLoading').hide();

			});
		});
	</script>
	<style>
		.disabled-content {
			z-index: 1000;
			background-color: lightgrey;
			opacity: 1;
			pointer-events: none;
		}
	</style>
	<style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style>

	<title>Libro de Reclamaciones</title>
</head>
<body>

<style>
	/* * { border:1px solid black; }*/
</style>

<section class="content-header">
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<h2>
				<img src="../images/sunedu-favicon.png" width="32" height="32"/> &nbsp;LIBRO DE RECLAMACIONES VIRTUAL SUNEDU
			</h2>
		</div>
	</div>
</section>
<!-- Modal para confirmar-->
<div class="modal fade bs-example-modal-sm" id="denunciaConfirm" tabindex="-1" data-backdrop="static" role="dialog"
	 aria-labelledby="denunciaConfirmLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header text-center">
				<h4 class="modal-title" id="denunciaConfirmLabel">
					Registro de Denuncias
				</h4>
			</div>
			<div class="modal-body" id="denunciaConfirm">
				<p style="">
					Su denuncia ha sido recibida satisfactoriamente, una copia se remitió a su correo
					electrónico.
				</p>
				<br/>
				Nro. Denuncia : 10242015<br/>
				Fecha : 19/08/2015 10:21<br/>
				Denunciante : Andres Alvites Valladares<br/>
				<br/>
			</div>
			<div class="modal-footer">
				<button type="button" id="btndenunciaConfirm" data-dismiss="modal" class="btn btn-primary" onclick="guardarDenuncia()" >Aceptar</button>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Custom Tabs -->
			<div class="nav-tabs-custom" id="tabsDenuncia">
				<ul class="hidden-xs hidden-sm visible-md visible-lg nav nav-tabs">
					<li class="active" id="tab1" name="tab1"><a href="#tab_1" data-toggle="tab">Datos Generales</a></li>
					<li class=""><a href="#tab_2" data-toggle="tab">Hoja de Reclamación Virtual</a></li>
				</ul>
				<div class="tab-content col-sm-12 col-md-12">
					<div class="tab-pane fade in active" id="tab_1">
						<div class="row">
							<div class="col-sm-12 col-md-12">
								<button class="btn btn-info pull-right" type="button" onclick="denunciaOpenTab('tab_2')">
									Siguiente &nbsp;
									<i class="fa  fa-arrow-right"></i>
								</button>
							</div>
						</div>
						<div class="visible-xs visible-sm hidden-md hidden-lg row">
							<div class="col-sm-12 text-center">
								<h3>Datos del Denunciante</h3>
							</div>
						</div>
						<input type="text" style="display: none;"
							   class="form-control"
							   id="hidIdxDenunciaWeb"
							   maxlength="8">


						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingOne">
									<h4 class="panel-title">
										<a class="collapsed" role="button"  data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
											Si es Persona Natural
										</a>
									</h4>
								</div>
								<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
									<div class="panel-body">
										<div class="row">
											<div class="form-horizontal col-sm-12 col-md-6">
												<div class="form-group col-sm-12 col-md-12">
													<label class="col-sm-12 col-md-4">Tipo de Documento</label>
													<div class="col-sm-12 col-md-8">
														<select class="form-control" id="cboIdxTipoDocuIdentidad">
															<?php //echo $this->selectTipodocuIdentidad; ?>
														</select>
													</div>
												</div>
												<div class="form-group col-sm-12 col-md-12">
													<label class="col-sm-12 col-md-4">Numero de Documento</label>
													<div class="col-sm-12 col-md-8">
														<div class="input-group">
															<input type="text"
																   class="form-control"
																   id="txtCodNumeDocumento"
																   maxlength="8">
															<input type="text" style="display: none;"
																   class="form-control"
																   id="hidIdxDenunciante"
																   maxlength="8">
															<span class="input-group-addon" style="cursor:pointer;" onclick="buscaPersonaDNI()"><i class="fa fa-search"></i></span>
														</div>
													</div>
												</div>
												<div class="form-group col-sm-12 col-md-12">
													<label class="col-sm-12 col-md-4">Nombre</label>
													<div class="col-sm-12 col-md-8">
														<input type="text"
															   class="form-control text-uppercase"
															   id="txtNatuNombre"
															   placeholder="">
													</div>
												</div>
												<div class="form-group col-sm-12 col-md-12">
													<label class="col-sm-12 col-md-4">Apellido Paterno</label>
													<div class="col-sm-12 col-md-8">
														<input type="text"
															   class="form-control text-uppercase"
															   id="txtNatuPaterno"
															   placeholder="">
													</div>
												</div>
												<div class="form-group col-sm-12 col-md-12">
													<label class="col-sm-12 col-md-4">Apellido Materno</label>
													<div class="col-sm-12 col-md-8">
														<input type="text"
															   class="form-control text-uppercase"
															   id="txtNatuMaterno"
															   placeholder="">
													</div>
												</div>
											</div>

											<div class="form-horizontal col-sm-12 col-md-6">
												<div class="form-group col-sm-12 col-md-12">
													<label class="col-sm-12 col-md-5">E-mail</label>
													<div class="col-sm-12 col-md-7">
														<input type="text"
															   class="form-control text-uppercase"
															   id="txtNatuEmail"
															   placeholder="">
													</div>
												</div>
												<div class="form-group col-sm-12 col-md-12">
													<label class="col-sm-12 col-md-5">Telefono Fijo</label>
													<div class="col-sm-12 col-md-7">
														<input type="text"
															   class="form-control text-uppercase"
															   id="txtNatuFijo"
															   placeholder="">
													</div>
												</div>
												<div class="form-group col-sm-12 col-md-12">
													<label class="col-sm-12 col-md-5">Telefono Celular</label>
													<div class="col-sm-12 col-md-7">
														<input type="text"
															   class="form-control text-uppercase"
															   id="txtNatuMovil"
															   placeholder="">
													</div>
												</div>
											</div>

											<div class="form-horizontal col-sm-12 col-md-12">
												<div class="form-group col-sm-12 col-md-12">
													<label class="col-sm-12 col-md-3">Domicilio Real</label>
													<div class="col-sm-12 col-md-3">
														<select class="form-control" id="cboDepPNR" onchange="getUbigeo('DepPNR','ProPNR', 'DisPNR')" >
															<?php //echo $this->selectUbigeoDep; ?>
														</select>
													</div>
													<div class="col-sm-12 col-md-3">
														<select class="form-control" id="cboProPNR" onchange="getUbigeo('ProPNR','DisPNR','')">
															<?php //echo $this->selectUbigeoPro; ?>
														</select>
													</div>
													<div class="col-sm-12 col-md-3">
														<select class="form-control" id="cboDisPNR">
															<?php //echo $this->selectUbigeoDis; ?>
														</select>
													</div>
												</div>
												<div class="form-group col-sm-12 col-md-12">
													<div class="col-sm-12 col-md-12">
														<input type="text"
															   class="form-control text-uppercase"
															   id="txtNatuReal"
															   placeholder="">
													</div>
												</div>


												<div class="form-group col-sm-12 col-md-12" hidden>
													<label class="col-sm-12 col-md-3">Domicilio donde recibira las notificaciones</label>

													<div class="col-sm-12 col-md-3">
														<select class="form-control" id="cboDepPNN" onchange="getUbigeo('DepPNN','ProPNN', 'DisPNN')" >
															<?php //echo $this->selectUbigeoDep; ?>
														</select>
													</div>
													<div class="col-sm-12 col-md-3">
														<select class="form-control" id="cboProPNN" onchange="getUbigeo('ProPNN','DisPNN','')">
															<?php //echo $this->selectUbigeoPro; ?>
														</select>
													</div>
													<div class="col-sm-12 col-md-3">
														<select class="form-control" id="cboDisPNN">
															<?php //echo $this->selectUbigeoDis; ?>
														</select>
													</div>
												</div>
												<div class="form-group col-sm-12 col-md-12" hidden>
													<div class="col-sm-12 col-md-12">
														<input type="text"
															   class="form-control text-uppercase"
															   id="txtNatuNotificacion"
															   placeholder="">
													</div>
												</div>


											</div>
										</div>

									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingTwo">
									<h4 class="panel-title">
										<a class="collapsed" role="button"  data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
											Si es Persona Juridica
										</a>
									</h4>
								</div>
								<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
									<div class="panel-body">
										<div class="row">
											<div class="form-horizontal col-sm-12 col-md-6">
												<div class="form-group col-sm-12 col-md-12">
													<label class="col-sm-12 col-md-4">N&uacute;mero RUC</label>
													<div class="col-sm-12 col-md-8">

														<div class="input-group">
															<input type="text"
																   class="form-control text-uppercase"
																   id="txtJuriRuc"
																   maxlength="11">
															<span class="input-group-addon" style="cursor:pointer;" onclick="buscaPersonaRUC()"><i class="fa fa-search"></i></span>
														</div>
													</div>
												</div>
												<div class="form-group col-sm-12 col-md-12">
													<label class="col-sm-12 col-md-4">Denominaci&oacute;n o raz&oacute;n social</label>
													<div class="col-sm-12 col-md-8">
														<input type="text"
															   class="form-control text-uppercase"
															   id="txtJuriNombre"
															   placeholder="">
													</div>
												</div>
												<div class="form-group col-sm-12 col-md-12" hidden>
													<label class="col-sm-12 col-md-4">Partida electronica donde se encuentra registrado en Sunarp</label>
													<div class="col-sm-12 col-md-8">
														<input type="text"
															   class="form-control text-uppercase"
															   id="txtDesPartSunarp"
															   placeholder="">
													</div>
												</div>


											</div>
											<div class="form-horizontal col-sm-12 col-md-6">
												<div class="form-group col-sm-12 col-md-12" hidden>
													<label class="col-sm-12 col-md-4">Nombre y apellidos de apoderado o representante</label>
													<div class="col-sm-12 col-md-8">
														<input type="text"
															   class="form-control text-uppercase"
															   id="txtJuriApoderado"
															   placeholder="">
													</div>
												</div>
												<div class="form-group col-sm-12 col-md-12">
													<label class="col-sm-12 col-md-4">E-mail</label>
													<div class="col-sm-12 col-md-8">
														<input type="text"
															   class="form-control text-uppercase"
															   id="txtJuriEmail"
															   placeholder="">
													</div>
												</div>
												<div class="form-group col-sm-12 col-md-12">
													<label class="col-sm-12 col-md-4">Tel&eacute;fono</label>
													<div class="col-sm-12 col-md-8">
														<input type="text"
															   class="form-control text-uppercase"
															   id="txtJuriTelefono"
															   placeholder="">
													</div>
												</div>
											</div>
											<div class="form-horizontal col-sm-12 col-md-12">
												<div class="form-group col-sm-12 col-md-12">
													<label class="col-sm-12 col-md-3">Domicilio Real</label>
													<div class="col-sm-12 col-md-3">
														<select class="form-control" id="cboDepPJR" onchange="getUbigeo('DepPJR','ProPJR', 'DisPJR')" >
															<?php //echo $this->selectUbigeoDep; ?>
														</select>
													</div>
													<div class="col-sm-12 col-md-3">
														<select class="form-control" id="cboProPJR" onchange="getUbigeo('ProPJR','DisPJR','')">
															<?php //echo $this->selectUbigeoPro; ?>
														</select>
													</div>
													<div class="col-sm-12 col-md-3">
														<select class="form-control" id="cboDisPJR">
															<?php //echo $this->selectUbigeoDis; ?>
														</select>
													</div>
												</div>
												<div class="form-group col-sm-12 col-md-12">
													<div class="col-sm-12 col-md-12">
														<input type="text"
															   class="form-control text-uppercase"
															   id="txtJuriReal"
															   placeholder="">
													</div>
												</div>
												<div class="form-group col-sm-12 col-md-12" hidden>
													<label class="col-sm-12 col-md-3">Domicilio donde recibira las notificaciones</label>
													<div class="col-sm-12 col-md-3">
														<select class="form-control" id="cboDepPJN" onchange="getUbigeo('DepPJN','ProPJN', 'DisPJN')" >
															<?php //echo $this->selectUbigeoDep; ?>
														</select>
													</div>
													<div class="col-sm-12 col-md-3">
														<select class="form-control" id="cboProPJN" onchange="getUbigeo('ProPJN','DisPJN','')">
															<?php //echo $this->selectUbigeoPro; ?>
														</select>
													</div>
													<div class="col-sm-12 col-md-3">
														<select class="form-control" id="cboDisPJN">
															<?php //echo $this->selectUbigeoDis; ?>
														</select>
													</div>
												</div>
												<div class="form-group col-sm-12 col-md-12" hidden>
													<div class="col-sm-12 col-md-12">
														<input type="text"
															   class="form-control text-uppercase"
															   id="txtJuriNotificacion"
															   placeholder="">
													</div>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>

					</div><!-- /.tab-pane -->




					<div class="tab-pane fade" id="tab_2">

						<div class="row">
							<div class="col-sm-12 col-md-12">
								<button class="btn btn-success pull-right" style="margin-left:5px;" type="button" onclick="guardarDenuncia()" >
									Finalizar &nbsp;
									<i class="fa fa-check"></i>
								</button>
								<button class="btn btn-info pull-right" style="margin-left:5px;" type="button"  onclick="denunciaOpenTab('tab_1')">
								<i class="fa   fa-arrow-left"></i> &nbsp;
								Anterior
								</button>
							</div>
						</div>
						<div class="visible-xs visible-sm hidden-md hidden-lg row">
							<div class="col-sm-12 text-center">
								<h3>Datos de la Denuncia</h3>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-12">
								<p style="text-decoration:underline;">Identificación del usuario </p>
							</div>
						</div>
						<div class="row">
							<div class="form-horizontal col-sm-12 col-md-12">
								<div class="form-group col-sm-12 col-md-12">
									<label class="col-sm-12 col-md-12">Nombre</label>
									<div class="col-sm-12 col-md-12" >

										<input type="text"
											   id="txtNomInstDenunciada"
											   class="form-control text-uppercase"
											   placeholder="">
										<select class="form-control" id="cboUniversidad" onchange="otraUni()" style="visibility: hidden">
											<option value="0" >Otra entidad</option>
											<?php //echo $this->selectUniversidad; ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-horizontal col-sm-12 col-md-12">
								<div class="form-group col-sm-12 col-md-6">
									<label class="col-sm-12 col-md-3">DNI/CE/RUC</label>
									<div class="col-sm-12 col-md-9" >

										<input type="text"
											   id="txtRucDNICE"
											   class="form-control text-uppercase"
											   placeholder="">
									</div>
									<div class="col-sm-12 col-md-9" style="visibility: hidden">

										<input type="text"
											   id="txtNomReprInstDenunciada"
											   class="form-control text-uppercase"
											   placeholder="">
									</div>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="col-sm-12 col-md-3">Domicilio</label>
									<div class="col-sm-12 col-md-9">
										<input type="text"
											   id="txtTxtDomiInstDenunciada"
											   class="form-control text-uppercase"
											   placeholder="">
									</div>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="col-sm-12 col-md-3">Teléfono/ e-mail:</label>
									<div class="col-sm-12 col-md-9">
										<input type="text"
											   id="txtTelefonoEmail"
											   class="form-control text-uppercase"
											   placeholder="">
									</div>
								</div>
							</div>
						</div>
						<div class="row" style="visibility: hidden">
							<div class="col-sm-12 col-md-12">
								<p style="text-decoration:underline;">
									Identificación de la Atención Brindada
								</p>
							</div>
						</div>
						<div class="row" style="visibility: hidden">
							<div class="form-horizontal col-sm-12 col-md-12">
								<div class="form-group col-sm-12 col-md-2">
									<div class="col-sm-12 col-md-12">
										<select class="form-control"  id="cbxBitOtraInstancia" onchange="otraInstancia()">
											<option value="1">SI</option>
											<option value="0">NO</option>
										</select>
									</div>
								</div>
								<div class="form-group col-sm-12 col-md-10" id="divOtraInstancia">
									<?php //echo $this->selectTmDetalle; ?>
									<div class="radio col-sm-12 col-md-12">
										<input class="form-control text-uppercase" type="text" id="txtDesOtraInstancia"/>
									</div>
								</div>
							</div>
						</div >
						<div class="row" style="visibility: hidden">
							<div class="col-sm-12 col-md-12">
								<p style="text-decoration:underline;">
									DETALLES SOBRE LA PRESUNTA INFRACCI&Oacute;N
								</p>
							</div>
						</div>
						<div class="row" style="visibility: hidden">
							<div class="form-horizontal col-sm-12 col-md-12">
								<div class="col-sm-12 col-md-2">
									<p style="text-decoration:underline;">
										Infracci&oacute;n sobre:
									</p>
								</div>
								<div class="col-sm-12 col-md-10">
									<?php //echo $this->selectTmDetalle2; ?>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12 col-md-12">
								<p style="text-decoration:underline;">
									Identificación de la Atención Brindada:
								</p>
							</div>
						</div>
						<div class="row">
							<div class="form-horizontal col-sm-12 col-md-12">
								<div class="form-group col-sm-12 col-md-12">
									<div class="col-sm-12 col-md-12">
										<textarea class="form-control noresize" rows="4" id="txtTxtDescHechos" maxlength="500"></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-12">
								<p style="text-decoration:underline;">
									Acciones adoptadas por la entidad:
								</p>
							</div>
						</div>
						<div class="row">
							<div class="form-horizontal col-sm-12 col-md-12">
								<div class="form-group col-sm-12 col-md-12">
									<div class="col-sm-12 col-md-12">
										<textarea class="form-control noresize" rows="4" id="txtTxtPoteAfecHechos" maxlength="500"></textarea>
									</div>
								</div>
							</div>
						</div>

						<div class="row" style="visibility: hidden">
							<div class="col-sm-12 col-md-12">
								<p style="text-decoration:underline;">
									DOCUMENTOS ADJUNTOS
								</p>
							</div>
						</div>

						<div class="row" style="visibility: hidden">
							<div class="col-sm-12 col-md-12">
								<p>
									Constituyen documentos sustentatorios, entre otros los impresos, fotocopias, facsimil o fax, planos, cuadros,
									dibujos, fotografías, reproducciones de audio o video, y en general cualquier medio que recojan, contengan o
									representen algun hecho, o una actividad humana o su resultado
								</p>
							</div>


						</div>

						<div class="row" style="visibility: hidden">
							<div class="form-horizontal col-sm-12 col-md-12">
								<div class="form-group col-sm-12 col-md-12">
									<label class="col-sm-12 col-md-4">Documento de identidad escaneado (obligatorio)</label>
									<div class="input-group col-sm-12 col-md-4">
		                                <span class="input-group-btn">
		                                    <span class="btn btn-default btn-file">
		                                        Examinar <input class="docFile" id="docfile0" type="file" name="c_lob_uload[]">
		                                    </span>
		                                </span>
										<input type="text" class="form-control" readonly>
		                                <span class="input-group-btn">
		                                    <button type="button" class="btn btn-default"><i class="fa" title="Obligatorio">&nbsp;&nbsp;&nbsp;</i></button>
		                                </span>
									</div>
								</div>
							</div>
						</div>
						<div class="row" style="visibility: hidden">
							<div class="box-body" id="divAdjuntosContainer">
								<div class="col-md-12">
									<button onclick="appendInputFileAdj()" id="btnAppendFileSelector" type="button" class="btn btn-default">
										<i class="fa fa-plus"></i>
										Agregar
									</button>
									<br/>
									* Puede adjuntar como m&aacute;ximo 10 archivos.<br/>
									* Tama&ntilde;o maximo por archivo 10 MB<br/>
								</div>

								<!-- Input Files -->
								<div class="col-md-12" id="ndocfile1_div">
									<div class="col-sm-12 col-md-12" style="margin-top:5px;">

										<label class="col-sm-12 col-md-2">Descripci&oacute;n :</label>

										<div class="col-sm-12 col-md-4">
											<input class="form-control text-uppercase" type="text" maxlength="80" id="docfile1_des" />
										</div>
										<div class="input-group col-sm-12 col-md-6">
											<span class="input-group-btn">
												<span class="btn btn-default btn-file">
													Examinar <input class="docFile" id="docfile1" type="file" name="c_lob_uload[]">
												</span>
											</span>
											<input type="text" class="form-control" readonly>
											<span class="input-group-btn">
			'									<button type="button" onclick="removeInputFileAdj(1)" class="btn btn-default">
													<i class="fa fa-trash" title="Eliminar"></i>
												</button>
			'								</span>
										</div>

									</div>
								</div>
							</div><!-- /.box-body -->
						</div>


					</div><!-- /.tab-pane -->
				</div><!-- /.tab-content -->
			</div><!-- nav-tabs-custom -->
		</div><!-- /.col -->
	</div> <!-- /.row -->
</section>

</body>
</html>
