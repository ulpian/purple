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

	/** @type object the object for redis */
	public $redis;

	/** @type object the object for neo4j */
	public $neo;

	/** @type object the object for mysql */
	public $mysql;

	/**
	 * main construct for all controllers
	 * 
	 * @param null
	 */
	function __construct ()
	{
		# run the set function
		$this->set();
	}
}