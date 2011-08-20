(function( $ ){
	$.fn.wittieLoad = function(url, method) {
		$this = this;
		if(!method) method = 'get';
		$.ajax({
			type: method.toUpperCase(),
			url: url,
			data: {},
			dataType: 'json',
			success: function(data, textStatus, jqXHR)
			{
				if(data['reload'])
					window.location.reload();
				if(data['content'])
					$this.html(data['content']);
				if(data['width'])
					$this.dialog('option', 'width', data['width'] );
				if(data['form'])
					$this.dialog('option','buttons',{
						'save': function(){
							var $form = $this.find('form');
							$.ajax({
								type: $form.attr('method').toUpperCase(),
								url: $form.attr('action'),
								data: $form.serialize(),
								dataType: 'json',
								success: function(data, textStatus, jqXHR)
								{
									if(data['content'])
										$this.html(data['content']);
									if(data['reload'])
										window.location.reload();
								},
								error: function(jqXHR, textStatus, errorThrown)
								{
									$this.html('An error has occured.');
								}
							});
						}
					});
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				$this.html('An error has occured.');
			}
		});
		return this;
	};
})( jQuery );

$(document).ready(function(){
	var $loading = $('<img src="/images/loading.gif" alt="loading">');
	
	$('a[wittie=dialog]').each(function() {
		var $link = $(this);
		$link.click(function(event) {
			event.preventDefault();
			
			var wd = $link.attr('wittie-data');
			if(wd) wd = $.parseJSON(wd);
			
			var data = {
				title: $link.attr('title'),
				modal: true,
				close: function(){ $(this).dialog('destroy'); }
			};
			
			if(wd && wd['width']) data['width'] = wd['width'];
			if(wd && wd['height']) data['height'] = wd['height'];
			
			var $dialog = $('<div></div>')
				.append($loading.clone())
				.dialog(data)
				.wittieLoad($link.attr('href'));
			
			return false;
		});
	});
	
	$('a[wittie=reload]').each(function() {
		var $link = $(this);
		$link.click(function(event) {
			//event.preventDefault();
			
			
			
			//return false;
		});
	});
});
