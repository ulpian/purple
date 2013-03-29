<?php

# main controller
class home_Controller extends moco
{
	function render ()
	{
		$this->miew->pgnm = 'index';

		# should be on the model
		$whisk = file_get_contents('whiskers.json');

		$dev_data = ['whiskers' => $whisk];

		$this->miew->data('config', $dev_data);

		# send respFormat
		$this->miew->render();
	}
}