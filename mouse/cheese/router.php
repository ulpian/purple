<?php
// ---------------------------------------------------
// Routing
// -> __construct routing system
// -> /class/function/varA-varB-varC(unlimited)/.format
// ---------------------------------------------------
include 'cheese/whiskers.php';
include 'cheese/vurr.php';

// routing around
class router
{
	// get the url
	public $url;
	
	// seperate the requats coming
	private $path = array();
	
	function __construct()
	{
		// compose the url
		$this->url = 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
		
		// parse the url
		$urlPrsd = parse_url($this->url);
		// paths
		$this->path = explode('/',urldecode($urlPrsd['path']));
		
		// whiskers
		try
		{
			$whisk = new Whiskers;
		}
		catch (Exception $we)
		{
			echo '<b>Warning</b>: '.$we->getMessage()."\n";
		}
	}
	
	// load the router and scripts
	function bake()
	{
		// bake the routes based on section => (action => query) format
		// e.g /api/srch/John Smith
		foreach($this->path as $ord => $step)
		{
			// chk no empties
			if(!empty($step))
			{
				// do some security checks ***
				
				// check if co/file - class exists
				// makes sure controller not declared more than once
				if(file_exists(strtolower('co/'.$step.'.php')) & substr_count(implode(',',$this->path), $step) == 1)
				{
						// ===== get assoc files from the model and view ====== //
						// check if this controller has a model
						if(file_exists('mo/'.$step.'.php'))
						{
							// if model exists then get the model
							include 'mo/'.$step.'.php';
						}
						// =================================================== //
					
					// get the controller
					include 'co/'.$step.'.php';
					
					
					// if it does exist then chk the class
					if(class_exists($step.'_Controller'))
					{
						// make controller nm
						$cont = $step.'_Controller';
						
						// check for the type
						if(isset($this->path[$ord + 1]))
						{
							if(!empty($this->path[$ord + 1]))
							{
								// type is next to act
								$type = $this->path[$ord + 1];
							}
							else
							{
								// empty
								$type = NULL;
							}
						}
						else
						{
							// empty
							$type = NULL;
						}
						
						// check for the vals
						if(isset($this->path[$ord + 2]))
						{
							if(!empty($this->path[$ord + 2]))
							{
								// vals is next to type
								$vals = $this->path[$ord + 2];
							}
							else
							{
								// empty
								$vals = NULL;
							}
						}
						else
						{
							// empty
							$vals = NULL;
						}
						
						// check for the format
						if(isset($this->path[$ord + 3]))
						{
							if(!empty($this->path[$ord + 3]) & substr($this->path[$ord + 3], 0, 1) == '.')
							{
								// format is next to vals (with no .)
								$respFormat = str_replace('.', '', $this->path[$ord + 3]);
							}
						}
							
							// if more than one val
							if(!empty($vals) & strstr($vals,'-'))
							{
								// place all vals as array
								$vals = explode('-', $vals);
							}
							else
							{
								// single term still as array of vals
								$vals = array($vals);
							}
							
						// ****
						// Running the class and methods
						// ****
						
						// run the class
						if(isset($respFormat))
						{
							// send respFormat
							$moco = new $cont($respFormat);
						}
						else
						{
							// no respFormat to send
							$moco = new $cont;
						}
												
						if(method_exists($moco, $type))
						{
							// run functions
							$moco->$type($vals);
						}
						else
						{
							throw new Exception('The '.$type.' method in this controller does not exist.');
						}
					}
					else
					{
						throw new Exception('A controller for this does not exist.');
					}
				}
			}
		}
	}
}
