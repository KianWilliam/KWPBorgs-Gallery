/*
* @package component borggique for Joomla! 3.x
 * @version $Id: com_borggique 1.0.0 2017-4-10 23:26:33Z $
 * @author Kian William Nowrouzian
 * @copyright (C) 2016- Kian William Nowrouzian
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 
 This file is part of borggique.
    borggique is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    borggique is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with borggique.  If not, see <http://www.gnu.org/licenses/>. 
*/


(function($)
{
			
		    var global = {selected:'', selector:''};
			var angle = 0;
			var myclass='';
			
			
			
       var init = $.prototype.init;
		$.prototype.init = function (selector, context)
	    {
		   var r = init.apply(this, arguments);
		   if(selector && selector.selector)
		   {
			r.context = selector.context;
			r.selector = selector.selector;
		   }
		   if(typeof selector == 'string')
		   {
			r.context = context || document,r.selector = selector,global.selector = r.selector;
		   }
		   global.selected = r;
		   return r;
	   }
	   	$.prototype.init.prototype = $.prototype;
		
		$.fn.borg = {
			config: function(args){	
				//args.dbc='';
				//args.cbc='';
				console.log("fack you");
				setConfig($.extend({}, $.fn.borg.defaults, args));
				
			},
			init:function(){
				
						var arrayTranslates =["translateZ("+parseInt(config.height)/2+"px )","rotateX( -180deg ) translateZ( "+parseInt(config.height)/2+"px )"];

						var arrayRotates= ["rotateX(   90deg ) translateZ( "+parseInt(config.height)/2+"px )", "rotateX(  -90deg ) translateZ( "+parseInt(config.height)/2+"px )"];
		                var arrayRotatesb= ["rotateY(   90deg ) translateZ( "+parseInt(config.width)/2+"px )", "rotateY(  -90deg ) translateZ( "+parseInt(config.width)/2+"px )"];

				global.selected.css({ position:'relative', marginLeft:'auto', marginRight:'auto', backgroundColor:config.cbc, perspective:'1200px',mozPerspective:'1200px', webkitPerspective:'1200px', oPerspective:'1200px',  width:parseInt(config.width)+'px', height:parseInt(config.height)+'px'});
				
				if(myclass=='')
						$('<div id=surfacecontainer></div>').css({ position:'absolute', left:0, top:0, display:'block', width:config.width+'px', height:config.height+'px',   transformStyle:'preserve-3d', webkitTransformStyle:'preserve-3d', mozTransformStyle:'preserve-3d', oTransformStyle:'preserve-3d'}).appendTo('.borggique');
				else
						$('<div id=surfacecontainer></div>').css({ position:'absolute', left:0, top:0, display:'block', width:config.width+'px', height:config.height+'px',   transformStyle:'preserve-3d', webkitTransformStyle:'preserve-3d', mozTransformStyle:'preserve-3d', oTransformStyle:'preserve-3d'}).appendTo('.'+myclass);

				console.log("class"+myclass);
				
				for(var i=0; i<6; i++)
		        {
					$('<div id="surface'+i+'"></div>').css({position:'absolute', left:0, top:0, width:parseInt(config.width)+'px', height:parseInt(config.height)+'px', backgroundColor:config.dbc}).appendTo('#surfacecontainer');
		        }
				for(i=0; i<2; i++)
		       {
			      $('#surfacecontainer').children('div').eq(i).css({transform:arrayTranslates[i], webkitTransfrom:arrayTranslates[i], msTransfrom:arrayTranslates[i]});
		       }
		       for(i=2; i<4; i++)
		       {
				  $('#surfacecontainer').children('div').eq(i).css({transform:arrayRotates[i-2], webkitTransform:arrayRotates[i-2], msTransfrom:arrayRotates[i-2]});
	           }
		       for(i=4; i<=5; i++)
		       {
			      $('#surfacecontainer').children('div').eq(i).css({transform:arrayRotatesb[i-4], webkitTransform:arrayRotatesb[i-4], msTransfrom:arrayRotatesb[i-4]});
		       }
			   					$.fn.borg.rotate();

			},
			
			rotate:function()
			{
				 $({deg:angle}).animate({deg:angle+90}, { duration:parseInt(config.cubespeed), step:function(n){
					 $('#surfacecontainer').css({transform:'rotateY('+n+'deg)', mozTransfrom:'rotateY('+n+'deg)', webkitTransfrom:'rotateY('+n+'deg)', msTransfrom:'rotateY('+n+'deg)'});
				 },
			  complete:function()
		    {
				var interval = setInterval(function(){
					angle+=90;
					clearInterval(interval);
					$('#surface'+surfacecounter).tinies.init();					
				}, parseInt(config.cubespeed)/2);
			}
			 });
			},
			setmyclass:function(my)
			{
				myclass = my
			}
			
			
		}
		
		
		
	   function setConfig(value){
		   
		         config = value;

				 }
	   function getConfig() {return config;}

}(jQuery))