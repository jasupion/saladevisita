// scripts criado para o projeto
(function(window, document,$){
  'use strict';        
  var BaseController = (function(){
    
    var _public = {};
	
	_public.getTopBar = function(){
		$(".breadcrumb").clone().appendTo("#flutuante-content"); 
    	$(".logininfo:first").clone().appendTo("#flutuante-user");
    	$(window).scroll(function(){
	    	($(window).scrollTop() > 191)? $("#topo-flutuante").fadeIn("normal") : $("#topo-flutuante").fadeOut("normal");
	    });
	};

	_public.removeHtml = function(obj){
		var url = window.location;
		url = url.toString();
		if (url.match(obj.url)){
			var div = $(obj.class);
			div[1].remove();
		}
	};


	_public.init = function(){
		_public.getTopBar();
		//Proibir a edição de dados pessoais no editar perfil do Moodle - /moodle/user/edit.php
		_public.removeHtml({url:'user/edit',class:'.clearfix'});
	};

    return _public; 

  })();
  window.App.BaseController = BaseController;
})(window, document,$);

$(document).ready(function(){
	App.BaseController.init();
});