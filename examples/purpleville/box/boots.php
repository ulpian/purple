<?php

# whiskers - admin config
require_once 'box/whiskers.php';

	# ==================
	# TROVE

	# mustache php
	include_once 'box/trove/Mustache/Autoloader.php';
	Mustache_Autoloader::register();

# vurr - view handling
require_once 'box/vurr.php';

	# ==================
	# flavour packs

	# flavour path
	$flavour_path = 'box/flavour/';
		
		# the controller flavour
		include_once $flavour_path.'moco.php';

		# the model flavour
		include_once $flavour_path.'modo.php';