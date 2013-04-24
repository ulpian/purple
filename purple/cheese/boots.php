<?php

# whiskers - admin config
require_once 'cheese/whiskers.php';

	# ==================
	# TROVE

	# mustache php
	include_once 'cheese/trove/Mustache/Autoloader.php';
	Mustache_Autoloader::register();

# vurr - view handling
require_once 'cheese/vurr.php';

	# ==================
	# flavour packs

	# flavour path
	$flavour_path = 'cheese/flavour/';
		
		# the controller flavour
		include_once $flavour_path.'moco.php';

		# the model flavour
		include_once $flavour_path.'modo.php';
