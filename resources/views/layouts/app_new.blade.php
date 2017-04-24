<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<title>{{ $title or WEB_NAME }}</title>
	<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css/font-face.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css/app.min.css') }}"/>
</head>
<body>
	
	<header class="header">
		<div class="container">
			
		</div>
	</header>
	<nav class="nav">
		<div class="container">
			<ul class="main-menu">
				<li class="menu-item actived"><a href="#">Trang chủ</a></li>
				<li class="menu-item">
					<a href="#">Đồ thờ <i class="fa fa-sort-down"></i></a>

					<ul class="submenu">
						<li>
							<a href="#">Item 1</a>
							<ul class="submenu">
								<li><a href="#">Sub Item 1</a></li>
								<li><a href="#">Sub Item 2</a></li>
								<li><a href="#">Sub Item 3</a></li>
								<li><a href="#">Sub Item 4</a></li>
								<li><a href="#">Sub Item 5</a></li>
							</ul>
						</li>
						<li><a href="#">Item 2</a></li>
						<li>
							<a href="#">Item 3</a>

							<ul class="submenu">
								<li><a href="#">Sub Item 1</a></li>
								<li><a href="#">Sub Item 2</a></li>
								<li>
									<a href="#">Sub Item 3</a>

									<ul class="submenu">
										<li><a href="#">Sub Sub Item 1</a></li>
										<li><a href="#">Sub Sub Item 2</a></li>
										<li><a href="#">Sub Sub Item 3</a></li>
										<li>
											<a href="#">Sub Sub Item 4</a>
											
											<ul class="submenu">
												<li><a href="#">Sub Sub Item 1</a></li>
												<li><a href="#">Sub Sub Item 2</a></li>
												<li><a href="#">Sub Sub Item 3</a></li>
												<li><a href="#">Sub Sub Item 4</a></li>
												<li><a href="#">Sub Sub Item 5</a></li>
											</ul>
										</li>
										<li><a href="#">Sub Sub Item 5</a></li>
									</ul>
								</li>
								<li><a href="#">Sub Item 4</a></li>
								<li><a href="#">Sub Item 5</a></li>
							</ul>
						</li>
						<li><a href="#">Item 4</a></li>
						<li><a href="#">Item 5</a></li>
					</ul>
				</li>
				<li class="menu-item"><a href="#">Đồ nội thất</a></li>
				<li class="menu-item"><a href="#">Item 4</a></li>
				<li class="menu-item"><a href="#">Item 5</a></li>
			</ul>
		</div>
	</nav>
	<section class="section">
		<div class="container">
			
		</div>
	</section>
	<footer class="footer">
		<div class="container">
			
		</div>
	</footer>
</body>
</html>