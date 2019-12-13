var col_ok ="linear-gradient(90deg, rgb(247, 251, 246) 82%, rgb(194, 230, 193) 98%, rgb(47, 121, 9) 99%)";
var borde_ok ="solid 1px green";
var col_error ="#ffd1d1";
var borde_error ="solid 1px red";

$(document).ready(function()
{
	
	$("#seleccionar").blur(function()
	{
		if($("#seleccionar").val()=="Empresa"){
			$("#tipo").val("1");
			$(this).css({background:col_ok});
		}
		else if($("#seleccionar").val()=="Persona"){
			$("#tipo").val("0");
			$(this).css({background:col_ok});
		}
		else{
			$("#tipo").val("");
			$(this).css({background:col_error});
		}				
	});

	$("#entrar").click(function()
	{
		var flag=true;
		if($("#user").val()==""){
			$("#user").css({background:col_error});
			flag=false;
		}
		else{
			$("#user").css({background:col_ok});	
		}
		
		if($("#pass").val()==""){
			$("#pass").css({background:col_error});
			flag=false;
		}
		else{
			$("#pass").css({background:col_ok});	
		}
		
		if($("#tipo").val()==""){
			flag=false;
			$("#seleccionar").css({background:col_error});
		}

		if(flag){document.getElementById('login').submit();}
	});

	$(".log_int").click(function(){
		$(this).css({background:"initial"});
	});

});