$("#private").hide();
$("#public").hide();
function projectType(){ 
	var type = $('#type').val();

	if(type == 1){
		$('#public').show();
		$('#private').hide();
	} else{
		$('#public').hide();
		$('#private').show();
	} 
	prevenDefault();

}

$('#PCS').hide();
$('#KLG').hide();
$('#BOXES').hide();
function selectUnit(){ 
	var type = $('#supply').val();
	var code = type.split("=");
	if(code[0] == 'PCS'){
		$('#PCS').show();
		$('#KLG').hide();
		$('#BOXES').hide();
	} 
	else if(code[0] == 'KLG'){
		$('#PCS').hide();
		$('#KLG').show();
		$('#BOXES').hide();
	}
	else if(code[0] == 'BOXES'){
		$('#PCS').hide();
		$('#KLG').hide();
		$('#BOXES').show();
	}
	prevenDefault();

}


$("#extra").hide();
function typeuser(){ 
	var type = $('#xrole').val();

	if(type == 4){
		$('#extra').show();
	} else{
		$('#extra').hide();
	} 
	prevenDefault();

}