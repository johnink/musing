//adds widgets to the page

//recieve list of active widgets
//*temporarly statically set*
var widget_list = makeWidgetsArray();
console.log(widget_list);
var widgets = [];

//add widgets

for (var i=0 ; i<widget_list.length ; i++){
	if (widget_list[i]=="prompter"){
		$('#Prompter_' + i).append( new Prompter(i) );
	}
	if (widget_list[i]=="channelSwitcher"){
		$('#ChannelSwitcher_' + i).append( new ChannelSwitcher(i) );
	}

}



