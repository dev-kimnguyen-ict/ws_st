$(function() {
	$('.toggle_featured').click(function(){
		$(this).prev().removeClass('title-actived').find('.triangle').addClass('hidden');
		$(this).addClass('title-actived').find('.triangle').removeClass('hidden');
		$('.new-product').fadeOut(200).addClass('hidden');
		$('.featured-product').fadeIn(650).removeClass('hidden');
	});

	$('.toggle_new').click(function(){
		$(this).next().removeClass('title-actived').find('.triangle').addClass('hidden');
		$(this).addClass('title-actived').find('.triangle').removeClass('hidden');
		$('.featured-product').fadeOut(200).addClass('hidden');
		$('.new-product').fadeIn(650).removeClass('hidden');
	});
    var $s = $('#wowslider_engine');
    $s.remove();
});