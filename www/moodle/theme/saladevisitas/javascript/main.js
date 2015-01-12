// scripts criado para o projeto
(function(window, document,$){
  'use strict';        
  var App = (function(){
    
    var _public = {};

    _public.pathSvg = function(){
    	jQuery('img.svg').each(function(){
	        var $img = jQuery(this),
	        imgID = $img.attr('id'),
	        imgClass = $img.attr('class'),
	        imgURL = $img.attr('src');
	    
	        jQuery.get(imgURL, function(data) {
	            var $svg = jQuery(data).find('svg');
	    		
	    		if(typeof imgID !== 'undefined') {
	                $svg = $svg.attr('id', imgID);
	            }
	            
	            if(typeof imgClass !== 'undefined') {
	                $svg = $svg.attr('class', imgClass+' replaced-svg');
	            }
	    
	            $svg = $svg.removeAttr('xmlns:a');
	    
	            $img.replaceWith($svg);
	    
	        }, 'xml');
	    
	    });
    };

    _public.menuSandwich = function(){
    	$('.menu-anchor').on('click touchstart', function(e){
			$('html').toggleClass('menu-active');
		  	$('.overlay').show();		  	
		  	e.preventDefault();

		});

		$('.overlay').on('click',function(e){
                $('.overlay').hide();                                
                $('html').toggleClass('menu-active');
		  		e.preventDefault();
            });
    };

     _public.init = function(){
		_public.pathSvg();
		_public.menuSandwich();
		$(".dock_left_vertical nothingdocked").remove();
    };

    return _public; 

  })();
  window.App = App;
  App.init();
})(window, document,$);




