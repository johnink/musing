//adds widgets to the page

//recieve list of active widgets

var users_widgets = makeWidgetsArray();
var token = $('#token').val();
$.getJSON('/widget/',function(available_widgets){

//add widgets

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

	}

});



function Widget_Controls(i,tot,name){
	/*
	*  Add controls to widgets
	*/

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

//when controls up button is pressed

function upbutton(i){
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

//when controls down button is pressed

function downbutton(i){
	//Play swap animation first for responsiveness.
	//We run the risk of AJAX failing and them not switching in the database.
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

function addbutton(i){
	$addMenu = '<div class="addMenu" id="addmenu_' + i + '" style="background-color:red; width:550px; height:550px; position:\'fixed\'">poop</div>'
	$('widget_controls_' + i).append($addMenu);
}

//when controls delete button is pressed

function subbutton(i){

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
					width: "toggle"
				},500,"easeInElastic").remove();
			}
		}).fail(function(){
			console.log("Delete failed")
    	});
	}
}

function swapAnimation(i){
	if(i>0 && i<users_widgets.length){

		var animating= false;
		var newi=i-1;

		//Animate DIVs switching places if AJAX successful
		if (animating) {return;}

		var selWid = $('#' + users_widgets[i] + '_' + i),
			prevWid = selWid.prev(),
			distance = selWid.outerHeight()+25;
			distance2= prevWid.outerHeight()+25;

		if (prevWid.length){
			animating = true;
			$.when(selWid.animate({
		    top: -distance
			}, 200, 'easeOutBack')

			,
			prevWid.animate({
		    top: distance2
			}, 200, 'easeOutBack')).done(function () {
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
















