$(document).ready(function(){
  $("#btnn").click(function(){
      var id = $("#ID").val();
      var contra = $("#contra").val();
      if(id=="" || id==null){
        alert("Ingresa un ID");
      }else if(contra=="" || contra==null){
        alert("Ingresa tu contraseña!");
      }else{
        $.ajax({        
          url: "http://siluaa.mybluemix.net/API/ingresar.php",
          method: 'GET',
          data: {id: id, contra: contra},
          dataType:'json',
          mimeType: 'application/json'
        }).done(function(json){
          if(json.result=="true"){
            if(json.datos[0].ID==id && json.datos[0].CONTRA==contra){
              localStorage.setItem("datos_persona", JSON.stringify(json.datos));
              window.location="configuracion.html";
            }else{
              alert("Usuario y contraseña no válidos");
              $('#ID').text("");
              $('#contra').text("");
            }
          }else{
            alert(json.mensaje);
          }
        });
      }
  });
});

$(document).mousemove(function(e){
  TweenLite.to($('body'),
    .5, 
    { css: 
      {
        backgroundPosition: ""+ parseInt(event.pageX/8) + "px "+parseInt(event.pageY/'12')+"px, "+parseInt(event.pageX/'15')+"px "+parseInt(event.pageY/'15')+"px, "+parseInt(event.pageX/'30')+"px "+parseInt(event.pageY/'30')+"px"
      }
    });
});