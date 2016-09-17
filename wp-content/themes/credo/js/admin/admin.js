jQuery(document).ready(function($){

	if($('.tt_color_picker').length) {
    	$('.tt_color_picker').wpColorPicker();
	}

	var span = jQuery('.image-picker span').clone();

	$('.image-picker').on('click', function(){
			var t = $(this);
			var t_parent = t.parent();
			var frame = t.data('frame');
			var t_hidden = t.children('input[type="hidden"]');
			var id = t_hidden.prop('value');
			var a = wp.media.model.Attachment;
			if(frame===undefined){
				frame = wp.media({
					multiple:false
				});
				t.data('frame',frame);

				frame.on( 'open',function(){

					var s = this.get('library').get('selection');
					var f;
					var x;

					if(id&&''!==id&&-1!==id&&'0'!==id){
						f = a.get(id);
						f.fetch();
						x = [f];
					}else
						x = [];

					s.reset(x);

				}).state('library').on('select',function(){
					var all_selected = this.get('selection')
					all_selected.map(function(image,index){
						var last_image;
						image = image.toJSON();
						
						last_image_container = jQuery('.image-picker');
						last_image_container.children('img').prop('src',image.url).show();
						last_image_container.children('input[type="hidden"]').prop('value',image.id);
						last_image_container.children('span').remove();
						if(!last_image_container.parent().children('span').hasClass('remove-img')) {
							last_image_container.parent().append('<span class="remove-img">Remove image</span>');							
						}
						
					})

				});
			}
			
			frame.open();
		});

		jQuery('body').on('click', '.remove-img', function(e) {
			e.preventDefault();
			var el = jQuery(this),
				img = jQuery('.image-picker img'),
				input = jQuery('.image-picker input[type="hidden"]');

				input.val('');
				img.removeAttr('src').hide();
				el.remove();
				jQuery('.image-picker').append(span);

		});

		if(jQuery('.image-picker img').attr('src') && !jQuery('.image-picker').parent().children('span').hasClass('remove-img')) {
			jQuery('.image-picker').children('span').remove();
		}

		// Lazzy images
		var lazzyImg = jQuery('img[data-src]');
		if(lazzyImg.length) {
			lazzyImg.each(function(i) {
				var imgSing = lazzyImg.eq(i),
					imgSrc = imgSing.data('src');
					imgSing.attr('src', imgSrc).velocity({ opacity: 0 }, { duration: 0});
				viewportAction(lazzyImg[i], function() {
					imgSing.velocity('fadeIn', { duration: 400, delay: 200+(i*20) });
				});
			});
		}

		var portfolioSwitcher = jQuery('.portfolio-switcher');
		if(portfolioSwitcher.length) {
			var parent = jQuery('#front-static-pages fieldset ul'),
				switcherHTML = portfolioSwitcher.clone();
				portfolioSwitcher.remove();

				switcherHTML.find('label').css({
					position: 'relative',
					left: '-21px'
				});

				parent.append(switcherHTML.html()).show();
				parent.children().last().wrap('<li />');



		}


});