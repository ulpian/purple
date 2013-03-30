<?php
/**
 * vurr
 * class which binds the data to specific arrays and 
 * renders the appropriate view or renders a json presentation of the data.
 * 
 * @author Ulpian Morina
 * @date 04/02/2013
 */
class vurr
{
	/**@type string|null name of the file to present data to*/
	public $pgnm;
	
	/**@type array|null aggregated arrays of data to present to the view*/
	public $pdata = [];

	/**@type object| mustache class*/
	public $mustake;
	
	/**
	 * construction to the page name to render and inject
	 * 
	 * @param string $pgnm page name
	 */
	function __construct (string $pgnm = null)
	{
		# if set then set
		if (!empty($pgnm))
		{
			$this->pgnm = $pgnm;
		}

		# mustache class
		$this->mustake = new Mustache_Engine;
	}

	/**
	 * The main page render
	 * 
	 * @param string $pgnm page name, null by default
	 * @param string $suffix format suffix of the file, 'php' by default
	 * @param string $ten the template engine, default is mustache but support for 'twig', 'jinja' and 'none' simple php include with no template, is available
	 */
	function render ($pgnm = null, $suffix = 'miew', $ten = 'mustache')
	{	
		# if set then set
		if (!empty($pgnm) & !empty($this->pgnm))
		{
			$this->pgnm = $pgnm;
		}
		elseif (empty($pgnm))
		{
			$pgnm = $this->pgnm;
		}
		
			# path to view file
			$vfile = 'vi/'.$this->pgnm.'.'.$suffix;
		
		# check if data exists
		if (!empty($this->pdata))
		{
			# decompose the pdata arr
			$data = $this->pdata[$pgnm];
			
				# construct vars if not as mustache
				if ($ten == 'none')
				{
					foreach($data as $dat_k => $dat_v)
					{
						${$dat_k} = $dat_v;
					}
				}
		}
		
		# check if view exists
		if (file_exists($vfile))
		{
			# view file rendering
			switch ($ten)
			{
				#mustache
				case 'mustache':

					echo $this->mustake->render(file_get_contents($vfile), $data);

					break;

				#none - native php
				case 'none':

					include $vfile;

					break;

				#twig

				#jinja
			}

		}
		else
		{
			throw new Exception("The view cannot render, view file does not exist");
		}
	}
	
	/**
	 * The json page render, takes the name of the page set when class was initialsed
	 * 
	 * @return json_object
 	 */
	function render_json ()
	{
		# data
		$data = $this->pdata[$this->pgnm];
		
		# headers
		header('HTTP/1.1 200 OK');
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
		
		# decompose the pdata arr
		$data = json_encode($this->pdata[$pgnm]);
		
		return $data;
	}
	
	/**
	 * Binding the data for a specific page
	 * 
	 * @param string $pgnm the file name of the view file to render
	 * @param string $datnm name of the data, this will be the identifier of the data
	 * @param array $data the array of data to bind
	 * 
	 * @return void
	 */
	function data ($datnm, array $data, string $pgnm = null)
	{
		# if there is an empty page name
		if (empty($pgnm))
		{
			$pgnm = $this->pgnm;
		}

		# set data => name
		$this->pdata[$pgnm][$datnm] = $data;
	}
}