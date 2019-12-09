$(document).ready(function()
	{
		var verOferta = $("div.contenido");
		var contenedorOferta = $("div.marco_oferta")


		verOferta.click(function()
			{
				if($(this).parent().is(".on"))
				{
					$(this).removeClass("mostrar");
					$(this).closest(".marco_oferta").removeClass("on");
				}
				else
				{
					verOferta.removeClass("mostrar");
					contenedorOferta.removeClass("on");
					$(this).addClass('mostrar');
					$(this).closest(".marco_oferta").addClass("on");
				}
				
				
					//css({height:"50px",overflow:"hidden"});
				
					//.css({backgroundColor:"white",overflow:"visible",height:"auto"});
			});
	});