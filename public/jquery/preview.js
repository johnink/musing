

function preview(){
	$form = $('form').serializeArray();
	$.post('preview', $form, function (newWindow) {
		console.log($form);
	    var win=window.open('about:blank');
	    with(win.document)
	    {
	      open();
	      write(newWindow);
	      close();
	    }
	});

}