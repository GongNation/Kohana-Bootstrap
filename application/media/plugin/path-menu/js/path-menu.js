// JavaScript Document
var PathMenuObj = function(classname,options){

	if(!options.DisableADV) //Have not finish
	//Disable Advanced Effects In IE7-8
		var DisableADV = 0;
	else DisableADV = options.DisableADV;
	
	// AppendTo a element
	if(!options.AppendTo)
		var AppendTo = 'body';
	else AppendTo = options.AppendTo;
	
	if(!options.PathPosition)
	//Positon And Size
		var PathPosition = {position:'fixed',right:100,top:100,width:104,height:104};
	else PathPosition = options.PathPosition;
	
	if(!options.Path)
	//1,2,3,4 For Upper-right, Lower-right, Lower-left, Upper-left
		var Path = 3;
	else Path = options.Path;
	
	if(!options.Radius)
	//Path Radius
		var Radius = 300;
	else Radius = options.Radius;
	
	if(!options.OutSpeed )
	//Pop-up, Initial Speed, Smaller Is Faster
		var OutSpeed = 80;
	else OutSpeed = options.OutSpeed;
	
	if(!options.OutIncr)
	//Pop-up, Rate Of Increase
		var OutIncr = 50;
	else OutIncr= options.OutIncr;
	
	if(!options.InSpeed )
	//Restoration, Initial Speed
		var InSpeed = 480;
	else InSpeed = options.InSpeed;
	
	if(!options.InIncr )
	//Restoration, Rate Of Increase
		var InIncr = -80;
	else InIncr = options.InIncr;
	
	if(!options.Offset)
	//Rebound Pixel
		var Offset = 40;
	else Offset = options.Offset;
	
	if(!options.OffsetSpeed)
	//Rebound Speed
		var OffsetSpeed = 200;
	else OffsetSpeed = options.OffsetSpeed;
	
	if(!options.ICount)
	//Item Count
		var ICount = 5;
	else ICount = options.ICount;
	
	if(!options.Button)
	//Default Button, Format：{'bg':'(option)','css':'(option)','cover':'(option)'};
		var Button = {'bg':'','css':{width:104,height:104},'cover':''};	
	else Button = options.Button;
	
	if(!options.mainButton)
	//Main Button
		var mainButton = [
			//Normal
			{'bg':'','css':'','cover':'','html':'<span class="cover"></span>'},
			//After Pop-up
			{'bg':'','css':'','cover':'','html':'','angle':-405,'speed':200}
		];
	else mainButton = options.mainButton;
	
	if(!options.itemButtons)
	//Item Button
		var itemButtons = [
			{'bg':'','css':'','cover':'','href':'#','target':''},
			{'bg':'','css':'','cover':'','href':'#','target':''},
			{'bg':'','css':'','cover':'','href':'#','target':''},
			{'bg':'','css':'','cover':'','href':'#','target':''},
			{'bg':'','css':'','cover':'','href':'#','target':''},
			{'bg':'','css':'','cover':'','href':'#','target':''}
			//......
		];	
	else itemButtons = options.itemButtons;
	//All Configuration Done
	
	
	//Begin Generate Buttons
	var str='<div class="PathMain"><div class="main"><div class="rotate"><img></div></div></div>';
	for(i=0;i<ICount;i++){
		//str	+= '<div class="PathItem"><a class="path-link"><span class="item"></span></a></div>';
		str	+= '<div class="PathItem"><a class="path-link"></a></div>';
	}
	var PathMenu = $(str);
	var PathStatus = 0;
		
	PathMenu.children().each(function(ID){
		//Given Default Data
		if(Button['bg']!='') $(this).css('background-image',"url("+Button['bg']+")")
		if(Button['css']!='')  $(this).css(Button['css']);
		//if(Button['cover']!='') $(this).children().css('background-image','url('+Button['cover']+')');
		
		//Main
		if($(this).hasClass('main')){
			if(mainButton[0]['bg']!='') $(this).css('background-image','url('+mainButton[0]['bg']+')')
			if(mainButton[0]['css']!='') $(this).css(mainButton[0]['css']);
			if(mainButton[0]['cover']!='') $(this).children().children().attr('src',mainButton[0]['cover']);
			if(mainButton[0]['html']!='') $(this).children().html(mainButton[0]['html']);
			$(this).click(function(){PathRun(PathMenu)});
		}
		//Item
		else if ($(this).hasClass('path-link')){
			var ItemID = $(PathMenu).filter('.PathItem').children().index($(this));
			if(itemButtons[ItemID]['bg']!='') $(this).css('background-image','url('+itemButtons[ItemID]['bg']+')');
			if(itemButtons[ItemID]['css']!='') $(this).css(itemButtons[ItemID]['css']);
			//if(itemButtons[ItemID]['cover']!='') $(this).children().css('background-image','url('+itemButtons[ItemID]['cover']+')');
			if(itemButtons[ItemID]['cover']!='') $(this).html(itemButtons[ItemID]['cover']);
			if(itemButtons[ItemID]['href']!='') $(this).attr({'href':itemButtons[ItemID]['href']});
			if(itemButtons[ItemID]['target']!='') $(this).attr({'target':itemButtons[ItemID]['target']});
			
			//Bind Click For Item
			$(this).click(function(){ItemClick($(this));});
		}
	});
	
	function ItemClick(obj){
		if(mainButton[1]['angle']){
			$(PathMenu.filter('.PathMain').find('.rotate')).animate({rotate:0},mainButton[1]['speed']);
		} 	
		$(obj).animate({scale:[4,4],opacity:0},400);
		var Ch = $(PathMenu).filter('.PathItem').children();
		$(Ch.not(obj)).animate({scale:[0,0],opacity:0},400,'swing');
		$(Ch.not(obj)).children().animate({rotate:0},400,'swing',function(){
			Ch.parent().animate({left:0,bottom:0},0);
			Ch.animate({opacity:1,scale:[1,1]},0);
			$(obj).children().animate({rotate:0},0);
			PathStatus = 0;
		});
		
		
	}
	
	//Sort And Run
	var angle = Math.PI/((ICount-1)*2);	
		
	function PathRun(PathMenu){
		var PathItems = PathMenu.filter('.PathItem').slice(0,ICount);
		if(PathStatus == 0){
			var Count = PathItems.size();
			PathItems.each(function(SP){
				var ID = $(this).index(); //Begin with 1
				if (ID == 1) {
					var X = Radius;
					var Y = 0; 
					var X1 = X + Offset;
					var Y1 = Y;
				
				}
				else if (ID == Count){
					var X = 0;
					var Y = Radius;
					var X1 = X;
					var Y1 = Y + Offset;
					
				}
				else {
					var X = Math.cos(angle * (ID - 1)) * Radius;
					var Y = Math.sin(angle * (ID - 1)) * Radius;
					var X1 = X + Offset;
					var Y1 = Y + Offset;
				}
				
				if(Path==2){Y=-Y;Y1=-Y1}
				else if(Path==3){X=-X;Y=-Y;X1=-X1;Y1=-Y1}
				else if(Path==4){X=-X;X1=-X1}

				
				$(this).children().children().animate({rotate:720},600);
				
				$(this).animate({left:X1,bottom:Y1},OutSpeed+SP*OutIncr,function(){
						$(this).animate({left:X,bottom:Y},OffsetSpeed);
				});	


			});
			
 			if(mainButton[1]['angle']){
				$(PathMenu.filter('.PathMain').find('.rotate')).animate({rotate:mainButton[1]['angle']},mainButton[1]['speed']);
			} 
			if(mainButton[1]['bg']!='') $(this).children().css('background-image','url('+mainButton[1]['bg']+')')
			if(mainButton[1]['css']!='') $(this).children().css(mainButton[1]['css']);
			if(mainButton[1]['cover']!='') $(this).children().children().css('background-image','url('+mainButton[1]['cover']+')');
			if(mainButton[1]['html']!='') $(this).children().html(mainButton[1]['html']);
			
			PathStatus = 1;
		}
		else if(PathStatus == 1){
			PathItems.each(function(SP){
				if(parseInt($(this).css('left'))==0) {X1 = 0;}
				else {
					if(Path <=2)
						X1 = parseInt($(this).css('left')) + Offset;
					else if(Path >=3)
						X1 = parseInt($(this).css('left')) - Offset;
				}
				
				if(parseInt($(this).css('bottom'))==0) {Y1 = 0}
				else {
					if(Path==3 || Path==2)
						Y1 = parseInt($(this).css('bottom')) - Offset;
					else if(Path ==1 || Path == 4)
						Y1 = parseInt($(this).css('bottom')) + Offset;
				}
				$(this).children().children().animate({rotate:0},600);
	
				$(this).animate({left:X1,bottom:Y1},OffsetSpeed,function(){
					$(this).animate({left:0,bottom:0},InSpeed+SP*InIncr);
					
				});
				

			});
			
 			if(mainButton[1]['angle']){
				$(PathMenu.filter('.PathMain').find('.rotate')).animate({rotate:0},mainButton[1]['speed']);
			} 		
			
			if(mainButton[0]['bg']!='') $(this).children().css('background-image','url('+mainButton[0]['bg']+')')
			if(mainButton[0]['css']!='') $(this).children().css(mainButton[0]['css']);
			if(mainButton[0]['cover']!='') $(this).children().children().css('background-image','url('+mainButton[0]['cover']+')');
			if(mainButton[0]['html']!='') $(this).children().html(mainButton[0]['html']);
			
			
			PathStatus = 0;
		}
		
	}
	
	var PathMenuA = $('<div class="PathMenu '+classname+'"><div class="PathInner"></div></div>');
	PathMenuA.filter('.PathMenu').css(PathPosition);
	PathMenuA.children().css({'width':PathPosition['width'],'height':PathPosition['height'], 'z-index':1050});
	PathMenu.appendTo(PathMenuA.children());
	PathMenuA.appendTo($(AppendTo));
}
