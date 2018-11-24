jQuery(document).ready(function($){

	var $pswp = $('.pswp')[0];
	var pswp_image = [];
	$('.main-image-carousel').each( function() {

		var $pic     = $(this),
		getItems = function() {
			var items = [];
			$pic.find('a').each(function() {

				var $href   = $(this).attr('href'),
					$size   = $(this).data('size').split('x'),
					$width  = $size[0],
					$height = $size[1];

				var item = {
					src 	: $href,
					w   	: $width,
					h   	: $height,
					el		: $(this),
					msrc	: $(this).find('img').attr('src')
				}
				items.push(item);
			});
			return items;
		}

		var items = getItems();

		$.each(items, function(index, value) {
			pswp_image[index]     = new Image();
			pswp_image[index].src = value['src'];
		});

		var $all_as = $('a', $(this) );
		$all_as.on('click', function(event) {

			event.preventDefault();
			var $index = $all_as.index(this);

			var options = {
				index: $index,
				bgOpacity: 0.9,
				showHideOpacity: false,
				galleryUID: $(this).parents('.images-se').attr('id'),
				getThumbBoundsFn: function(index) {
					var image = items[index].el.find('img'),
					offset = image.offset();
					return {x:offset.left, y:offset.top, w:image.width()};
				}
			}

			var lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, items, options);
			lightBox.init();
			lightBox.listen('afterChange', function() {
				$('.main-image-carousel').trigger('to.owl.carousel', [lightBox.getCurrentIndex(),0,true]);
			});
		});

	});

});