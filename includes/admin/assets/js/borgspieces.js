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
							var config={};

		    var global = {selected:'', selector:''};
			//var config = $.fn.borg.getConfig();
			//console.log("rows"+config.rows);
			var tops=[];
			var lefts=[];
			var lflags = [];
			var tflags = [];
			var arraycountFlagsRows = [];
			var arraycountFlagsCols = [];
			var widthpiece;
			var heightpiece;
			var counter1=0;
			var counter2=0;
			var arrayforflagx = [0];
			var arrayforflagy = [0];
			var a=0;
			var interval;
			var intervalb;
			var ls=0;
				var ts = 0;
				var p=0;
			
			
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
		
		$.fn.tinies = {
			
			init:function(){
				//	config.rows = 20;
//config.cols = 20;	
//config.width=400;
//config.height=400;				
console.log("mooohaha"+config.width); 
								

			 tops = [parseInt(config.rows)];
			 lefts = [parseInt(config.cols)];

				widthpiece = parseInt(config.width)/parseInt(config.cols);
				heightpiece = parseInt(config.height)/parseInt(config.rows);
											//	console.log("mooo"+config.cbc); 

				for(var i=0; i<parseInt(config.cols); i++)
				{
					lefts[i] = (i * parseInt(widthpiece));	
					lflags[i]=true;
					arraycountFlagsRows[i]=0;
				}
				for( i=0; i<parseInt(config.rows); i++)
				{
					tops[i] = (i * parseInt(heightpiece));
					tflags[i]=true;
					arraycountFlagsCols[i]=0;
				}
				 for(var g=0; g<parseInt(config.rows) * parseInt(config.cols); g++)
				 {
					 arrayforflagx[g]=-1;
				     arrayforflagy[g]=-1;
				 }
				  ls=0;
				 ts = 0;
				 p=0;
				if(generalflag<4)
				{
				$('#surface'+surfacecounter).css({ overflow:'hidden',position:'absolute', left:0, top:0, backgroundColor:config.dbc, perspective:'1900px', webkitTransformStyle:'preserve-3d',transformStyle:'preserve-3d', mozTransformStyle:'preserve-3d' , msTransformStyle:'preserve-3d', width:parseInt(config.width)+'px', height:parseInt(config.height)+'px', borderRight:'1px solid '+config.dbc, borderBottom:'1px solid '+config.dbc});
				$('#surface'+surfacecounter).append('<div id="imagesrotator" class="cimagesrotator"></div>');
				$('.cimagesrotator').css({position:'absolute', left:0, top:0, width:parseInt(config.width)+'px', height:parseInt(config.height)+'px', backgroundColor:config.dbc});
				
				for( i=0; i< parseInt(config.rows) * parseInt(config.cols) ; i++)
				{
					$('#surface'+surfacecounter+' .cimagesrotator').append('<div id="tiny'+i+'" class="tinimage"></div>');
					$('#surface'+surfacecounter+' .cimagesrotator').children('div').eq(i).css({backgroundImage:'url('+config.images[imageindex]+')', backgroundSize:parseInt(config.width)+'px '+parseInt(config.height)+'px'});
					$('#surface'+surfacecounter+' .cimagesrotator').children('div').eq(i).css({position:'absolute', left:lefts[ls]+'px', top:tops[ts]+'px', backgroundPosition:''+(-1)*lefts[ls]+'px '+(-1)*tops[ts]+'px', border:'1px solid '+config.dbc, width:widthpiece+'px', height:heightpiece+'px'});
					
					p+=widthpiece;	
					ls++;
					if(parseInt(config.cols)==ls)
						ls=0;
					if(p==parseInt(config.width))
					{
						ts++;
						p=0;
					}				
				}
				if(surfacecounter==1)
				{
				   $('#surface1 .cimagesrotator').css({transfrom:'rotateZ(180deg)', webkitTransform:'rotateZ(180deg)', mozTransfrom:'rotateZ(180deg)', msTransform:'rotateZ(180deg)'});
				   
				}
				generalflag++;
				}
		

			for(var k=0; k< parseInt(config.rows) * parseInt(config.cols) ; k++)
				{
					if(generalflag==4)
					    $('#surface'+surfacecounter+' .cimagesrotator').children('div').eq(k).css({backgroundImage:'url('+config.images[imageindex]+')'});

					var r = Math.floor(Math.random()* (parseInt(config.rows)));
					var c = Math.floor(Math.random()* (parseInt(config.cols)));
					while( (checkFlags(r, c)==false) && i< (parseInt(config.rows) * parseInt(config.cols)) )
					{
						 r = Math.floor(Math.random()* parseInt(config.rows));
					     c = Math.floor(Math.random()* parseInt(config.cols));

					}
					
				   $('#surface'+surfacecounter+' .cimagesrotator').children('div').eq(k).css({left:lefts[c]+'px', top:tops[r]+'px' });

				}
				
				 if(imageindex<parseInt(config.images.length) - 1)
					       imageindex++;
				      else
					       imageindex=0;
				
           interval = setInterval(function(){
			   clearInterval(interval);
										$('#surface'+surfacecounter).tinies.primaryShape();
				}, 2000);   
				
				
			},
			primaryShape:function()
			{
                // clearInterval(interval);
													//console.log("tiny");

				 ls=0;
				 ts = 0;
				 p=0;
				for( i=0; i< parseInt(config.rows) * parseInt(config.cols) ; i++)
				{
					$('#surface'+surfacecounter+' .cimagesrotator').children('div').eq(i).stop(true, true).animate({ left:lefts[ls]+'px', top:tops[ts]+'px' }, parseInt(config.imagebuildspeed), function(){
													//console.log("tiny");

						if($(this).attr("id")=="tiny"+(parseInt(config.cols)*parseInt(config.rows)-1))
						{
							//console.log("tiny");
						    var interval = setInterval(function(){
							clearInterval(interval);
							$('#surface'+surfacecounter).tinies.rotateForNew();
						      }, 2000);
						}
						
					});
					
					p+=widthpiece;	
					ls++;
					if(parseInt(config.cols)==ls)
						ls=0;
					if(p==parseInt(config.width))
					{
						ts++;
						p=0;
					}				
				}
				$('#surface'+surfacecounter).attr("title", config.descs[imageindex-1]);

			},
			rotateForNew:function()
			{				
				$({deg:0}).animate({deg:360}, { duration:parseInt(config.cubespeed), step:function(n){
					if(config.axis=='Y')
					     $('#surface'+surfacecounter+' .cimagesrotator').css({transform:' rotateY('+n+'deg)', webkitTransform:'rotateY('+n+'deg)', mozTransform:'rotateY('+n+'deg)', msTransform:'rotateY('+n+'deg)'});
					else
						 $('#surface'+surfacecounter+' .cimagesrotator').css({transform:'rotateX('+n+'deg)', webkitTransform:'rotateX('+n+'deg)', mozTransform:'rotateX('+n+'deg)', msTransform:'rotateX('+n+'deg)'});
					if(surfacecounter==1)
					{
						if(config.axis=='Y')
					     $('#surface1 .cimagesrotator').css({transform:'rotateZ(180deg) rotateY('+n+'deg)', webkitTransform:'rotateZ(180deg) rotateY('+n+'deg)', mozTransform:'rotateZ(180deg) rotateY('+n+'deg)', msTransform:'rotateZ(180deg) rotateY('+n+'deg)'});
					else
						 $('#surface1 .cimagesrotator').css({transform:'rotateZ(180deg) rotateX('+n+'deg)', webkitTransform:'rotateZ(180deg) rotateX('+n+'deg)', mozTransform:'rotateZ(180deg) rotateX('+n+'deg)', msTransform:'rotateZ(180deg) rotateX('+n+'deg)'});

					}
						
                }, complete:function(){
					        a=0;

					       
						   switch(surfacecounter)
					      {
						case 0:
							surfacecounter=5;
							break;
						case 4:
							surfacecounter=0;
							break;
						case 1:
							surfacecounter = 4;
							break;
						case 5:
							surfacecounter = 1;
							break;
					     }
						   $.fn.borg.rotate();
					
				}
				});
				
					
			
			
			},
			setConfig:function(conf)
			{
				config = conf;
			}
			
		}
		
	   function checkFlags(x, y)
	   {
		   var flag=1;
		   var flagr;
		   var flagx;
		   for(var i=0; i<lflags.length; i++)
		   {
			   //e.g 10 columns that could be repeated as many as rows we have
			   if( (lflags[i]==y) && (arraycountFlagsRows[y]==(parseInt(config.rows)) ) )
			   {
				   flag=0;
				   break;
			   }	   
			   
		   }
		   
		   for(var k=0; k<tflags.length; k++)
		   {
			   	   //e.g 6 rows that could be repeated as many as cols we have
				   if( (tflags[k]==x) && (arraycountFlagsCols[x]==(parseInt(config.cols)) ) )
				   {
					   flag=0;
					   break;
				   }
			}
		   if(flag==0)
			   return false;
		   else
		   {
			   for(var g=0; g<arrayforflagx.length; g++)
				   if(arrayforflagx[g]==y && arrayforflagy[g]==x)
					   return false;
				
			    lflags[counter1++]=y;
				tflags[counter2++]=x;
				arraycountFlagsRows[y]++;
				arraycountFlagsCols[x]++;
				arrayforflagx[a]=y;
				arrayforflagy[a++]=x;
				//do not forget to reinitialize all arrays for the new image.				
				return true;
		   }
		   
	   }
	  
	   



}(jQuery))


