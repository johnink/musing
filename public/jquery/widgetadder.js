/* + * x * + * x * + * x * + * x * + * x * + * x

widgetadder.js

PHP adds the divs for the users widgets. This
script is responsible for populating those
widget divs with the correct game.

Widgets are the personalized divs on the users
homepage.

Games refer to the actual app running in said
div. Perhaps in the future, differentate games
and apps.

x * + * x * + * x * + * x * + * x * + * x * + */
    


var MAX_WIDGETS = $('#max').val();

var users_widgets = makeWidgetsArray();
var token = $('#token').val();
var addMenuOpen = false;
var available_widgets=[];
$.getJSON('/widget/',function(results){
//add widgets
	available_widgets=results;
	for (var i=0 ; i<users_widgets.length ; i++){

		$.each(available_widgets,function(index,value){
			if(users_widgets[i]==value['name']){

				//For the div #widgetname_1, add the appropriate game to
				//the widget div.
				$('#' + value['name'] +'_' + i).append( newWidget(value['name'], i) );

				//If #widget_controls_1 exists, add widget controls
				if($('#widget_controls_' + i).length){
					$('#widget_controls_' + i).append(new Widget_Controls(i,users_widgets.length-1, value['name']));
				}

			}
		});
		if(users_widgets.length>=MAX_WIDGETS){$('.widget_add').animate({'opacity':.5});}

	}
	adjustPrimary();
});


/* + * x * + * x * + * x * + * x * + * x * + * x

Widget_Controls

If the user is logged in, there is a div for
widget controls. This function populates
that div.

x * + * x * + * x * + * x * + * x * + * x * + */
    

function Widget_Controls(i,tot,name){

	var $widget_controls=$('<span></span>');
	//push up button
	if(i>0){
		var $up = $('<span class="widget_up" id="widget_up_'+ i +'" onClick="upbutton('+ i +')">^</span>');
		}

	//push down button
	if(i!=tot){
		var $down = $('<span class="widget_down" id="widget_down_'+ i +'" onClick="downbutton('+ i +')">v</span>');
		}

	//add new button
	var $add = $('<span class="widget_add" id="widget_add_'+ i +'" onClick="addbutton('+ i +')">+</span>');

	//delete button
	var $sub = $('<span class="widget_sub" id="widget_sub_'+ i +'" onClick="subbutton('+ i +')">x</span>');

	//append to dashboard
	$widget_controls.append($up,$down,$add,$sub);
	$('#widget_controls_' + i).append($widget_controls);

}

/* + * x * + * x * + * x * + * x * + * x * + * x

upbutton(), downbutton(), addbutton(), subbutton

These are the individual button click behaviors 
for Widget_Controls()

x * + * x * + * x * + * x * + * x * + * x * + */


//when controls up button is pressed

function upbutton(i){
	if(addMenuOpen!=true){
		//Play swap animation first for responsiveness.
		//We run the risk of AJAX failing and them not switching in the database.
		swapAnimation(i);
		//AJAX to server so it makes moves in the database
		$.ajax({
				url: '/widget/up/' + i,
				type: 'post',
				data: {_token :token}
			}
		).fail(function(){
		console.log("Swap failed")
	    });
	}    
}

//when controls down button is pressed

function downbutton(i){
	//Play swap animation first for responsiveness.
	//We run the risk of AJAX failing and them not switching in the database.
	if(addMenuOpen!=true){
		swapAnimation(i+1);
		//AJAX to server so it makes moves in the database
		$.ajax({
				url: '/widget/down/' + i,
				type: 'post',
				data: {_token :token}
			}).fail(function(){
			console.log("Swap failed")
	    });
	}
}

//when controls add button is pressed

function addbutton(i){

	if(addMenuOpen === false && users_widgets.length<MAX_WIDGETS){
		addMenuOpen = true;
		$('.widget_controls span').animate({'opacity':.5},'slow');
		var $addMenu = $('<div class="addMenu" id="addmenu_' + i + '"></div>');
		var $addMenuCloseButton = $('<span class= "addMenuCloseButton" id ="addMenuCloseButton_' + i + '" >x</span>');
		var $addMenuGameUL=$('<ul></ul>');
		var $addMenuNewGame=$('<a href="/gamelist/widgets/" class="addMenuNewGame">Get a new widget</a>');
		$.each(available_widgets,function(index,value){
			$addMenuGameUL.append('<li onClick="storeWidget(\'' + value['name'] + '\',\'' + value['full_name'] + '\',' + i + ')">' + value['full_name'] + '</li>');
		});
		$addMenu.append($addMenuCloseButton,$addMenuGameUL,$addMenuNewGame).hide();
		
		$('#widget_controls_' + i).append($addMenu);
		$addMenu.slideDown(200,'easeOutBounce');

		//the logic to close the menu.
		$addMenuCloseButton.click(function(){
			$addMenu.slideUp(200,'easeOutBounce',function(){$addMenu.remove();});
			addMenuOpen = false;
			$('.widget_controls span').animate({'opacity':1});
		});
	}
}

//when controls delete button is pressed

function subbutton(i){
	if(addMenuOpen!=true){

		var selWid = $('#' + users_widgets[i] + '_' + i);

		if (confirm('Delete this widget?')){
			$.ajax({
				url: '/widget/' + i,
				type: 'post',
				data: {_method: 'delete' , _token :token},
				success: function(){

					selWid.animate({
						opacity: "toggle",
						height: "toggle",
						width: "-=20"
					},500,"easeOutExpo",function(){
						selWid.attr("id","delete").empty();
						shifter(i+1,-1);
						selWid.remove();
						users_widgets = makeWidgetsArray();
						if(users_widgets.length<MAX_WIDGETS){$('.widget_add').animate({'opacity':1});}
					});

				}
			}).fail(function(){
				console.log("Delete failed")
	    	});
		}
	}
}


