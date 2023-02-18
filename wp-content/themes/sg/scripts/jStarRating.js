// Rating
(function(jQuery, window, document, undefined){

	jQuery.fn.kkstarratings = function(options)
	{
		jQuery.fn.kkstarratings.options = jQuery.extend({
			ajaxurl   : 'http:\/\/sparfuchs-gutschein.de\/wp-admin\/admin-ajax.php',
			func      : 'kksr_ajax',
			grs       : false,
			msg       : 'Shop bewerten.',
			fuelspeed : 400,
			thankyou  : 'Danke für Ihre Bewertung!',
			error_msg : 'Ups. Beim Bewerten gab es einen Fehler.',
			tooltip   : true,
			tooltips  : {
				0 : {
					tip   : "Gefällt mir nicht!"
				},
				1 : {
					tip   : "Nicht so gut!"
				},
				2 : {
					tip   : "Ok!"
				},
				3 : {
					tip   : "Gut!"
				},
				4 : {
					tip   : "Gefällt mir!"
				}
			}
		}, jQuery.fn.kkstarratings.options, options ? options : {});

		var Objs = [];
		this.each(function(){
			Objs.push(jQuery(this));
		});

		jQuery.fn.kkstarratings.fetch(Objs, 0, '0%', jQuery.fn.kkstarratings.options.msg, true);

		return this.each(function(){});

    };

	jQuery.fn.kkstarratings.animate = function(obj)
	{
		if(!obj.hasClass('disabled'))
		{
			var legend = jQuery('.kksr-legend', obj).html(),
				fuel = jQuery('.kksr-fuel', obj).css('width');
			jQuery('.kksr-stars a', obj).hover( function(){
				var stars = jQuery(this).attr('href').split('#')[1];
				if(jQuery.fn.kkstarratings.options.tooltip!=0)
				{
					if(jQuery.fn.kkstarratings.options.tooltips[stars-1]!=null)
					{
						jQuery('.kksr-legend', obj).html('<span style="color:'+jQuery.fn.kkstarratings.options.tooltips[stars-1].color+'">'+jQuery.fn.kkstarratings.options.tooltips[stars-1].tip+'</span>');
					}
					else
					{
						jQuery('.kksr-legend', obj).html(legend);
					}
				}
				jQuery('.kksr-fuel', obj).stop(true,true).css('width', '0%');
				jQuery('.kksr-stars a', obj).each(function(index, element) {
					var a = jQuery(this),
						s = a.attr('href').split('#')[1];
					if(parseInt(s)<=parseInt(stars))
					{
						jQuery('.kksr-stars a', obj).stop(true, true);
						a.hide().addClass('kksr-star').addClass('orange').fadeIn('fast');
					}
				});
			}, function(){
				jQuery('.kksr-stars a', obj).removeClass('kksr-star').removeClass('orange');
				if(jQuery.fn.kkstarratings.options.tooltip!=0) jQuery('.kksr-legend', obj).html(legend);
				jQuery('.kksr-fuel', obj).stop(true,true).animate({'width':fuel}, jQuery.fn.kkstarratings.options.fuelspeed);
			}).unbind('click').click( function(){
				return jQuery.fn.kkstarratings.click(obj, jQuery(this).attr('href').split('#')[1]);
			});
		}
		else
		{
			jQuery('.kksr-stars a', obj).unbind('click').click( function(){ return false; });
		}
	};

	jQuery.fn.kkstarratings.update = function(obj, per, legend, disable, is_fetch)
	{
		if(disable=='true')
		{
			jQuery('.kksr-fuel', obj).removeClass('yellow').addClass('orange');
		}
		jQuery('.kksr-fuel', obj).stop(true, true).animate({'width':per}, jQuery.fn.kkstarratings.options.fuelspeed, 'linear', function(){
			if(disable=='true')
			{
				obj.addClass('disabled');
				jQuery('.kksr-stars a', obj).unbind('hover');
			}
			if(!jQuery.fn.kkstarratings.options.grs || !is_fetch)
			{
				jQuery('.kksr-legend', obj).stop(true,true).hide().html(legend?legend:jQuery.fn.kkstarratings.options.msg).fadeIn('slow', function(){
					jQuery.fn.kkstarratings.animate(obj);
				});
			}
			else
			{
				jQuery.fn.kkstarratings.animate(obj);
			}
		});
	};

	jQuery.fn.kkstarratings.click = function(obj, stars)
	{
		jQuery('.kksr-stars a', obj).unbind('hover').unbind('click').removeClass('kksr-star').removeClass('orange').click( function(){ return false; });
		
		var legend = jQuery('.kksr-legend', obj).html(),
			fuel = jQuery('.kksr-fuel', obj).css('width');
		
		jQuery.fn.kkstarratings.fetch(obj, stars, fuel, legend, false);
		
		return false;
	};

	jQuery.fn.kkstarratings.fetch = function(obj, stars, fallback_fuel, fallback_legend, is_fetch)
	{
		var postids = [];
		jQuery.each(obj, function(){
			postids.push(jQuery(this).attr('data-id'));
		});
		jQuery.ajax({
			url: jQuery.fn.kkstarratings.options.ajaxurl,
			data: 'action='+jQuery.fn.kkstarratings.options.func+'&id='+postids+'&stars='+stars+'&_wpnonce='+jQuery.fn.kkstarratings.options.nonce,
			type: "post",
			dataType: "json",
			beforeSend: function(){
				jQuery('.kksr-fuel', obj).animate({'width':'0%'}, jQuery.fn.kkstarratings.options.fuelspeed);
				if(stars)
				{
					jQuery('.kksr-legend', obj).fadeOut('fast', function(){
						jQuery('.kksr-legend', obj).html('<span style="color: green">'+jQuery.fn.kkstarratings.options.thankyou+'</span>');
					}).fadeIn('slow');
				}
			},
			success: function(response){
				jQuery.each(obj, function(){
					var current = jQuery(this),
						current_id = current.attr('data-id');
					if(response[current_id].success)
					{
						jQuery.fn.kkstarratings.update(current, response[current_id].fuel+'%', response[current_id].legend, response[current_id].disable, is_fetch);
					}
					else
					{
						jQuery.fn.kkstarratings.update(current, fallback_fuel, fallback_legend, false, is_fetch);
					}
				});
			},
			complete: function(){
				
			},
			error: function(e){
				jQuery('.kksr-legend', obj).fadeOut('fast', function(){
					jQuery('.kksr-legend', obj).html('<span style="color: red">'+jQuery.fn.kkstarratings.options.error_msg+'</span>');
				}).fadeIn('slow', function(){
					jQuery.fn.kkstarratings.update(obj, fallback_fuel, fallback_legend, false, is_fetch);
				});
			}
		});
	};

/*
	jQuery.fn.kkstarratings.options = {
		ajaxurl   : bhittani_plugin_kksr_js.ajaxurl,
		func      : bhittani_plugin_kksr_js.func,
		nonce     : bhittani_plugin_kksr_js.nonce,
		grs       : bhittani_plugin_kksr_js.grs,
		tooltip   : bhittani_plugin_kksr_js.tooltip,
		tooltips  : bhittani_plugin_kksr_js.tooltips,
		msg       : bhittani_plugin_kksr_js.msg,
		fuelspeed : bhittani_plugin_kksr_js.fuelspeed,
		thankyou  : bhittani_plugin_kksr_js.thankyou,
		error_msg : bhittani_plugin_kksr_js.error_msg
	};
   */
})(jQuery, window, document);