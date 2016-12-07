<?php 
require_once 'celular.php';
require_once 'archivo.php';


switch ($_POST['queHago']) {
	case 'ALTA_CELULAR':

		if (!isset($_POST['celular']['foto'])) {
			echo "Falta Foto";
			return;
		}

		$aux = json_decode(json_encode($_POST['celular']));

		if (empty($aux->marca)) { echo("Falta Marca"); return; };
		if (empty($aux->modelo)) { echo("Falta Modelo"); return; };
		if (empty($aux->fechaDeFabricacion)) { echo("Falta Fecha"); return; };

		$obj= new Celular($aux->marca, $aux->modelo, $aux->fechaDeFabricacion, $aux->sistemaOperativo, $aux->sim, $aux->liberado, $aux->foto);

		

		if (!Celular::Guardar($obj)) {
			echo "ALTA ERROR";
			return;
		}

		echo "ALTA OK";
		break;
	
		case "MOSTRAR_GRILLA":

		$ArrayDeCelulares = Celular::TraerTodosLosCelulares();

		$grilla = '<table class="table">
					<thead style="background:rgb(14, 26, 112);color:#fff;">
						<tr>
							<th>MARCA</th>
							<th>MODELO</th>
							<th>FECHA DE FABRICACION</th>
							<th>SISTEMA OPERATIVO</th>
							<th>SIM</th>
							<th>LIBERADO</th>
							<th>FOTO</th>
							<th>ACCIÓN</th>							
						</tr> 
					</thead>';   	

		for ($i=0; $i < count($ArrayDeCelulares); $i++) { 
			$grilla .= "<tr>
							<td>".$ArrayDeCelulares[$i]->marca."</td>
							<td>".$ArrayDeCelulares[$i]->modelo."</td>
							<td>".$ArrayDeCelulares[$i]->fechaDeFabricacion."</td>
							<td>".$ArrayDeCelulares[$i]->sistemaOperativo."</td>
							<td>".$ArrayDeCelulares[$i]->sim."</td>
							<td>".$ArrayDeCelulares[$i]->liberado."</td>
							<td><img src='tmp/".$ArrayDeCelulares[$i]->foto."' width='100px' height='100px'/></td>
							<td><input  class='MiBotonUTN' type='button' value='Eliminar' class='MiBotonUTN' id='btnEliminar' onclick='BorrarCelular(".$i.")' />
								<input class='MiBotonUTN'  type='button' value='Modificar' class='MiBotonUTN' id='btnModificar' onclick='ModificarCelular()' /></td>
						</tr>";
		}
		
		$grilla .= '</table>';		
		
		echo $grilla;

		break;

		case "BORRAR_CELULAR":

			$id = $_POST['id'];

			if (!Celular::Eliminar($id)) {
				echo "ERROR ELIMINAR";
				return;
			}

			echo "ELIMINAR OK";
		break;

		case "SUBIR_FOTO":

			$res = Archivo::Subir();
			
			echo json_encode($res);

		break;

		case "BORRAR_FOTO":

		$pathFoto = isset($_POST['foto']) ? $_POST['foto'] : NULL;

		$res["Exito"] = Archivo::Borrar("./tmp/".$pathFoto);
		
		echo json_encode($res);

		break;

	default:
		echo ":(";
		break;
}

 ?>