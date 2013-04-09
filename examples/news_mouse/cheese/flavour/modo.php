<?php

/**
 * modo
 * trait for models - MOuse MOdel
 * 
 * @author Ulpian Morina
 */
trait modo
{
	/** @type object the object for mongodb */
	public $mongo;

	/**
	 * main construct for all controllers
	 * 
	 * @param null
	 */
	function __construct ()
	{
		# init $mongo
		$this->mongo = new MongoClient;

		$this->set();
	}

}