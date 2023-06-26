<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="shortcut icon" href="images/college_logo.png" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/college_logo.png">


	<style>
		body {
			margin: 0;
			padding: 0;
		}

		.navbar-default {
			margin: 0;
			background-color: transparent;
			background: none;
			border: 0;
			font-family: Arial, sans-serif;
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			z-index: 9999;
		}

		.navbar-default .nav>li>a {
			color: #fff !important;
			text-transform: capitalize;
			font-size: 15px;
			font-weight: 500;
			outline: none;
			padding: 15px;
			text-decoration: none;
			transition: color 0.3s ease;
		}

		.navbar-default .nav>li>a:hover {
			color: #f00; /* Change the hover color as desired */
		}

		.navbar-default .dropdown-menu {
			box-shadow: none;
		}

		.navbar-default .dropdown-menu li a {
			color: #222;
			font-size: 14px;
			text-decoration: none;
		}

		.navbar-default .fa-angle-right {
			position: absolute;
			right: 30px;
		}

		.navbar-brand img {
			margin: 0 !important;
		}
		.header {
			position: absolute;
			z-index: 111;
			left: 0;
			top: 0;
			right: 0;
			padding: 0;
			background-color: transparent;
			text-decoration: none !important;
			-webkit-transition: all .3s ease-in-out;
			-moz-transition: all .3s ease-in-out;
			-ms-transition: all .3s ease-in-out;
			-o-transition: all .3s ease-in-out;
			transition: all .3s ease-in-out;
		}

		.header-normal {
			position: relative;
			padding: 0 0 24px;
			background-color: #fff;
		}

		.header-normal .navbar-default .nav>li>a {
			color: #848484 !important;
		}

		.header.affix {
			position: fixed;
			top: 0;
			z-index: 100;
			background-color: #000;
			left: 0;
			padding: 15px 0;
			right: 0,
		}

		.header.header-normal.affix {
			background-color: #ffffff;
		}

		.header.affix .topbar {
			visibility: hidden;
			opacity: 0;
			display: none;
		}
		@media (max-width: 1200px) {
			.nav>li>a {
				padding: 1em 0.7em;
			}
		}

	</style>
</head>
<body>

	<header class="header">


		<div class="container">
			<nav class="navbar navbar-default yamm">
				<div class="navbar-header">

					<div class="logo-normal">
						<a class="navbar-brand" href="index.php"><img src="images/college_logo.png" alt=""></a>
					</div>
				</div>

				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="modules/logout.php">Log Out</a></li>
					</ul>
				</div>
			</nav><!-- end navbar -->
		</div><!-- end container -->
	</header>

</body>
</html>
