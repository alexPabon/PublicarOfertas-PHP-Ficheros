var col_ok ="linear-gradient(90deg, rgb(247, 251, 246) 82%, rgb(194, 230, 193) 98%, rgb(47, 121, 9) 99%)";
var borde_ok ="solid 1px green";
var col_error ="#ffd1d1";
var borde_error ="solid 1px red";

$(document).ready(function()
	{
		var ofert = $("#empresa textarea#oferta");

		$("#pass3").blur(function()
			{				
				if($("#pass2").val()!=$("#pass3").val() || $("#pass2").val().length<6)
				{					
					$("#error_pass1").html("la contraseña no coincide").css({color:"red",fontSize:"13px", marginTop:"0"});
					if($("#pass2").val().length<6)
					{
						document.getElementById("error_pass1").innerHTML += "<br>Minimo 6 caracteres";						
					}
					$("#pass2").css({background:col_error}).val("");
					$("#pass3").css({background:col_error}).val("");					
				}
				else
				{
					$("#error_pass1").html("");
					$("#pass2").css({background:col_ok,borde:borde_ok});
					$("#pass3").css({background:col_ok,borde:borde_ok});					
				}				
			});
		//Confirmar que contenido las entradas del formulario de Empresa, No se encuentre vacio.
		$("#empr").click(function()
			{
				var flag = true;
				var entradas = $("#empresa input.info");				

				$.each(entradas,function(index)
					{
						if(entradas.eq(index).val()=="" || entradas.eq(index).val().length<3)
						{
							entradas.eq(index).css({background:col_error,borde:borde_error});
							flag= false;
						}
					});

				if(ofert.val()=="" | ofert.val().length<7)
				{
					ofert.css({background:col_error});
					$("#error_txt").html("Debe especificar la oferta, minimo 7 caracteres");
					flag =false;
				}
				else
				{
					ofert.css({background:"initial"});
					$("#error_txt").html("");
				}

				if(flag){document.getElementById('registro').submit();}
			});	

		ofert.click(function()
			{
				$(this).css({background:"initial"});
				$("#error_txt").html("");
			});
		
	});