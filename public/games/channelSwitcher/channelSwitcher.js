/* + * x * + * x * + * x * + * x * + * x * + * x

Channel Switcher 1.0.0

An app that will generate a prompt at intervals

x * + * x * + * x * + * x * + * x * + * x * + */
    



function ChannelSwitcher(game_index){

	var started=false;
	var intervals=30;
	var err="";

	var channelSwitcher_option="";

	var options_list = [
				{"Short":"Random","Full":"Random"},
				{"Short":"Noun","Full":"Noun"},
				{"Short":"AdjectiveNoun","Full":"Adjective + Noun"},
				{"Short":"Profession","Full":"Profession"},
				{"Short":"Phrase","Full":"Phrase"}];
	

	var $channelSwitcher = $('<div class="channelSwitcher_inner" id="channelSwitcher_inner_'+ game_index +'"></div>');

	// Add form elements, including an option list and a submit button
		var $form= $('<form id="channelSwitcher_form_'+ game_index +'"></form>');
			var $options= $('<select class="channelSwitcher_options" id="channelSwitcher_options_'+ game_index +'" ></select>');
				for ( var i=0 ; i<options_list.length ; i++ ){
					$options.append('<option value="' + options_list[i]["Short"] +'">' + options_list[i]["Full"] + '</option>');
				}
			$form.append($options);
			var $channelSwitcher_intervals='<div class="channelSwitcher_intervals"><label for="channelSwitcher_intervals_'+ game_index +'">Intervals </label><input type="text" size=4 maxlength=4 value='+intervals+' id="channelSwitcher_intervals_' + game_index + '" /> <span class="inseconds">(in seconds)</span> </div>';
			$form.append($channelSwitcher_intervals);
			var $channelSwitcher_varied= '<div class="channelSwitcher_varied"> <input type="checkbox" id="channelSwitcher_varied_' + game_index + '" /><label for="channelSwitcher_varied_' + game_index +'"> varied </label></div>'
			$form.append($channelSwitcher_varied);
			var $channelSwitcher_start = '<button class="channelSwitcher_start" id="channelSwitcher_start_'+ game_index +'" type="button">Start?</button>';
			var $channelSwitcher_stop = '<button class="channelSwitcher_stop" id="channelSwitcher_stop_'+ game_index +'" type="button">Stop!</button>';
			$form.append($channelSwitcher_start,$channelSwitcher_stop);
		$channelSwitcher.append($form);
		$channelSwitcher.append('<span class="channelSwitcher_answer" id="channelSwitcher_answer_'+ game_index +'"></span>')

		$('#channelSwitcher_' + game_index).append($channelSwitcher);
		$('#channelSwitcher_stop_' + game_index).hide();

	// When started, switch text to "stop"
	
		$('#channelSwitcher_start_'+ game_index).click(function(){
			$('#channelSwitcher_start_'+ game_index).hide();
			$('#channelSwitcher_stop_'+ game_index).show();
			started=true;
			switcher();
		});

	// When stopped return to default "start"

		$('#channelSwitcher_stop_'+ game_index).click(function(){
			$('#channelSwitcher_stop_'+ game_index).hide();
			$('#channelSwitcher_start_'+ game_index).show();
			started=false;
		});

	function switcher(){

			if(started===true){
				// while started, return a prompt at the intervals of the form

				channelSwitcher_option=$('#channelSwitcher_options_'+ game_index).val();
				$('#channelSwitcher_answer_'+ game_index).empty();

				//pull values from form
				intervals=$('#channelSwitcher_intervals_'+ game_index).val()*1000;
				varied=$('#channelSwitcher_varied_'+ game_index).val();

				//check user input
				if(typeof(intervals)!=="number" || isNaN(intervals)===true){
					err="Please enter a number";
				}else if(intervals<1000){
					err="Please enter a value over one";
				}else{
					err="";
				}

				//find random interval if varied selected
				if(varied===true){
					intervals=Math.floor((Math.random() * intervals)+1000);
				}
			
				// display output below
				//returnPrompt in common.js

				if(err===""){
					$('#channelSwitcher_answer_'+ game_index).append( returnPrompt( options_list, channelSwitcher_option ) );
				}else{
					$('#channelSwitcher_answer_'+ game_index).append( err );	
				}
				//Timeout until the next run.
				setTimeout(function () { switcher(); }, intervals);	
			}
	}


}


