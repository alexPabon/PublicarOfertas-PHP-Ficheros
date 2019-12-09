$(document).ready(function()
	{
		var divAnuncio = $("div.portada");

		divAnuncio.click(function()
			{
				$(this).html("<h3>Para poder acceder a las ofertas, debes de estar registrado!</h3>");
				$(this).css({background:"white",border:"solid 1px black",textAlign: "center",padding: "10px",borderRadius: "5px",margin:"15px 0"});
			});
	});