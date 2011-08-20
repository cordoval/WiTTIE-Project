$(document).ready(function() {
	var left = 0;
	$('#help-panel').position({
		of: window,
		my: 'center',
		at: 'center',
		colision: 'fit',
		using: function(pos) {
			$(this).css('top', pos.top);
			left = pos.left;
		}
	});
	
	function helpIn(event)
	{
		console.log('in');
		event.preventDefault();
		$('#help-panel').addClass('open').animate({ left: left }, 1500);
	}
	function helpOut(event)
	{
		console.log('out');
		event.preventDefault();
		$('#help-panel').removeClass('open').animate({ left: -720 }, 1500);
		return false;
	}
	
	$('a#help').toggle(helpIn,helpOut);
});
