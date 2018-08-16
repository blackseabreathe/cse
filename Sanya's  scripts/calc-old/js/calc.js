var calc = {
	
	init: function(){
		$(document).on('keyup', '[name="length"], [name="width"], [name="height"]', function(){
			calc.VolumeWeight();
		});
		$(document).on('change', 'select', function(){
			calc.select_value();
			
			// Подгрузка городов
			if($(this).attr('data-geography')) calc.geography($(this));
		})
	},
	
	select_value: function(){
		$('select').each(function(){
			var name = $(this).attr('name')+'_value';
			if($('[name="'+name+'"]').length == 0) $(this).after('<input type="hidden" name="'+name+'">');
			$('[name="'+name+'"]').val($(this).find('option:selected').text());
		});
	},
	
	VolumeWeight: function(){
		var q = parseFloat($('[name="length"]').val()),
			w = parseFloat($('[name="width"]').val()),
			e = parseFloat($('[name="height"]').val());
		if(q > 0 && w > 0 && e > 0){
			var result = (q*w*e)/5000;
			$('[name="VolumeWeight"]').val(result);
		}else{
			$('[name="VolumeWeight"]').val('0');
		}
	},
	
	geography: function(elem){
		var id_geography = elem.val(),
			list_geography = $('[name="'+elem.attr('data-geography')+'"]');
		
		list_geography.after('<div class="m-t-1 preloader">Загрузка..</div>');
		
		$.ajax({
			url: window.location.href,
			type: 'post',
			dataType: 'html',
			data: {'form': 'geography', 'ID': id_geography},
			success: function(options){
				list_geography
					.html(options)
					.show();
				if(options == '') list_geography.hide();
				$('.preloader').remove();
				calc.select_value();
			}
		});
	}
	
}
$(function(){
	calc.init();
});