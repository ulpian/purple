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
	public $pdata = array();
	
	/**
	 * The main page render
	 * 
	 * @param string $pgnm the file name of the view file to render
	 */
	function render($pgnm)
	{
		// get the pg to access
		$this->pgnm = $pgnm;
		
			// path to view file
			$vfile = 'vi/'.$this->pgnm.'.php';
		
		// check if data exists
		if(!empty($this->pdata))
		{
			// decompose the pdata arr
			$data = $this->pdata[$pgnm];
			
				// construct vars
				foreach($data as $dat_k => $dat_v)
				{
					${$dat_k} = $dat_v;
				}
		}
		
		// check if view exists
		if(file_exists($vfile))
		{
			// include the view file
			include $vfile;
		}
		else
		{
			throw new Exception("The view cannot render, view file does not exist");
		}
	}
	
	/**
	 * The json page render
	 * 
	 * @param string $pgnm the file name of the view file to render but data will be presented as a json encoded object
	 * 
	 * @return json_object
 	 */
	function render_json($pgnm)
	{
		// data
		$data = $this->pdata[$pgnm];
		
		// headers
		header('HTTP/1.1 200 OK');
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		// set the content type
		header('Content-type: application/json');
		
		// decompose the pdata arr
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
	function set_data($pgnm, $datnm, array $data)
	{
		// set data => name
		$this->pdata[$pgnm][$datnm] = $data;
	}
}
