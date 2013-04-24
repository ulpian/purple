<?php

# main controller
class home_Controller
{
	use moco;

	function set ()
	{
		# things to set
		$this->miew->page = 'home';
	}

	function render ()
	{
		# send respFormat
		$this->miew->render();
	}
}