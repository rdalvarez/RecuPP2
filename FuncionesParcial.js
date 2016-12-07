function AltaCelular(){
	var pagina = "nexoadministrador.php";
	var marca = $('#marca').val();
	var modelo = $('#modelo').val();
	var fechaDeFabricacion = $('#fechaDeFabricacion').val();

	var sistemaOperativo = $('#sistemaOperativo').val();	
	var sim;

	if ($('#sim').is(':checked')) {
		sim = 1;
	}
	else{sim=2;};

	var liberado;

	if ($('#liberado').is(':checked')) { liberado = 1; } else { liberado = 0;};

	var foto = $('#hdnArchivoTemp').val();

	var celular = {};
	celular.marca = marca;
	celular.modelo = modelo;
	celular.fechaDeFabricacion = fechaDeFabricacion;
	celular.sistemaOperativo = sistemaOperativo;
	celular.sim = sim;
	celular.liberado = liberado;
	celular.foto = foto;
	
	$.ajax({
        type: 'POST',
        url: pagina,
		data : { 
			queHago: "ALTA_CELULAR",
			celular: celular
		},
        dataType: "html",
        async: true
    })
	.then(function bien(grilla) {
		//$("#divGrilla").html(grilla);
		alert(grilla);

		MostrarGrilla();
		$('#marca').val("");
		$('#modelo').val("");
		$('#fechaDeFabricacion').val("");
		$("#divFoto").html("");

	},
	function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
        });   
}

function MostrarGrilla(){
	
    var pagina = "nexoadministrador.php";

	$.ajax({
        type: 'POST',
        url: pagina,
		data : { queHago : "MOSTRAR_GRILLA"},
        dataType: "html",
        async: true
    })
	.then(function bien(grilla) {
		//console.log(grilla);
		$("#divGrilla").html(grilla);
	},
	function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
        });   
}

function BorrarCelular(id){
	var pagina = "nexoadministrador.php";
	var id = id;

	$.ajax({
        type: 'POST',
        url: pagina,
		data : { queHago : "BORRAR_CELULAR", id: id},
        dataType: "html",
        async: true
    })
	.then(function bien(grilla) {
		//console.log(grilla);
		MostrarGrilla();
	},
	function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
        });  

}

function SubirFoto(){
	
    var pagina = "nexoadministrador.php";
	var foto = $("#archivo").val();
	
	if(foto === "")
	{
		return;
	}

	var archivo = $("#archivo")[0];
	var formData = new FormData();
	formData.append("archivo",archivo.files[0]);
	formData.append("queHago", "SUBIR_FOTO");

	$.ajax({
        type: 'POST',
        url: pagina,
        dataType: "json",
		cache: false,
		contentType: false,
		processData: false,
        data: formData,
        async: true
    })
	.then(function bien(objJson) {
		console.info("BIEN: "+objJson.Mensaje);

		if(!objJson.Exito){
			alert(objJson.Mensaje);
			return;
		}
		$("#divFoto").html(objJson.Html);
	},
	function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
        });
}
function BorrarFoto(){

	var pagina = "./nexoadministrador.php";
	var foto = $("#hdnArchivoTemp").val();
	
	if(foto === "")
	{
		alert("No hay foto que borrar!!!");
		return;
	}
	
	$.ajax({
        type: 'POST',
        url: pagina,
        dataType: "json",
        data: {
			queHago : "BORRAR_FOTO",
			foto : foto
		},
        async: true
    })
	.done(function (objJson) {

		if(!objJson.Exito){
			alert(objJson.Mensaje);
			return;
		}
		
		$("#divFoto").html("");
		$("#hdnArchivoTemp").val("");
		$("#archivo").val("");
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });   	
	
	return;
}