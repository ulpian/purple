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
	
	// whiskroot
	private $whiskroot;
	
	// seperate the requests coming
	private $path = array();
	
	function __construct()
	{
		// compose the url
		$this->url = 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
		
		// parse the url
		$urlPrsd = parse_url($this->url);
		// paths - array_filter removes all NULL, FALSE or EMPTY
		$this->path = array_filter(explode('/',urldecode($urlPrsd['path'])));
		
		// whiskers
		try
		{
			$whisk = new Whiskers;
			
			// whiskroot declr
			$this->whiskroot = Whiskers::$whisk->root;
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
		foreach($this->path as $ord => $step)
		{
			// if no steps then default is home
			if($_SERVER["REQUEST_URI"] == $this->whiskroot)
			{
				$step = 'home';
			}
			
			// do some security checks ***
			// CHECK THE STEPS AND REPEAT LEVEL
			
			// check if co/file - class exists
			// makes sure controller not declared more than once
			if(file_exists(strtolower('co/'.$step.'.php')) & substr_count(implode(',',$this->path), $step) <= 1)
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
					$type = (isset($this->path[$ord + 1]) || empty($this->path[$ord + 1])) 
						? NULL : $this->path[$ord + 1];
									
					
					// check for the vals
					$vals = (isset($this->path[$ord + 2]) || empty($this->path[$ord + 2])) 
						? NULL : $this->path[$ord + 2];
									
					
					// check for the format
					$respFormat = (isset($this->path[$ord + 3]) || !empty($this->path[$ord + 3]) & substr($this->path[$ord + 3], 0, 1) == '.') 
						? str_replace('.', '', $this->path[$ord + 3]) : NULL;
					
					
					// if more than one val
					$vals = (!empty($vals) & strstr($vals,'-')) 
						? explode('-', $vals) : array($vals);
						
					// ****
					// Running the class and methods
					// ****
					
					// run class
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
					
					// run function
					if(method_exists($moco, $type))
					{
						// run functions
						$moco->$type($vals);
					}
					elseif(empty($type))
					{
						// __construct called no need for exception
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
			else
			{
				// no controller so continue
				continue;
			}
		}
	}
}
