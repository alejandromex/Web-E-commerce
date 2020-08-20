// Paginacion del slide

//Variables
var item = 0;
var itemPaginacion = $("#paginacion li");
var interrumpirCiclo = false;
var imgProrducto = $(".imgProducto");
var titulos1 = $("#slide h1");
var titulos2 = $("#slide h2");
var titulos3 = $("#slide h3");
var btnVerProducto = $("#slide button");
var detenerIntervalo = false;
var upDown = true;

// Animacion inicial
//imagenes
$(imgProrducto[item]).animate({"top":-10 + "%", "opacity":0},100);
$(imgProrducto[item]).animate({"top":30 + "px", "opacity":1},600);
//Textos
$(titulos1[item]).animate({"top":-10 + "%", "opacity":0},100);
$(titulos1[item]).animate({"top":30 + "px", "opacity":1},600);
$(titulos2[item]).animate({"top":-10 + "%", "opacity":0},100);
$(titulos2[item]).animate({"top":30 + "px", "opacity":1},600);
$(titulos3[item]).animate({"top":-10 + "%", "opacity":0},100);
$(titulos3[item]).animate({"top":30 + "px", "opacity":1},600);
//Boton
$(btnVerProducto[item]).animate({"top":-10 + "%", "opacity":0},100);
$(btnVerProducto[item]).animate({"top":30 + "px", "opacity":1},600);

$("#paginacion li").click(function(){
    item = $(this).attr("item")-1;
    movimientoSlide(item);
});


//Flecha para avanzar en slide
function avanzar()
{
    if(item == $("#slide ul li").length -1){
        item = 0;
    }
    else{
        item++;
    }
    movimientoSlide(item);
}
$("#avanzar").click(function(){
   avanzar();
});

// Flecha para regresar en slide
$("#retroceder").click(function(){
    if(item==0)
    {
        item = $("#slide ul li").length -1;
    }
    else{
        item--;
    }
    movimientoSlide(item);
});


//Intervalo de tiempo para movimiento automatico
setInterval(function(){
    if(interrumpirCiclo)
    {
        interrumpirCiclo = false;
    }
    else{
        if(!detenerIntervalo)
        {
            avanzar();
        }
    }

},3000)


//Movimiento del slide
function movimientoSlide(item)
{
    $("#slide ul").animate({"left": item * -100 + "%"},1000);
    $("#paginacion li").css({"opacity":.5});
    $(itemPaginacion[item]).css({"opacity":1});
    interrumpirCiclo = true;

    //Imagenes animacion
    $(imgProrducto[item]).animate({"top":-10 + "%", "opacity":0},100);
    $(imgProrducto[item]).animate({"top":30 + "px", "opacity":1},600);  

    //Textos animacion
    $(titulos1[item]).animate({"top":-10 + "%", "opacity":0},100);
    $(titulos1[item]).animate({"top":30 + "px", "opacity":1},600);
    $(titulos2[item]).animate({"top":-10 + "%", "opacity":0},100);
    $(titulos2[item]).animate({"top":30 + "px", "opacity":1},600);
    $(titulos3[item]).animate({"top":-10 + "%", "opacity":0},100);
    $(titulos3[item]).animate({"top":30 + "px", "opacity":1},600);

    //Boton animacion
}

//Aparecer Flechas
$("#slide").mouseover(function(){
    $("#retroceder").css({"opacity":1});
    $("#avanzar").css({"opacity":1});
    detenerIntervalo = true;
});
$("#slide").mouseout(function(){
    $("#retroceder").css({"opacity":0});
    $("#avanzar").css({"opacity":0});
    detenerIntervalo = false;
});

$("#slide ul li").css({"width:":100/$("#slide ul li").length + "%"});
$("#slide ul").css({"width:":100/$("#slide ul li").length*100 + "%"});

//Ocultar Slide
$("#btnSlide").click(function(){

    $("#header").after($("#slide").slideToggle("fast"));
    if(upDown)
    {
        $("#btnSlide i").removeClass("fa-angle-up");
        $("#btnSlide i").addClass("fa-angle-down");
        upDown = false;
    }
    else{
        $("#btnSlide i").removeClass("fa-angle-down");
        $("#btnSlide i").addClass("fa-angle-up");
        upDown=true;
    }
    
})
