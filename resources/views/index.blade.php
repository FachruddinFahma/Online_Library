<!DOCTYPE html>
<html lang="en">

<head>
	<title>Laravel Book</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

	<link rel="stylesheet" type="text/css" href="{{ asset('Template/css/normalize.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('Template/icomoon/icomoon.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('Template/css/vendor.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('Template/style.css') }}">
</head>

<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">

	<div id="header-wrap">

		<header id="header">
			<div class="container-fluid">
				<div class="row">

					<div class="col-md-2">
						<div class="main-logo">
							<a href="index.html"><img src={{asset('Template/images/main-logo.png')}} alt="logo"></a>
						</div>

					</div>

					<div class="col-md-10">

						<nav id="navbar">
							<div class="main-menu stellarnav">
								<ul class="menu-list">
									<li class="menu-item active">
                                     <a href="{{ route('login') }}">Login</a></li>

									<li class="menu-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>

								</ul>
							</div>
						</nav>

					</div>

				</div>
			</div>
		</header>
	</div>

	<section id="billboard">
		<div class="container">
			<div class="row">
				<div class="col-md-12">


					<button class="prev slick-arrow"><i class="icon icon-arrow-left"></i></button>


					<div class="main-slider pattern-overlay">
						<div class="slider-item">
							<div class="banner-content">
								<h2 class="banner-title">Life of the Wild</h2>
								<p>Lorem ipsum dolor sit amet...</p>
								<div class="btn-wrap">
									<a href="#" class="btn btn-outline-accent btn-accent-arrow">Read More <i class="icon icon-ns-arrow-right"></i></a>
								</div>
							</div>
							<img src="{{ asset('Template/images/main-banner1.jpg') }}" alt="banner" class="banner-image">
						</div>

						<div class="slider-item">
							<div class="banner-content">
								<h2 class="banner-title">Birds gonna be Happy</h2>
								<p>Lorem ipsum dolor sit amet...</p>
								<div class="btn-wrap">
									<a href="#" class="btn btn-outline-accent btn-accent-arrow">Read More <i class="icon icon-ns-arrow-right"></i></a>
								</div>
							</div>
							<img src="{{ asset('Template/images/main-banner2.jpg') }}" alt="banner" class="banner-image">
						</div>
					</div>


					<button class="next slick-arrow"><i class="icon icon-arrow-right"></i></button>

				</div>
			</div>
		</div>
	</section>

	<section id="client-holder">
		<div class="container">
			<div class="row">
				<div class="inner-content">
					<div class="logo-wrap">
						<div class="grid">
                            <a href="#"><img src={{asset('Template/images/client-image1.png')}} alt="client"></a>
							<a href="#"><img src={{asset('Template/images/client-image3.png')}} alt="client"></a>
							<a href="#"><img src={{asset('Template/images/client-image4.png')}} alt="client"></a>
                            <a href="#"><img src={{asset('Template/images/client-image2.png')}} alt="client"></a>
							<a href="#"><img src={{asset('Template/images/client-image5.png')}} alt="client"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<!-- Slick JS -->
	<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

	<!-- Bootstrap Bundle -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <!-- Custom JS -->
	<script src="{{ asset('Template/js/plugins.js') }}"></script>
	<script src="{{ asset('Template/js/script.js') }}"></script>

	<script>
		$(document).ready(function () {
			$('.main-slider').slick({
				arrows: true,
				autoplay: false,
				prevArrow: $('.prev'),
				nextArrow: $('.next'),
				dots: true
			});
		});
	</script>

</body>

</html>
