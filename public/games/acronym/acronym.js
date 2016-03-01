// Acronym 1.0
// A widget for the game Acronym.

function Acronym(game_index){

	var acronym_def_array = ["News Network","Old Lady Bowling League","Biker Gang","Farming Program","After School Program","Old Lady Biker Gang","Text Message Slang","Government Agency","Dog Training Business","Disease Treatment","Video Game","Celebrity Gossip Magazine","New Disease","Recycling Program","Boy Scout Badge","New Stealth Jet","New Tank","Nickname for your bicep","Book Club","Hair Removal Product","Fighting League","Mind Reading Device","Shrinking Machine","Teleporter","Extreme Sport","Rapper's new Album","Rapper","Latest Diet Fad","Sport Organization","Part of a Car","New Space Travel Organization","Country Band","Death Metal Band","Comic Book Crime Ring","New Cancer Treatment","New name for the USA","New Wireless Communication Technology","Method for Learning","Mnemonic for Life Advice","Mnemonic for Parental Advice","Mnemonic for Bad Advice"];

	var num_of_characters;
	var acronym_answer;
	var merged_words = $.merge(words["nouns"],words["professions"],words["adjectives"]);
	
	var $acronym = $('<div class="acronym_inner" id="acronym_inner_'+ game_index +'"></div>');

	// Add form elements
	
		$acronym.append('<div class="acronym_answer widget_answer" id="acronym_answer_'+ game_index +'"> ( Click for a new acronym ) </div>');
		$acronym.append('<div class="acronym_show_def"> <input type="checkbox" id="acronym_show_def_' + game_index + '" checked /><label for="acronym_show_def_' + game_index +'"> show definition</label></div>');

		$('#acronym_'+game_index).append($acronym);

	// Receive user input from acronym_form and pull a random acronym
	
		$('#acronym_answer_'+ game_index).click(function(){

			var temp="";

			// Make An Acronym
			// Random Number of Characters
			num_of_characters=Math.floor((Math.random() * 6)+3);

			// Get Prompt
			acronym_answer=randomFromArray(merged_words);

			// Strip of characters/cut down to correct length
			acronym_answer=acronym_answer.replace(/[^A-Za-z]/g, '');
			acronym_answer=acronym_answer.substring(0, num_of_characters).toUpperCase();

			// Maybe Randomize
			acronym_answer = Math.random() < 0.5 ? (acronym_answer.split('').sort(function(){return 0.5-Math.random()}).join('')) : acronym_answer;

			// Put in dots
			for(var i = 0; i < acronym_answer.length; i++) {
		       temp+=acronym_answer.charAt(i) + ".";
		    }
		    acronym_answer=temp;

			// Choose and Acronym Def, if needed

			if($('#acronym_show_def_'+ game_index).is(':checked')){

			// Flip a coin
				if(Math.random() < 0.6){
				//If it's less than .6 use acronym_def_array
				acronym_answer+=" - For " + aOrAn(randomFromArray(acronym_def_array));

				}else{
				//If it's more, use an "organization of" the profession array
				acronym_answer+=" - For an Organization of " + pluralize(randomFromArray(words["professions"]));
				}
			}

			//Print to screen
			$('#acronym_answer_'+ game_index).empty().append('<span>' + acronym_answer + '</span>');
	
		});


}


