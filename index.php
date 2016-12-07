<html>
<head>
	<title></title>
</head>
<script src="jquery.js"></script>
<script type="text/javascript" src="FuncionesParcial.js"></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="estilo.css">

<body>
	<div class="container">
	<div class="CajaInicio" style="width:1100px">
			
		<div id="divFrm" style="height:450px;overflow:auto;margin-top:20px">
			<input type="text" name="marca" id="marca" placeholder="Ingrese Marca" />
			<input type="text" name="modelo" id="modelo" placeholder="Ingrese Modelo" />
			<input type="text" name="fechaDeFabricacion" id="fechaDeFabricacion" placeholder="Ingrese Fecha de Fabricacion." />
			<select id="sistemaOperativo">
				 <option value="android">Android</option>
				 <option value="ios">IOS</option>
				 <option value="windows">Windows</option>
			</select>
			SIM: 	<input type="radio" name="sim" id="sim" value="1" checked>1
					<input type="radio" name="sim" id="sim2" value="2">2

			Liberado: <input type="checkbox" name="liberado" id="liberado" value="1">

			<input type="file" name="archivo" id="archivo" onchange="SubirFoto()" />



			<input type="button" name="button" id="button" onclick="AltaCelular()" value="Alta Celular" class='MiBotonUTN'>
		</div>

		<div id="divFoto" style="height:350px;overflow:auto"></div>

		<input type="button" onclick="MostrarGrilla()" value="Mostrar Grilla" class='MiBotonUTN'>
		<div id="divGrilla" ></div>
	
	</div>
</div>
</body>
</html>