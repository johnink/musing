// Prompter 1.1
// An app to be added that will give you prompts for the games.

function Prompter(game_index){
	var options_list = [
				{"Short":"Random","Full":"Random"},
				{"Short":"Noun","Full":"Noun"},
				{"Short":"AdjectiveNoun","Full":"Adjective + Noun"},
				{"Short":"Profession","Full":"Profession"},
				{"Short":"Phrase","Full":"Phrase"}];
	

	var $prompter = $('<div class="prompter" id="prompter_'+ game_index +'"></div>');

	// Add form elements, including an option list and a submit button
		var $form= $('<form id="prompter_form_'+ game_index +'"></form>');
			var $options= $('<select class="prompter_options" id="prompter_options_'+ game_index +'" ></select>');
				for ( var i=0 ; i<options_list.length ; i++ ){
					$options.append('<option value="' + options_list[i]["Short"] +'">' + options_list[i]["Full"] + '</option>');
				}
			$form.append($options);
			$form.append('<button class="prompter_submit" id="prompter_submit_'+ game_index +'" type="button">Prompt</button>');
		$prompter.append($form);
		$prompter.append('<span class="prompter_answer" id="prompter_answer_'+ game_index +'"></span>')

		$('#widget_'+game_index).append($prompter);

	// Receive user input from prompter_form and pull a random prompt with returnPrompt function
	
		$('#prompter_submit_'+ game_index).click(function(){
			// Pull option set in #prompter_options.
			var prompter_option=$('#prompter_options_'+ game_index).val();
			$('#prompter_answer_'+ game_index).empty();
			
			// Send option display output below
			//returnPrompt in common.js
			$('#prompter_answer_'+ game_index).append( returnPrompt( options_list, prompter_option ) );

	
		});


}


