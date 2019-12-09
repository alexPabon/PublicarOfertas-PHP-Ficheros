var col_ok ="linear-gradient(90deg, rgb(247, 251, 246) 82%, rgb(194, 230, 193) 98%, rgb(47, 121, 9) 99%)";
var borde_ok ="solid 1px green";
var col_error ="#ffd1d1";
var borde_error ="solid 1px red";
var exp = false;
var idio = false;
var afic = false;
var enl = false;
		

$(document).ready(function()
	{
		$("div.marcos").hide();
		$("opcion").show();
		
		$("#opcion input[type='button']").click(function()
			{
				$("div.marcos").hide();
				$("div#opcion").hide();
				$("div.marcos input[type='text']").val("").css({background:"initial"});
				$("div.marcos input[type='password']").val("").css({background:"initial"});
				$("div.marcos input[type='email']").val("").css({background:"initial"});

				if($("select").val()== 1)
				{										
					$("#empresa").show();
				}
				else if($("select").val()== 2)
				{					
					$("#persona").show();
				}
				else
				{
					alert("error");
					$("div#opcion").show();
				}
			});


		//--------------------------------------------------------------------------------
		//---------------------------------------------------------------------------------


		val_entradas();
		$('input[type="button"').click(function()
			{
				//Crear entradas de Experiencia
				if($(this).attr("value")=="Experiencia")
				{					
					añadir = confirm("Desea añadir los campos de Experiencia?");
					exp =true;					

					if(añadir)
					{
						campos = parseInt(prompt("Cuantos campos deseas crear?"));
						if(campos>0)
						{
							$("fieldset#experiencia").append('<ul><li><label>Empresa</label><label>Cargo</label><label style="text-align:left;width:5vw;min-width: 50px;padding: 5px 2px;">Años</label></li></ul>')
							for(var i=0; i<campos; i++)
							{
								$("fieldset#experiencia ul").append('<li><input type="text" class="info tam" id="emp0'+i+'"><span></span><input type="text" class="info tam" id="carg0'+i+'"><span></span><input type="number" class="info" id="antig0'+i+'" maxlength="3" style="text-align:left;width:5vw;min-width: 50px;padding:1.5px 5px;"><span></span></li>');
								
							}							
							$("fieldset#experiencia").append('<input type="button" value="Añadir Campo" id="añadir0">');
							$("fieldset#experiencia li label").eq(0).width($("fieldset#experiencia li input").eq(0).width());
							$("fieldset#experiencia li label").eq(1).width($("fieldset#experiencia li input").eq(1).width());
							val_entradas();
							$(this).css("display","none");
							botones_añadidos0();																		
						}
					}					
				}

				//Crear entradas de Idiomas
				if($(this).attr("value")=="Idiomas")
				{					
					añadir = confirm("Desea añadir los campos de Idiomas?");
					idio = true;

					if(añadir)
					{
						campos = parseInt(prompt("Cuantos campos deseas crear?"));
						if(campos>0)
						{
							$("fieldset#idiomas").append('<ul><li><label>Idioma</label><label style="width:7vw;">Nivel</label></li></ul>')
							for(var i=0; i<campos; i++)
							{
								$("fieldset#idiomas ul").append('<li><input type="text" class="info" id="idioma0'+i+'"><span></span><select class="nivel" id="nivel0'+i+'"><option value="0">---</option><option>Basico</option><option>Medio</option><option>Alto</option></select><span></span></li>');								
							}							
							$("fieldset#idiomas").append('<input type="button" value="Añadir Campo" id="añadir1">');
							$("fieldset#idiomas li label").eq(0).width($("fieldset#idiomas li input").eq(0).width());
							$("fieldset#idiomas li label").eq(1).width($("fieldset#idiomas li select").eq(0).width());
							val_entradas();
							$(this).css("display","none");
							botones_añadidos1();																		
						}
					}					
				}

				//Crear entradas de Aficiones
				if($(this).attr("value")=="Aficiones")
				{					
					añadir = confirm("Desea añadir los campos de Aficiones?");					
					afic = true;
					if(añadir)
					{
						campos = parseInt(prompt("Cuantos campos deseas crear?"));
						if(campos>0)
						{
							$("fieldset#aficiones").append('<ul></ul>')
							for(var i=0; i<campos; i++)
							{
								$("fieldset#aficiones ul").append('<li><label for="afic0'+i+'" style="width:18px;text-align:right;">'+(i+1)+'</label><input type="text" class="info" id="afic0'+i+'"><span></span></li>');
								
							}
							val_entradas();
							$("fieldset#aficiones").append('<input type="button" value="Añadir Campo" id="afic1">');
							$(this).css("display","none");
							botones_añadidos2();																		
						}
					}
				}

				//Crear entradas de Enlaces
				if($(this).attr("value")=="Enlaces")
				{
					añadir = confirm("Desea añadir los campos de Aficiones?");					
					enl = true;
					if(añadir)
					{
						campos = parseInt(prompt("Cuantos campos deseas crear?"));
						if(campos>0)
						{
							$("fieldset#enlaces").append('<ul></ul>')
							for(var i=0; i<campos; i++)
							{
								$("fieldset#enlaces ul").append('<li><label for="enla0'+i+'" style="width:18px;text-align:right;">'+(i+1)+'</label><input type="text" class="info" id="enla0'+i+'"><span></span></li>');
								
							}
							val_entradas();
							$("fieldset#enlaces").append('<input type="button" value="Añadir Campo" id="enla1">');
							$(this).css("display","none");
							botones_añadidos3();																		
						}
					}
				}

				//Confirmar que contenido las entradas del formulario de personas, No se encuentre vacio.
				if($(this).attr("id")=="enviar")
				{					
					lbl1 = $("fieldset#d_pers label")					
					confi="";
					entradas =true; 
					
					$.each($("div#persona .info"),function(index)
						{
							if($(".info").eq(index).css("backgroundImage")!=col_ok){entradas = false; $(".info").eq(index).css("background",col_error);}
						});
					$.each($("div#persona select"),function(index)
						{
							if($("select").eq(index).val()=="0"){entradas = false; $("select").eq(index).css({background:col_error,boderColor:"green"});}
						});				
					
					if(entradas)
					{											
						var rev = $("fieldset#d_pers #fechaNac").val().split("-").reverse().join("/");
						$("#fch").val(rev);
						var txtConten = "";
						var contador=1;

						//Pasa la informacion de las entradas a la textarea
						if(exp)
						{
							txtConten ="";
							$.each($("fieldset#experiencia ul li input"),function(index)
								{									
									
									txtConten += $("fieldset#experiencia ul li input").eq(index).val().trim()+" ";
									contador++;
									if(contador==4){txtConten +="años\n\n"; contador=1;}
								});
							$("#expe").html(txtConten);
						}
						if(idio)
						{
							txtConten ="";
							$.each($("fieldset#idiomas ul li input"),function(index)
								{									
									txtConten += $("fieldset#idiomas ul li input").eq(index).val().trim()+" Nivel: "+$("fieldset#idiomas ul li select").eq(index).val().trim()+"\n\n";									
								});
							$("#idio").html(txtConten);	
						}
						if(afic)
						{
							txtConten ="";
							$.each($("fieldset#aficiones ul li input"),function(index)
								{									
									txtConten += $("fieldset#aficiones ul li input").eq(index).val().trim()+"\n\n";									
								});
							$("#afic").html(txtConten);							
						}
						if(enl)
						{
							txtConten ="";
							$.each($("fieldset#enlaces ul li input"),function(index)
								{									
									
									txtConten += $("fieldset#enlaces ul li input").eq(index).val().trim()+"\n\n";
									
								});
							$("#enl").html(txtConten);							
						}
						
						document.getElementById('regis').submit();
					}
					else
					{
						alert("Hay algunos campos que se deben rellenar")
					}					
				}
											
			});		

		//Valida la entrada de la fecha cuando damos click en el seleccionador de fechas.
		$('input#fechaNac').click(function()
			{
				posicion = $(this).attr("id");
				info_entrada = $(this).val();
				cambio = info_entrada.split("-").reverse();
				ca = cambio[0]+"/"+cambio[1]+"/"+cambio[2];				
				 
				resul = validar(posicion,ca);				

				if(resul[0])
				{
					$(this).css({background:col_ok,border:borde_ok});
					$(this).next().html("");
				}else
				{
					$(this).css({background:col_error,border:borde_error});
					$(this).next().html(resul[1]).css({display:"block",fontSize:"12px",color:"red"});					
				}
			});

		//Valida la entrada de la fecha cuando damos salimos de el seleccionador de fuechas.	
		$('input#fechaNac').blur(function()
		{
			posicion = $(this).attr("id");
			info_entrada = $(this).val();
			cambio = info_entrada.split("-").reverse();
			ca = cambio[0]+"/"+cambio[1]+"/"+cambio[2];			
			 
			resul = validar(posicion,ca);				

			if(resul[0])
			{
				$(this).css({background:col_ok,border:borde_ok});
				$(this).next().html("");
			}else
			{
				$(this).css({background:col_error,border:borde_error});
				$(this).next().html(resul[1]).css({display:"block",fontSize:"12px",color:"red"});					
			}
		});

		//Valida el estado de soltero o casado cuando salimos de select.
		$("#estado").blur(function()
			{
				posicion = $(this).attr("class");
				info_entrada = $(this).val();
				resul = validar(posicion,info_entrada);

				if(resul[0])
				{					
					$(this).next().html("");
				}else
				{					
					$(this).next().html(resul[1]).css({display:"block",fontSize:"12px",color:"red"});					
				}
			});

		//Valida las contraseñas introducidas.
		$("#pass1").blur(function()
			{				
				if($("#pass").val()!=$("#pass1").val() || $("#pass").val().length<6)
				{					
					$("#error_pass").html("la contraseña no coincide").css({color:"red",fontSize:"13px", marginTop:"0"});
					if($("#pass").val().length<6)
					{
						document.getElementById("error_pass").innerHTML += "<br>Minimo 6 caracteres";						
					}
					$("#pass").css("background",col_error).val("");
					$("#pass1").css("background",col_error).val("");
				}
				else
				{
					$("#error_pass").html("");
				}

				
				
			});
	});

