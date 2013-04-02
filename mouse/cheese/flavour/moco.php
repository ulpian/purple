<?php

/**
 * moco
 * interface for controllers - MOuse COntroller
 * this includes dependency injection of the view
 * 
 * @author Ulpian Morina
 */
trait moco
{
	/** @type object the object for the view */
	public $miew;

	/**
	 * main construct for all controllers
	 * 
	 * @param null
	 */
	function __construct ()
	{
		# init the $miew as a view object
		$this->miew = new vurr;
	}

}