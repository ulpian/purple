<?php

/**
 * poco -
 * trait for controllers
 * this includes dependency injection of the view
 * 
 * @author Ulpian Morina
 */
trait poco
{
	/** @type object the object for the view */
	public $p;

	/** @type string app root */
	public $root;

	/**
	 * main construct for all controllers
	 * 
	 * @param null
	 */
	function __construct ()
	{
		# init the $miew as a view object
		$this->p = new vurr;

		# app root
		$this->root = Whiskers::$whisk->root;
	}

	/**
	 * storing sessions or re-direct back to root
	 * 
	 * @param $sess_nm the session name
	 * @param $sess_val the session value
	 * @param $loc location if session not there
	 * 
	 * @todo add a better method for holding sessions, encryption etc
	 */
	function store ($sess_nm, $sess_val, $loc = 'base')
	{
		# if base
		($loc == 'base')
		?
			$loc = $this->root
		:
			$loc = $loc;

		# check session
		if ($_SERVER['REQUEST_URI'] != $loc)
		{
			(isset($_SESSION[$sess_nm]) && $_SESSION[$sess_nm] == $sess_val)
			?
				null
			:
				header("Location: ".$loc);
		}
	}

	/**
	 * un-storing sessions and re-direct back to root
	 * 
	 * @param $sess_nm the session name
	 * 
	 * @todo add a better method for destroying sessions, encryption etc
	 */
	function unstore ($sess_nm)
	{
		$_SESSION[$sess_nm] == null;

		session_destroy();

		header("Location: ".$this->root);
	}

}