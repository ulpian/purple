<?php

// curl class
class murl
{
	// the curl opt
	private $curlop_init;
	private $curlop_url;
	private $curlop_head;
	private $curlop_retran;
	
	// get contents
	function get_cont($url)
	{
		// init
		$this->curlop_init = curl_init();
		$this->curlop_head = 0;
		$this->curlop_retran = 1;
		
		// set options
		curl_setopt($this->curlop_init, CURLOPT_URL, $url);
		curl_setopt($this->curlop_init, CURLOPT_HEADER, $this->curlop_head);
		curl_setopt($this->curlop_init, CURLOPT_RETURNTRANSFER, $this->curlop_retran);
		
		// get data
		$data = curl_exec($this->curlop_init);
		
		// close
		curl_close($this->curlop_init);
		
		return $data;
	}
}
