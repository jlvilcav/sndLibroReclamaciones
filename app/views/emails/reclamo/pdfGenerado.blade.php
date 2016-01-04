<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reclamo Nº </title>
	<style type="text/css">
		body {
	  		font-family: "Arial", sans-serif;
	  		line-height: 140%;
	  		font-size: 12px;
		}
		h1{
			text-align: center;
		}
	</style>
</head>
<body>
	<h1>SUNEDU - LIBRO DE RECLAMACIONES</h1>
	<table width="100%" cellpadding="10" cellspacing="0" border="1">
		<tr>
			<td>LIBRO DE RECLAMACIONES</td>
			<td>Hoja de Reclamación</td>
		</tr>
		<tr>
			<td>Fecha: <strong>{{ $fecha }}</strong></td>
			<td>Nº <strong>{{ $nro_reclamo }}</strong></td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center">
				<strong>Superintendencia Nacional de Educación Superior Universitaria - SUNEDU</strong>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<strong>Identificación del usuario</strong>
			</td>
		</tr>
		<tr>
			<td colspan="2">Nombre o Razón Social: <strong>{{ $nombre }}</strong></td>
		</tr>
		<tr>
			<td colspan="2">Domicilio: <strong>{{ $domicilio }}</strong></td>
		</tr>
		<tr>
			<td>
				DNI/CE: <strong>{{ $num_doc}}</strong>
			</td>
			<td>
				Télefono / email: <strong>{{ $telf_email }}</strong>
			</td>
		</tr>
	</table>

	<br>
	<br>
	<p>
	<strong>Identificación de la Atención Brindada</strong>
	</p>
	<p>
		{{ $atencion_brindada }}
	</p>
</body>
</html>