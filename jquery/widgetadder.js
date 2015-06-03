//adds widgets to the page

//recieve list of active widgets
//*temporarly statically set*
var widget_list = ["prompter","prompter"];
var widgets = [];

//add widgets

for (var i=0 ; i<widget_list.length ; i++){
	$("#widgets").append(widget_list[i]);
	if (widget_list[i]=="prompter"){
		widgets[i] = new Prompter(i);
	}

}



