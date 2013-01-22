<?php
// ---------------------------------------------------
// One line commands for viewing / presenting
// -> render the data into a view page
// -> render data as json page
// ---------------------------------------------------
class vurr
{
	// page name
	public $pgnm;
	
	// page data
	public $pdata = array();
	
	// ---------------------------------------------------
	// Rendering the view to page on vi class
	// -> render to view
	// ---------------------------------------------------
	function render($pgnm)
	{
		// get the pg to access
		$this->pgnm = $pgnm;
		
			// path to view file
			$vfile = 'vi/'.$this->pgnm.'.php';
		
		// decompose the pdata arr
		$data = $this->pdata[$pgnm];
		
			// construct vars
			foreach($data as $dat_k => $dat_v)
			{
				${$dat_k} = $dat_v;
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
	
	// ---------------------------------------------------
	// JSON redering of data
	// -> render the data as a json page
	// ---------------------------------------------------
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
	
	// add data for the view / presentation
	function set_data($pgnm, $datnm, array $data)
	{
		// set data => name
		$this->pdata[$pgnm][$datnm] = $data;
	}
}
