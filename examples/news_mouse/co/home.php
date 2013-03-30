<?php

# main controller
class home_Controller extends moco
{
	function set ()
	{
		# things to set
	}

	function render ()
	{
		$this->miew->pgnm = 'index';

		# should be on the model
		$whisk = file_get_contents('whiskers.json');

		$config = ['whiskers' => $whisk];

		$this->miew->data('config', $config);

		# send respFormat
		$this->miew->render();
	}
}