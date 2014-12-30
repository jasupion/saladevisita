
$(document).ready(function() {
    $(".breadcrumb").clone().appendTo("#flutuante-content"); 
    $(".logininfo:first").clone().appendTo("#flutuante-user");
    
    $(window).scroll(function(){
    	($(window).scrollTop() > 191)? $("#topo-flutuante").fadeIn("normal") : $("#topo-flutuante").fadeOut("normal");
    });

    if($(".singlebutton").length){
    	$(".singlebutton").each(function(){
	    	var element = $(this).find("input[type=submit]");
	    	if(element.val() == "Gerenciar meus arquivos privados"){
	    		element.css("font-size","13px");
	    		element.val("Gerenciar arquivos privados");
	    	} 
	    });
    }

    //validacao ainda em teste
    $(".region-content").each(function(){
	    var widthRegion = $(".region-content").width();
	    var form = $(this).find("form")[0];
	    if(form){
	        $(form).each(function(){
	            var div = $(document.createElement("div")),
	            element = $(this).find("table");
	            if(element){
	                if(element.width() > widthRegion){
	                    div.addClass("newElement");
	                    div.css("overflow","auto");
	                    div.appendTo($(this));
	                    element.clone().appendTo(div);
	                    if($(this).find("table")[0]){
	                        $(this).find("table:first").remove();
	                    }
	                }
	            }
	            
	        });
	    }
	});
    
    //Proibir a edição de dados pessoais no editar perfil do Moodle - /moodle/user/edit.php
    (function(){
    	var url = window.location;
		url = url.toString();
		if (url.match("user/edit")){
			var div = $(".clearfix");
			div[1].remove();
		}
    })();
    

});