<?
session_start();

/**
 * router
 * constructs a routing system that follows mouses URL devisions;
 * </class/method/var1-var2-var3(no-limit)/.format>
 * this is considered one operation and there may be multiple operations 
 * of this kind in one page, this means multiple classes can be called 
 * in one page. The "/.format" is not required but may be useful.
 * </class/method/var1-var2-var3(no-limit)>
 * 
 * @todo finalise the /.format
 * 
 * @author Ulpian Morina
 * @date 04/02/2013
 */

# error reporting
ini_set('display_errors', 'On');

# boots script manager
require 'box/boots.php';

# routing around
class router
{
	/**
	 * url 
	 * main url var that hold the url address 
	 * 
	 * @type string|null public url variable to
	 */
	public $url;

	public $baseurl;
	
	# whiskroot
	private $whiskroot;
	
	/**@type array|null the path of the operations*/
	private $path = [];
	
	/**
	 * construct 
	 * loading and setting first values
	 */
	function __construct ()
	{
		# compose the url
		$this->baseurl = 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];

		$this->url = str_replace('?', '', $this->baseurl);
		
		# parse the url
		$urlPrsd = parse_url($this->url);
		# paths - array_filter removes all NULL, FALSE or EMPTY
		$this->path = array_filter(explode('/',urldecode($urlPrsd['path'])));
		
		# whiskers
		try
		{
			$whisk = new Whiskers;
			
			# whiskroot declr
			$this->whiskroot = Whiskers::$whisk->root;
		}
		catch (Exception $we)
		{
			echo '<b>Warning</b>: '.$we->getMessage()."\n";
		}

		# remove the root from the path
		$this->path = array_diff($this->path, array_filter(explode('/',urldecode($this->whiskroot))));
	}
	
	public static $get = [];

	/**
	 * Bake - 
	 * method for loading the router and scripts
	 * 
	 * @todo re-define routing concepts
	 * @todo check security/attacks/cleaning
	 */
	function bake ()
	{
		# if no steps then default is home
		if ($_SERVER["REQUEST_URI"] == $this->whiskroot)
		{
			$this->path = array('home');
		}

		# run get on vals
		if (strpos($this->baseurl, '?'))
		{
			# if there is a ? then run get
			$burl = explode('?', $this->baseurl);

			$this->get($burl[1]);
		}

		# bake the routes based on section => (action => query) format
		foreach ($this->path as $ord => $step)
		{
			# do some security checks ***
			
			# check if co/file - class exists
			# makes sure controller not declared more than once
			if (file_exists(strtolower('co/'.$step.'.php')) & substr_count(implode(',',$this->path), $step) <= 1)
			{
					# ===== get assoc files from the model and view ======
					# check if this controller has a model
					(file_exists('mo/'.$step.'.php'))
					?
						# if model exists then get the model
						include 'mo/'.$step.'.php'
						
					: NULL;
					# ===================================================
				
				# get the controller
				include 'co/'.$step.'.php';
				
				# if it does exist then chk the class
				if (class_exists($step.'_Controller'))
				{
					# make controller nm
					$cont = $step.'_Controller';
					
					# check for the type
					$type = (isset($this->path[$ord + 1]) || !empty($this->path[$ord + 1])) 
						? $this->path[$ord + 1] : NULL;
					
					
					# check for the vals
					$vals = (isset($this->path[$ord + 2]) || !empty($this->path[$ord + 2])) 
						? $this->path[$ord + 2] : NULL;
					
					# check for the format
					$respFormat = (isset($this->path[$ord + 3]) || !empty($this->path[$ord + 3])) 
						? $respFormat = (substr($this->path[$ord + 3], 0, 1) == '.') 
							? str_replace('.', '', $this->path[$ord + 3]) : NULL 
								: NULL;

					# if more than one val
					$vals = (!empty($vals) & strstr($vals,'-') != FALSE) 
						? 
						$vals = explode('-', $vals) 
						: 
						$vals = $vals;

					# ****
					# Running the class and methods
					# ****
					
					# run class
					(isset($respFormat))
					?
						# send respFormat
						$poco = new $cont($respFormat)
					:
						# no respFormat to send
						$poco = new $cont;
					
						# run set function -if available
						(method_exists($poco, 'set'))
						?
							# run set
							$poco->set()
						:
							NULL;

					if (empty($type))
					{
						# render the default
						$poco->render();
					}
					
					# run function
					if (method_exists($poco, $type))
					{
						# run functions
						$poco->$type($vals);
					}
					elseif (!method_exists($poco, $type) & $step == 'home')
					{}
					else
					{
						#throw new Exception('The '.$type.' method in this controller does not exist.');
						# so continue
						continue;
					}
				}
				else
				{
					#throw new Exception('A controller for this step does not exist.');
					# so continue
					continue;
				}
			}
			else
			{
				# no controller
			}
		}
	}

	# workaround
	/**
	 * get -
	 * get workaround to the way php handles gets
	 * 
	 * @todo major checks on security
	 * @todo more native approach to the get
	 */
	function get ($get)
	{
		# explode to key value
		$get = explode('&', $get);

		foreach ($get as $varval)
		{
			# explode the var and val
			$getting[] = $varval;
		}

		foreach ($getting as $gets)
		{
			# organise
			$getses = explode('=', $gets);

			router::$get[$getses[0]] = $getses[1];
		}
	}
}
