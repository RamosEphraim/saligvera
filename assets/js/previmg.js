	$(document).ready(function(){
		$(".picture").change(function(event){
			$("#preview").attr('src',URL.createObjectURL(event.target.files[0]));
	});

		$(".picture2").change(function(event){
			$("#preview2").attr('src',URL.createObjectURL(event.target.files[0]));
	});

		$(".picture3").change(function(event){
			$("#preview3").attr('src',URL.createObjectURL(event.target.files[0]));
	});

		$(".picture4").change(function(event){
			$("#preview4").attr('src',URL.createObjectURL(event.target.files[0]));
	});

		$(".picture5").change(function(event){
			$("#preview5").attr('src',URL.createObjectURL(event.target.files[0]));
	});
	});