/* + * x * + * x * + * x * + * x * + * x * + * x

swapAnimation()

The animation of the widgets swapping, and all
the divs attributes correcting themselves to 
fit.

x * + * x * + * x * + * x * + * x * + * x * + */


function swapAnimation(i){
	if(i>0 && i<users_widgets.length){

		var animating= false;
		var newi=i-1;

		//Animate DIVs switching places if AJAX successful
		if (animating) {return;}

		var selWid = $('#' + users_widgets[i] + '_' + i),
			prevWid = selWid.prev(),
			distance = prevWid.height();
			distance2= selWid.height();//prevWid.outerHeight()+55;

		if (prevWid.length){
			animating = true;
			$.when(selWid.animate({
		    top: -distance
			}, 450, 'easeOutElastic')

			,
			prevWid.animate({
		    top: distance2
			}, 450, 'easeOutElastic')).done(function () {
			    prevWid.css('top', '0px');
			    selWid.css('top', '0px');
			    selWid.attr('id',selWid.attr('class') + '_' + newi).insertBefore(prevWid);
			    prevWid.attr('id',prevWid.attr('class') + '_' + i);

			    //they're swapped. Now fix all the attributes.
			    users_widgets = makeWidgetsArray();
			    selWid.children('.widget_controls')
			    	.attr('id','widget_controls_' + newi)
			    	.empty().append( new Widget_Controls( newi , users_widgets.length-1, selWid.attr('class') ) );
			    selWid.children('.' + selWid.attr('class') + '_inner').replaceWith( newWidget( selWid.attr('class'),newi ) );


			    prevWid.children('.widget_controls')
			    	.attr('id','widget_controls_' + i)
			    	.empty().append( new Widget_Controls( i , users_widgets.length-1, prevWid.attr('class') ) );
			    prevWid.children('.' + prevWid.attr('class') + '_inner').replaceWith( newWidget( prevWid.attr('class'),i ) );



		    animating = false;
			});
		}

	}
}

/* + * x * + * x * + * x * + * x * + * x * + * x

storeWidget()

The function for adding a new widget for a user
and the animation if a user is on the homepage.

x * + * x * + * x * + * x * + * x * + * x * + */

function storeWidget(gamename, fullgamename, i, animation){

	//set the optional value.
	if (typeof animation === "undefined" || animation === null) { 
    	animation = true; 
  	}
  	
	$.ajax({
		url: '/widget',
		type: 'post',
		data: { _method :'post', _token :token, widget_num :i, game_name :gamename },
		success: function(){
			if(animation===true){
				$('addmenu').remove();
				shifter(i,1);//shift widgets down by one
				if(i>0){
					$('#' + users_widgets[i-1] + '_' + (i-1)).after('<div class="' + gamename + '" id="' + gamename + '_' + i + '" style="position:relative;"><h5><a href="/game/' + gamename + '">' + fullgamename + '</a></h5><div class="widget_controls" id="widget_controls_' + i + '"></div></div>');
				}else{
					$('#' + users_widgets[i] + '_' + (i+1)).before('<div class="' + gamename + '" id="' + gamename + '_' + i + '" style="position:relative;"><h5><a href="/game/' + gamename + '">' + fullgamename + '</a></h5><div class="widget_controls" id="widget_controls_' + i + '"></div></div>');

				}
				widget=$('#' + gamename +'_' + i);
				widget.hide();
				//For the div #widgetname_1, add the appropriate game to
				//the widget div.
				widget.append( newWidget(gamename, i) );
				widget.slideDown(300,'easeOutExpo',adjustPrimary());
				users_widgets = makeWidgetsArray();
				$('#widget_controls_' + i).append(new Widget_Controls(i,users_widgets.length-1, gamename));
				addMenuOpen = false;
				$('.widget_controls span').animate({'opacity':1});

				users_widgets = makeWidgetsArray();
				if(users_widgets.length>=MAX_WIDGETS){
					$('.widget_add').animate({'opacity':.5});
					flagAlert("You've reached the maximum number of " + MAX_WIDGETS + " widgets.", '#widget_controls_' + i);
				}

			}
		}
	}).fail(function(){
		console.log("Add failed");
	});

}

/* + * x * + * x * + * x * + * x * + * x * + * x

shifter()

shifts the other widgets up or down

x * + * x * + * x * + * x * + * x * + * x * + */

function shifter(i,mod){
	users_widgets = makeWidgetsArray();
    var newi=0;
    for(index=i; index<=users_widgets.length-1 ; index++){

    	newi = index + mod;
    	var selWid = $('#' + users_widgets[index] + '_' + index);
    	//while incrementing, you'll sometimes end up with two widgets with the same id. Check for that to make sure
    	//we don't grab the same one twice.
    	if(selWid.attr('id') == selWid.next().attr('id') && mod>-1){
    		selWid=selWid.next();
    	}
    	selWid.attr('id',selWid.attr('class') + '_' + newi);
	    selWid.children('.widget_controls')
	    	.attr('id','widget_controls_' + newi)
	    	.empty().append( new Widget_Controls( newi , users_widgets.length - 1 + mod, selWid.attr('class') ) );
	    selWid.children('.' + selWid.attr('class') + '_inner').replaceWith( newWidget( selWid.attr('class'),newi ) );
	}
	adjustPrimary();

}














