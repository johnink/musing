/* + * x * + * x * + * x * + * x * + * x * + * x

Open the avatar select dialog

x * + * x * + * x * + * x * + * x * + * x * + */
    
function openAvatarSelect(){
	$(".avatarImg").css("width",90).animate({width:"120px"},500);
	$("#avatar" + $("#hidden_avatar").val()).addClass("selected");
	$(".avatarChooserWrap").fadeIn(500,"easeInOutQuart").css("display","table");
}

/* + * x * + * x * + * x * + * x * + * x * + * x

Close the avatar select dialog

x * + * x * + * x * + * x * + * x * + * x * + */
    
function closeAvatarSelect(option){

	//change selected avatar
	var token = $('#token').val();
	$(".selected").removeClass("selected");
	$("#avatar" + option).addClass("selected");

	//change hidden avatar field

	$("#hidden_avatar").val(option);

	//update the database
	$.ajax({
		url: '/auth/avatar',
		type: 'post',
		data: {avatar: option , _token :token},
		success: function(){
			console.log("Avatar Updated");
		}
	}).fail(function(){
		console.log("Avatar failed");
	});

	//change the avatar image
	if(option>0&&option<=4){
		$(".avatar").css("background-image","url('/images/avatars/" + option + ".jpg')");
	}else{
		$(".avatar").css("background-image","url('http://www.gravatar.com/avatar/0?size=200')");
		getGravitar();
	}

	//fade the fuck out
	$(".avatarImg").animate({width:"150px"},500);
	$(".avatarChooserWrap").fadeOut(500,"easeInOutQuart");

}

/* + * x * + * x * + * x * + * x * + * x * + * x

Find Gravitar

x * + * x * + * x * + * x * + * x * + * x * + */

function getGravitar(){
	if($("#hidden_avatar").val()>4){
			var emailHash = $.md5($("#email").val());
			$(".avatar").css("background-image","url('http://www.gravatar.com/avatar/" + emailHash + "?size=200')");
		}
}

/* + * x * + * x * + * x * + * x * + * x * + * x

Load Gravitar when email field unfocused

x * + * x * + * x * + * x * + * x * + * x * + */

$("#email").blur(function(){getGravitar()});


/* + * x * + * x * + * x * + * x * + * x * + * x

http:// website on unfocus

x * + * x * + * x * + * x * + * x * + * x * + */

$("#website").blur(function(){
	var current_website = $("#website").val();
	if(current_website!="" && !current_website.match("^http")){
		$("#website").val("http://" + current_website);
	}

});












