
$( document ).ready(function() {
	$('#btn_buscar').click(function(){
		var myDate = new Date();
		var displayDate = myDate.getFullYear()+'/'+(myDate.getMonth()+1) + '/' + (myDate.getDate());
		var tiempo = myDate.getHours()+":"+myDate.getMinutes()+":"+myDate.getSeconds();
		var id = $('#datos_id').val();
		var nombre = $('#datos_peronales_nombre').val();
		var apellido = $('#datos_peronales_apellido').val();
		var razon = $('#datos_personales_razon').val();
		if(id==''|| id==null){
			alert("Ingresa un id");
		}else if (nombre==''||nombre==null) {
			alert("Ingresa un nombre!");
		}else if (apellido==''||apellido==null){
			alert("Ingresa un apellido");
		}else if(razon=='' || razon ==null){
			alert("Ingresa la razó por la cual buscas a esa persona");
		}else{
	    	$.ajax({
				url: "http://siluaa.mybluemix.net/API/buscar.php",
				method: 'GET',
				data: {id: id, nombre: nombre, apellido: apellido, razon: razon, fecha: displayDate,hora: tiempo},
				dataType:'json',
				mimeType: 'application/json'
			}).done(function(json) {
				if(json.result=="true"){
					console.log(json.horario);
					localStorage.setItem("datos_horario", JSON.stringify(json.horario));
					localStorage.setItem("horario_persona",JSON.stringify(json.clases));
					localStorage.setItem("configuracion_persona",JSON.stringify(json.configuracion));
				   	window.location="mostrar_horario.html";
				}else{
				   	alert("Algo salió mal");
				}
			});
		}
    });
});
53741171
55
56631945
