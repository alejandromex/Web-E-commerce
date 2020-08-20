//CABEZOTE
$(document).ready( function (){

$("#btnCategorias").click(function(){
	if(window.matchMedia("(max-width:768px)").matches){
		$("#btnCategorias").after($("#categorias").slideToggle("fast"))
	}
	else{
		$("#cabezote").after($("#categorias").slideToggle("fast"))

	}
});
});