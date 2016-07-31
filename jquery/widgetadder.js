//adds widgets to the page

//recieve list of active widgets
//*temporarly statically set*
var widget_list = ["Prompter","Channel Switcher","Channel Switcher"];
var widgets = [];

//add widgets

for (var i=0 ; i<widget_list.length ; i++){
	$("#widgets").append('<div class="widget" id="widget_' + i + '"><div class="widgetTitle" id="widgetTitle_' + i + '">' + widget_list[i] + '</div></div>');
	if (widget_list[i]=="Prompter"){
		widgets[i] = new Prompter(i);
	}
	if (widget_list[i]=="Channel Switcher"){
		widgets[i] = new ChannelSwitcher(i);
	}

}



