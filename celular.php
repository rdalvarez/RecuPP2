<?php 

class Celular
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	public $marca;
 	public $modelo;
  	public $fechaDeFabricacion;
  	public $sistemaOperativo;
  	public $sim;
  	public $liberado;
  	public $foto;

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//

//--CONSTRUCTOR
	public function __construct($marca=NULL, $modelo=NULL, $fechaDeFabricacion=NULL, $sistemaOperativo=NULL, $sim=NULL, $liberado=NULL, $foto="SIN FOTO") //
	{
		
		if($marca !== NULL && $modelo !== NULL && $fechaDeFabricacion!==NULL){
			$this->marca = $marca;
			$this->modelo = $modelo;
			$this->fechaDeFabricacion = $fechaDeFabricacion;
			$this->sistemaOperativo = $sistemaOperativo;
			$this->sim = $sim;
			$this->liberado = $liberado;
			$this->foto = $foto;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->marca." - ".$this->modelo." - ".$this->fechaDeFabricacion." - ".$this->sistemaOperativo." - ".$this->sim." - ".$this->liberado." - ".$this->foto."\r\n"; //
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS DE CLASE
	public static function Guardar($obj)
	{
		$resultado = FALSE;
		
		//ABRO EL ARCHIVO
		$ar = fopen("celular.txt", "a");
		
		//ESCRIBO EN EL ARCHIVO
		$cant = fwrite($ar, $obj->ToString());
		
		if($cant > 0)
		{
			$resultado = TRUE;			
		}
		//CIERRO EL ARCHIVO
		fclose($ar);
		
		return $resultado;
	}
	public static function TraerTodosLosCelulares()
	{

		$ListaDeCelularesLeidos = array();

		//leo todos los productos del archivo
		$archivo=fopen("celular.txt", "r");
		
		while(!feof($archivo))
		{
			$archAux = fgets($archivo);
			$celular = explode(" - ", $archAux);
			//http://www.w3schools.com/php/func_string_explode.asp
			$celular[0] = trim($celular[0]);
			if($celular[0] != ""){
				$ListaDeCelularesLeidos[] = new Celular($celular[0], $celular[1],$celular[2],$celular[3],$celular[4], $celular[5],$celular[6]);
			}
		}
		fclose($archivo);
		
		return $ListaDeCelularesLeidos;
		
	}
	public static function Modificar($obj)
	{
		$resultado = TRUE;
		
		$ListaDeMascotasLeidos = Mascota::TraerTodosLasMascotas();
		$ListaDeMascotas = array();
		$imagenParaBorrar = NULL;
		
		for($i=0; $i<count($ListaDeMascotasLeidos); $i++){
			if($ListaDeMascotasLeidos[$i]->codBarra == $obj->codBarra){//encontre el modificado, lo excluyo
				$imagenParaBorrar = trim($ListaDeMascotasLeidos[$i]->pathFoto);
				continue;
			}
			$ListaDeMascotas[$i] = $ListaDeMascotasLeidos[$i];
		}

		array_push($ListaDeMascotas, $obj);//agrego el producto modificado
		
		//BORRO LA IMAGEN ANTERIOR
		unlink("DB/".$imagenParaBorrar);
		
		//ABRO EL ARCHIVO
		$ar = fopen("DB/mascotas.txt", "w");
		
		//ESCRIBO EN EL ARCHIVO
		foreach($ListaDeMascotas AS $item){
			$cant = fwrite($ar, $item->ToString());
			
			if($cant < 1)
			{
				$resultado = FALSE;
				break;
			}
		}
		
		//CIERRO EL ARCHIVO
		fclose($ar);
		
		return $resultado;
	}
	public static function Eliminar($id)
	{
		if($id === NULL)
			return FALSE;
			
		$resultado = TRUE;
		
		$ListaDeCelularesLeidos = Celular::TraerTodosLosCelulares();
		$ListaDeCelulares = array();
		$imagenParaBorrar = NULL;
		
		for($i=0; $i<count($ListaDeCelularesLeidos); $i++){
			if($i == $id){//encontre el borrado, lo excluyo
				//$imagenParaBorrar = trim($ListaDeCelularesLeidos[$i]->pathFoto);
				continue;
			}
			$ListaDeCelulares[$i] = $ListaDeCelularesLeidos[$i];
		}

		//BORRO LA IMAGEN ANTERIOR
		//unlink("archivos/".$imagenParaBorrar);
		
		//ABRO EL ARCHIVO
		$ar = fopen("celular.txt", "w");
		
		//ESCRIBO EN EL ARCHIVO
		foreach($ListaDeCelulares AS $item){
			$cant = fwrite($ar, $item->ToString());
			
			if($cant < 1)
			{
				$resultado = FALSE;
				break;
			}
		}
		
		//CIERRO EL ARCHIVO
		fclose($ar);
		
		return $resultado;
	}
//--------------------------------------------------------------------------------//
}

 ?>