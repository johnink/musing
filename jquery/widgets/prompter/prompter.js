// An app to be added that will give you prompts for the games.

function Prompter(game_index){
	var $prompter = $('<div class="prompter'+ game_index +'"></div>');
	var options = ["Random","Noun"];
	
	// Add form elements
		var $form= $('<form id="prompter_form'+ game_index +'"></form>');
			var $options= $('<select id="prompter_options'+ game_index +'"></select>');
				for ( var i=0 ; i>options.length ; i++ ){
					$options.append('<option value="' + options[i] + game_index +'">' + options[i] + '</option>');
				}
			$form.append($options);
			$form.append('<button id="prompter_submit'+ game_index +'" type="button">Prompt</button>');
		$prompter.append($form);
		$prompter.append('<span id="prompter_answer'+ game_index +'"></span>')

		$('#widgets').append($prompter);
	// Receive user input from prompter_form.
	
		$('#prompter_submit'+ game_index).click(function(){
			// Based on prompter_options, gather data from form, bring back arrays
			var prompter_option=$('#prompter_options'+ game_index).val();
			$('#prompter_answer'+ game_index).empty();
			

			//If choice is random, start by picking a random choice.


		// Pull random from from arrays

		// Display output below
		$('#prompter_answer'+ game_index).append(prompter_option);


	});
}

//var widgets = new Prompter();

