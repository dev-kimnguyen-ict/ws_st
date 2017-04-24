<script>
	$(function () {
		var offset = 220;
		var $backTop = $('.back-to-top');
		$(window).scroll(function () {
			if ($(this).scrollTop() > offset) {
				$backTop.fadeIn(500);
			} else {
				$backTop.fadeOut(500);
			}
		});
		$backTop.click(function () {
			$('body, html').animate({scrollTop: 0}, 'slow');
		});
	});
</script>