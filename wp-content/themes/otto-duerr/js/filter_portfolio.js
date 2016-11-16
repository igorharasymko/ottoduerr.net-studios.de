// Filter Portfolio Document
jQuery(document).ready(function() {
	jQuery('ul#filter a').click(function() {
		jQuery(this).css('outline','none');
		jQuery('ul#filter .current').removeClass('current');
		jQuery(this).parent().addClass('current');
		
		var filterVal = jQuery(this).attr("data-value");
				
		if(filterVal == 'all') {
			jQuery('ul#portfolio_4 li.hidden,ul#portfolio_2 li.hidden,ul#portfolio_3 li.hidden').fadeIn('slow').removeClass('hidden');
		} else {
			
			jQuery('ul#portfolio_4 li,ul#portfolio_2 li,,ul#portfolio_3 li').each(function() {
				if(!jQuery(this).hasClass(filterVal)) {
					jQuery(this).fadeOut(0	).addClass('hidden');
				} else {
					jQuery(this).fadeIn('slow').removeClass('hidden');
				}
			});
		}
		
		return false;
	});
});