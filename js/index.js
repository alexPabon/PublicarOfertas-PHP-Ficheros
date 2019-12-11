$(document).ready(function()
{
	var divAnuncio = $("div.portada");		

		// funcion para cuando da click en la oferta y no esta registrado
	divAnuncio.click(function(){			
		$(this).html("<h3 class='error'>Para poder acceder a las ofertas, debes registrarte e Iniciar sesion!</h3>");
		
	});		
});