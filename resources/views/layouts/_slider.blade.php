<link rel="stylesheet" href="#" />
<!-- BEGIN SLIDER -->
<div class="slider">
	<div class="container container-slider">
		<div id="wowslider-container1">
			<div class="ws_images">
				<ul>
					
					<li>
						<a href="#">
							<img src="#"
								 alt="Lorem ipsum dolor sit amet."
								 title="Lorem ipsum dolor sit amet." id="wows1_0" />
						</a>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem consectetur possimus quaerat quo debitis perspiciatis velit ducimus, molestias earum suscipit.
					</li>
					<li>
						<a href="#">
							<img src="#"
								 alt="Lorem ipsum dolor sit amet."
								 title="Lorem ipsum dolor sit amet." id="wows1_1" />
						</a>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem consectetur possimus quaerat quo debitis perspiciatis velit ducimus, molestias earum suscipit.
					</li>
					<li>
						<a href="#">
							<img src="#"
								 alt="Lorem ipsum dolor sit amet."
								 title="Lorem ipsum dolor sit amet." id="wows1_2" />
						</a>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem consectetur possimus quaerat quo debitis perspiciatis velit ducimus, molestias earum suscipit.
					</li>
				</ul>
			</div>
			<div class="ws_bullets">
				<div>
					<a href="#" title="Lorem ipsum dolor sit amet."><span>1</span></a>
					<a href="#" title="Lorem ipsum dolor sit amet."><span>2</span></a>
					<a href="#" title="Lorem ipsum dolor sit amet."><span>3</span></a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END SLIDER -->
@section('scripts')
@parent()
<script src="{{ asset('slider/engine1/wowslider.js') }}"></script>
<script src="{{ asset('slider/engine1/script.js') }}"></script>
<script>
	$(function () {
		$('.ws_controls').prev('div').remove();
	});
</script>
@endsection