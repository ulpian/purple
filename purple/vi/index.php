<!DOCTYPE html>
<html>
	<head>
		<title>mouse::config</title>
		<link rel="stylesheet" href="cheese/UI/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="cheese/UI/bootstrap/css/bootstrap-responsive.min.css" />
		<link rel="stylesheet" href="cheese/UI/assets/css/style.css" />
	</head>
	
	<body>
	<div class="container">
		
		<div class="row">
			<div class="span6 offset3 body">
				
				<img src='http://labs.gurron.com/trove/mlogo.png' id='mlogo' />
				
				<div class="alert alert-success">
				  <b>Great!</b>
				  Everything seems to be working fine.
				</div>
				
				<h1>you're using mouse :D</h1>
				<p class="lead">
					This is small default page that shows your configuration and a short tutorial on how to get started quickly.
				</p>
				<p>
					Its great that you're using mouse. This is the default page that checks that everything is working and if you're all set to go.
					mouse was made to be lightweight and easy-to-use providing you with the tools to build an application rapidly.
				</p>
				
				<br />
				
				<h3>your Whiskers.json</h3>
				<pre style="text-align:left;">
<?php echo file_get_contents('whiskers.json'); ?>
				</pre>
				
				<br />
				
				<h3>quickstart &amp; guide</h3>
				<p class="lead">
					Tutorial and info on getting started plus some rules &amp; conventions.
				</p>
				<p>
					We have a few examples on the mouse github repository <a href="https://github.com/ulpmori/mouse/tree/master/examples" target="blank">"examples" folder here</a>.
					However included here is a mini-demonstration on how things function.
				</p>
				<p>
					URL's function pretty simply. Classes on the controller folder are called first, then a method in that controller followed by an array of values.
				</p>
				<div class="well">
					http://www.foo.com/<a style="color:#336699;">_class_</a>/<a style="color:#ff6600;">_method_</a>/<a style="color:#158C00;">_value1-value2-value3-value4..._</a>
				</div>
				
				<p>
					However with mouse you can call multiple classes in one url, as long as the same class is not called more than once.
				</p>
				
				<div class="well">
					http://www.foo.com/<a style="color:#336699;">_class_</a>/<a style="color:#ff6600;">_method_</a>/<a style="color:#158C00;">_value1-value2_</a>/<a style="color:#336699;">_class2_</a>/<a style="color:#ff6600;">_method_</a>/<a style="color:#158C00;">_value1-value2-value3-value4..._</a>
				</div>
				
				<p class="lead">
					Some rules
				</p>
				<dl>
				  <dt>naming classes</dt>
				  <dd>The file for a class must be named <b>'your-class-name.php'</b>, naming your model or view the same way is recommended but optional. 
				  	The name of the class itself must be <b>'your-class-name_Controller'</b>.</dd>
				  <dd>A class is only allowed to be called <b>once</b>, if it is called more than once it is ignored.</dd>
				</dl>
				
				<dl>  
				  <dt>URL routing calls</dt>
				  <dd>Routing with mouse is a little different, you can have <b>as many classes and methods called in one url</b> as long as the same class is not called more than once.</dd>
				</dl>
				
				<dl>
				  <dt>whiskers</dt>
				  <dd>Your <b>whiskers.json must be correct json</b> otherwise serious errors will result as information on you applicationa, dependencies, app root and more are used from your whiskers.json.</dd>
				</dl>
				
				<dl>
				  <dt>whiskers root / base url</dt>
				  <dd>Your <b>whiskers.json controls the base url</b> in your .htaccess file, make sure this correct. If there are no subfolder leave it empty and write nothing inside, however if you root is a subfolder then on your whiskers.json 
				  	file write under "root": "/your_prefered_root_path/". If you are experiencing any issues with routing then check your .htaccess file.</dd>
				</dl>
				
				<br />
				
				<h3>current structure</h3>
				<p>
					your current folder structure should look like this.
				</p>
				<pre style="text-align:left;">
<a>total size: 274kb *(14kb without 'UI')</a>
<a class="fold">cheese</a>
	<a class="fold">den</a>
		<b>curr.den.json</b>
	<a class="fold">help</a>
	<a class="fold">UI</a>(<a>260kb</a>)
		<a class="fold">assets</a>
			<a class="fold">css</a>
				<a class="file">style.css</a>
			<a class="fold">js</a>
			<a class="fold">img</a>
		<a class="fold">bootstrap</a>
			<a class="fold">css</a>
				<a class="file">bootstrap.min.css</a>
				<a class="file">bootstrap-responsive.min.css</a>
			<a class="fold">img</a>
				<a class="fileimg">glyphicons-halflings.png</a>
				<a class="fileimg">glyphicons-halflings-white.png</a>
			<a class="fold">js</a>
				<a class="file">bootstrap.min.js</a>
		<a class="file">jquery-1.9.0.min.js</a>
	<a class="file">mtrap.php</a>
	<a class="file">murl.php</a>
	<a class="file">router.php</a>
	<a class="file">vurr.php</a>
	<a class="file">whiskers.php</a>
<a class="fold">co</a>
	<a class="file">home.php</a>
<a class="fold">mo</a>
<a class="fold">vi</a>
	<a class="file">index.php</a>
<a class="file">index.php</a>
<b>whiskers.json</b>
				</pre>
				
				
				<h3>deleting this file</h3>
				<p>
					you can delete this file by going on the <b>vi/</b> folder and deleting the <b>index.php</b> and the <b>home.php</b> file in the <b>co/</b> folder to setup your own files. 
					When nothing is declared by the url a default <b>home.php</b> in the <b>co/</b> folder is instantiated.
				</p>
			</div>
		</div>
	
	<p style="width:500px; display:block; margin-left:auto; margin-right:auto;">
	  <small><a href="https://github.com/ulpmori/mouse" target="blank">mouse</a> is an opensource framework licensed under the MIT license 2013 by Ulpian Morina</small>
	</p>
	
	</div>
	
	<script src="cheese/UI/bootstrap/js/bootstrap.mini.js"></script>
	<script src="cheese/UI/jquery-1.9.0.min.js"></script>
	</body>
</html>