//---------------------------------------------------------------------------------------
//***************************************************************************************
//---------------------------------------------------------------------------------------


function botones_añadidos0()
{
	var lista0,nom_id0,pos0;
	
	$('input[type="button"').on("click",function()
		{			
			//Añadir campo de experiencia
			if($(this).attr("id")=="añadir0")
				{
					lista0 = $("fieldset#experiencia ul li input");
					nom_id0 = lista0.eq(lista0.length-1).attr("id");
					pos0 = parseInt(nom_id0.substr(nom_id0.length-2,nom_id0.length));
		
					$("fieldset#experiencia ul").append('<li><input type="text" class="info tam" id="emp0'+(pos0+1)+'"><span></span><input type="text" class="info tam" id="carg0'+(pos0+1)+'"><span></span><input type="number" class="info" id="antig0'+(pos0+1)+'" maxlength="3" style="text-align:left;width:5vw;min-width: 50px;padding:1.5px 5px;"><span></span></li>');
					val_entradas()
				}			
		});	
}

function botones_añadidos1()
{	
	var lista1,nom_id1,pos1;	
	
	$('input[type="button"').on("click",function()
		{
			//Añadir campo de Idioma
			if($(this).attr("id")=="añadir1")
			{
				lista1 = $("fieldset#idiomas ul li input");
				nom_id1 = lista1.eq(lista1.length-1).attr("id");
				pos1 = parseInt(nom_id1.substr(nom_id1.length-2,nom_id1.length));
				$("fieldset#idiomas ul").append('<li><input type="text" class="info" id="idioma0'+(pos1+1)+'"><span></span><select class="nivel" id="nivel0'+(pos1+1)+'"><option value="0">---</option><option>Basico</option><option>Medio</option><option>Alto</option></select><span></span></li>');
				val_entradas();				
			}		
		});	
}

