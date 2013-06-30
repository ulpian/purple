<?php

/**
 * podo -
 * trait for models
 * 
 * @author Ulpian Morina
 */
trait podo
{
	/** @type object the object for mongodb */
	public $mongo;

	/** @type object the object for redis */
	public $redis;

	/** @type object the object for neo4j */
	public $neo;

	/** @type object the object for mysql */
	public $mysql;

	/** @type string app root */
	public $root;

	/**
	 * main construct for all controllers
	 * 
	 * @param null
	 */
	function __construct ()
	{
		# run the set function
		$this->set();

		# app root
		$this->root = Whiskers::$whisk->root;
	}
}