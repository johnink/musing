// Prompter 1.1
// An app to be added that will give you prompts for the games.

function Prompter(game_index){
	var options_list = [
				{"Short":"Random","Full":"Random"},
				{"Short":"Noun","Full":"Noun"},
				{"Short":"AdjectiveNoun","Full":"Adjective + Noun"},
				{"Short":"Phrase","Full":"Phrase"}];
	

	var $prompter = $('<div class="prompter'+ game_index +'"></div>');

	// Add form elements
		var $form= $('<form id="prompter_form'+ game_index +'"></form>');
			var $options= $('<select class="prompter_options" id="prompter_options'+ game_index +'" ></select>');
				for ( var i=0 ; i<options_list.length ; i++ ){
					$options.append('<option value="' + options_list[i]["Short"] +'">' + options_list[i]["Full"] + '</option>');
				}
			$form.append($options);
			$form.append('<button class="prompter_submit" id="prompter_submit'+ game_index +'" type="button">Prompt</button>');
		$prompter.append($form);
		$prompter.append('<span class="prompter_answer" id="prompter_answer'+ game_index +'"></span>')

		$('#widgets').append($prompter);
	// Receive user input from prompter_form.
	
		$('#prompter_submit'+ game_index).click(function(){
			// Based on prompter_options, gather data from objects, bring back arrays
			var prompter_option=$('#prompter_options'+ game_index).val();
			$('#prompter_answer'+ game_index).empty();
			


		// Display output below
		//returnPrompt in common.js
		$('#prompter_answer'+ game_index).append( returnPrompt( options_list, prompter_option ) );

	


	});
}


