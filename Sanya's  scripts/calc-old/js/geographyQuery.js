var geographyQuery = {
	
	init: function(){
		// По умолчанию россия
		$("select option:contains('РОССИЯ')").prop('selected', true).trigger('change');
		
		// select2
		var cSelect = $('select');
		if(cSelect.length >= 1){
			var params = {
				minimumResultsForSearch: 5
			};
			$('select').select2(params);
		}
		
		// kladr
		$('[data-kladr]').kladr({
			type: $.kladr.type.city,
			select: function(obj){
				var input = $(this).attr('data-kladr');
				
				$('#calc').attr('onsubmit', 'return false;');
				$('#calc [type="submit"]').html('Пожалуйста, подождите..');
				
				$.ajax({
					url: window.location.href,
					type: 'post',
					dataType: 'json',
					data: {'form': 'geographyQuery', 'query': obj.name+' '+obj.typeShort},
					success: function(json){
						$('#calc [type="submit"]').html('Расчитать');
						$('#calc').removeAttr('onsubmit');
						
						if(typeof json.error !== 'undefined'){
							alert(json.error);
							return false;
						}
						
						$('[name="'+input+'"]').val(json.code);
					},
					error: function(json){
						console.log(json);
						alert('Нет связи с API');
					}
				});
			}
		});
	},
	
	
}
$(function(){
	geographyQuery.init();
});