function botones_añadidos2()
{
	var lista2,nom_id2,pos2;
	var nom_frm="";
	$('input[type="button"').on("click",function()
		{
			//Añadir campo de Aficiones
			if($(this).attr("id")=="afic1")
			{
				nom_frm = $(this).attr("id").substring(0,$(this).attr("id").length-1);
				lista2 = $("fieldset#aficiones ul li label");
				nom_id2 = lista2.eq(lista2.length-1).html();
				pos2 = parseInt(nom_id2);
				
				$("fieldset#aficiones ul").append('<li><label for="afic0'+(pos2+1)+'" style="width:18px;text-align:right;">'+(pos2+1)+'</label><input type="text" class="info" id="afic0'+(pos2+1)+'"><span></span></li>');
				val_entradas();				
			}
		});	
}

function botones_añadidos3()
{
	var lista3,nom_id3,pos3;
	var nom_frm="";
	$('input[type="button"').on("click",function()
		{
			//Añadir campo de enlaces.
			if($(this).attr("id")=="enla1")
			{
				lista3 = $("fieldset#enlaces ul li label");
				nom_id3 = lista3.eq(lista3.length-1).html();
				pos3 = parseInt(nom_id3);
				
				$("fieldset#enlaces ul").append('<li><label for="afic0'+(pos3+1)+'" style="width:18px;text-align:right;">'+(pos3+1)+'</label><input type="text" class="info" id="afic0'+(pos3+1)+'"><span></span></li>');
				val_entradas();				
			}
		});	
}

