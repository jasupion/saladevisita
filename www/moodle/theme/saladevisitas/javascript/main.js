// scripts criado para o projeto
(function(window, document,$){
  'use strict';        
  var App = (function(){
    
    var _public = {};

    _public.init = function(){

    };

    return _public; 

  })();
  window.App = App;
  App.init();
})(window, document,$);



$(document).ready(function(){
	$('.menu-anchor').on('click touchstart', function(e){
		$('html').toggleClass('menu-active');
	  	e.preventDefault();
	});
});   