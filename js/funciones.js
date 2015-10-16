34579$( document ).ready(function() {
    $('#btn_buscar').click( function (){
    	$.ajax({
				url: "http://192.168.15.251:3000/negocio",
			    method: 'GET',
			    //data: {name: name_business, user_id: user_id},
			    dataType:'jsonp',
			    mimeType: 'application/json'
			}).done(function(jsonp) {
				console.log(jsonp);
			  	var result = jsonp.result;
			  	if(result=="true"){
			   		//jsonp.data.num_venues = num_venues;
			   		//saveStorage(JSON.stringify(jsonp.data),"business","session");
			   		//window.location="datos_personales.html";
			  	}else{
			   		alert("Algo salió mal");
				}
			});
    });
});