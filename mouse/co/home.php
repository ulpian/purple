<?php

// main controller
class home_Controller
{
	// vurr init'd class
	private $miew;
	
	function __construct()
	{
		// init classes
		$this->miew = new vurr;
		
		// load model information
		
		// send respFormat
		$this->miew->render('index');
	}
}
