<!DOCTYPE html>
<html>
	<head>
		<title>PurpleVille</title>
		<link rel="stylesheet" href="{{app.box}}trove/flatstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="{{app.box}}trove/flatstrap/css/bootstrap-responsive.min.css" />
		<link rel="stylesheet" href="{{app.box}}ui/css/style.css" />

		<script type="text/javascript" src="{{app.box}}trove/jquery-1.9.0.min.js"></script>
		<script type="text/javascript" src="{{app.box}}trove/flatstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="{{app.box}}trove/backstretch.js"></script>

		<script type="text/javascript">
		$(document).ready(function() {

			var images = [
				"{{app.box}}ui/img/bg/7735684056_81b137ab00_o.jpg",
				"{{app.box}}ui/img/bg/7151751447_c5ba5d8982_o.jpg",
				"{{app.box}}ui/img/bg/7143931697_6be5b11682_o.jpg",
				"{{app.box}}ui/img/bg/7154569584_6a9f96262b_o.jpg",
				"{{app.box}}ui/img/bg/7611013154_403c7f1085_o.jpg",
				"{{app.box}}ui/img/bg/8398493922_3ccdfe3aec_k.jpg",
				"{{app.box}}ui/img/bg/6997832970_0883098727_o.jpg",
				"{{app.box}}ui/img/bg/6051872103_3f4be886ac_o.jpg"
			];

			var randomNum = Math.floor(Math.random() * images.length);

			$.backstretch(images[randomNum]);

		});
		</script>
	</head>
	
	<body>
	<div class="container">
		
		<div class="row">
			<div class="span10 offset1">

				<div class="navbar">
					<div class="navbar-inner">
						<a class="brand" href="{{app.base}}"><b style="color:#6b00c9;">PurpleVille</b></a>
						<ul class="nav">
							<li><a href="#">#Programming</a></li>
							<li><a href="#">#Startups</a></li>
							<li><a href="#">#Science</a></li>
						</ul>

						<ul class="nav pull-right">
							<li class="active"><a href="{{app.base}}home/about">About</a></li>
						</ul>
					</div>
				</div>
				
				<div class="row-fluid">
					
					<div class="span9">

						{{{page.main.content}}}

					</div>

					<div class="span3">
						
						<div class="well">

							<img class="img-circle" src="https://si0.twimg.com/profile_images/3498089286/90255ab93dbdf54158b83c7875c10f12.jpeg" />

							<h3>Ulpian Morina</h3>
		
							<p>This is my example blog called PurpleVille</p>

						</div>
	
					</div>

				</div>
				
			</div>
		</div>
	
	</div>
	
	</body>
</html>