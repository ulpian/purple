<?php

# whiskers - admin config
require_once 'box/whiskers.php';

	# ==================
	# TROVE
	
		# ==================
		# COMPOSER
		require __DIR__.'/trove/composer/vendor/autoload.php';

	# mustache php
	include_once 'box/trove/Mustache/Autoloader.php';
	Mustache_Autoloader::register();

# vurr - view handling
require_once 'box/vurr.php';

# vurr - view handling
require_once 'box/murl.php';

	# ==================
	# flavour packs

	# flavour path
	$flavour_path = 'box/flavour/';
		
		# the controller flavour
		include_once $flavour_path.'poco.php';

		# the model flavour
		include_once $flavour_path.'podo.php';