function val_entradas()
{	
	//Valida las entradas, despues de pulsar cada letra del teclado.
	$('input[class="info"]').keyup(function()
		{
			var posicion = $(this).attr("id");
			var info_entrada = $(this).val();
			var resul;			
			resul = validar(posicion,info_entrada);				

			if(resul[0])
			{
				$(this).css({background:col_ok, border:borde_ok});
				$(this).next().html("");
			}else
			{
				$(this).css({background:col_error,border:borde_error});
				$(this).next().html(resul[1]).css({fontSize:"12px",color:"red"});				
			}			
		});	

	//Valida las entradas del campo de experiencia, despues de pulsar cada letra del teclado.
	$('input[class="info tam"]').keyup(function()
		{
			var posicion = $(this).attr("id");
			var info_entrada = $(this).val();
			var resul;			
			resul = validar(posicion,info_entrada);				

			if(resul[0])
			{
				$(this).css({background:col_ok, border:borde_ok});
				$(this).next().html("");
			}else
			{
				$(this).css({background:col_error,border:borde_error});
				$(this).next().html(resul[1]).css({fontSize:"12px",color:"red"});				
			}			
		});	


	//Valida el Nivel de Idioma.
	$(".nivel").blur(function()
		{
			var posicion = $(this).attr("class");
			var info_entrada = $(this).val();
			var resul = validar(posicion,info_entrada);
			var resul;						

			if(resul[0])
			{
				$(this).css({background:col_ok,border:borde_ok});
				$(this).next().html("");
			}else
			{
				$(this).css({background:col_error,border:borde_error});
				$(this).next().html(resul[1]).css({display:"block",fontSize:"12px",color:"red"});				
			}

		});	

	//Valida la antiguedad.
	$('input[type="number"]').blur(function()
		{
			var posicion = $(this).attr("type");
			var info_entrada = $(this).val();
			var resul = validar(posicion,info_entrada);
			var resul;						

			if(resul[0])
			{
				$(this).css({background:col_ok,border:borde_ok});
				$(this).next().html("");
			}else
			{
				$(this).css({background:col_error,border:borde_error});	
				$(this).next().html(resul[1]).css({display:"block",fontSize:"12px",color:"red"});				
			}

		});		
}

function validar(pos,inf)
{	
	//Valida todos los campos de entradas y select.
	var num_tel = inf.substring(0,1);	

	if(pos=="nombre" || pos=="apellidos")
	{
		return [/^[a-z A-Z]{3,20}$/.test(inf),"Error, debe tener mas de 3 caracteres"]		
	}
	else if(pos=="dni")
	{
		if(/^\d{8}[a-zA-Z]{1}$/.test(inf))
		{
			var letra =["T","R","W","A","G","M","Y","F","P","D","X","B","N","J","Z","S","Q","V","H","L","C","K","E"];
			var numero = parseInt(inf.substr(0,inf.length-1));
			var let = inf.substr(inf.length-1,inf.length).toUpperCase();
			var resto = numero%23;

			if(let==letra[resto])
			{
				return [/^\d{8}[a-zA-Z]{1}$/.test(inf),""];
			}
			else
			{
				return [false,"La letra no coincide con el numero!"];
			}
			
		}
		else
		{
			return [false,"DNI erroneo!"];
		}		
	}
	else if(pos=="direc")
	{
		return [/^[a-z A-Z0-9ª/º#.-]{3,50}$/.test(inf),"Solo aceptan ciertos caracteres especiales \"/.#ºª-\""];
	}
	else if(pos=="correo")
	{
		return [/[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/.test(inf),"Error al introducir el Email"];
	}	
	else if(pos=="tel")
	{
		if(num_tel==9 || num_tel==7 || num_tel==6 )
		{
			return [/^[0-9]{9,9}$/.test(inf),"Debe haber nueve numeros"];
		}
		else
		{
			return [false,"El numero debe comenzar por 9,7,6 y debe haber 9 numeros."];
		}		
	}
	else if(pos=="fechaNac")
	{		
		if(/^([0-9]{2}\/[0-9]{2}\/[0-9]{4})$/.test(inf))
		{
			var cambio = inf.split("/");
			return [true,cambio[2]+"-"+cambio[1]+"-"+cambio[0]]
		}
		else 							
		{
			return [false,"La fecha debe ir dd/mm/yyyy"];
		}		
	}
	else if(pos=="estado")
	{		
		if(inf=="soltero" || inf==1)
		{
			$("#estado").css({background:col_ok,border:borde_ok});
			return [true,1];			
		}
		else if(inf =="casado" || inf>1)
		{
			$("#estado").css({background:col_ok,border:borde_ok});
			return [true,2];
		}
		else
		{
			$("#estado").css({background:col_error,border:borde_error});
			return[false,"Debe escribir: soltero/casado"];
		}
	}
	else if(pos=="nivel" || pos=="number")
	{		
		if(inf!= 0)
		{
			return [true,""];			
		}		
		else
		{			
			return [false,"Falta datos en esta linea"];
		}
	}
	else
	{
		if(inf.length>=2)
		{
			return [true,""]
		}		
		else
		{
			return [false,""]
		}
	}		
}
