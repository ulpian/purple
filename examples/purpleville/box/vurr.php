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
	public $page;
	
	/**@type array|null aggregated arrays of data to present to the view*/
	public $pdata = [];

	/**@type object| mustache class*/
	public $mustake;
	
	/**
	 * construction to the page name to render and inject
	 * 
	 * @param string $page page name
	 */
	function __construct (string $page = null)
	{
		# if set then set
		if (!empty($page))
		{
			$this->page = $page;
		}

		# mustache class
		$this->mustake = new Mustache_Engine;
	}

	/**
	 * The main page render
	 * 
	 * @param string $page page name, null by default
	 * @param string $suffix format suffix of the file, 'p' by default
	 * @param string $ten the template engine, default is mustache but support for 'twig', 'jinja' and 'none' simple php include with no template, is available
	 */
	function render ($page = null, $suffix = 'p', $ten = 'mustache')
	{	
		# if set then set
		if (!empty($page) & !empty($this->page))
		{
			$this->page = $page;
		}
		elseif (empty($page))
		{
			$page = $this->page;
		}
		else
		{
			$this->page = $page;
		}
		
			# path to view file
			$vfile = 'vi/'.$this->page.'.'.$suffix;
		
		# appinfo data
		$this->appInfo();

		# check if data exists
		if (!empty($this->pdata))
		{
			# decompose the pdata arr
			$data = $this->pdata[$page];
			
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
		# headers
		header('HTTP/1.1 200 OK');
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
		
		# decompose the pdata arr
		$data = json_encode($this->pdata);
		
		return $data;
	}
	
	/**
	 * data -
	 * Binding the data for a specific page
	 * 
	 * @param string $datnm name of the data, this will be the identifier of the data
	 * @param array $data the array of data to bind
	 * @param string $page the file name of the view file to render
	 * 
	 * @return void
	 * @todo return status message
	 */
	function data ($datnm, array $data, string $page = null)
	{
		# if there is an empty page name
		if (empty($page))
		{
			$page = $this->page;
		}

		# set data => name
		$this->pdata[$page][$datnm] = $data;
	}

	/**
	 * plink (page link) -
	 * Binding the page data (page contents include) to a specific page
	 * 
	 * @param string $datnm name of the page data, this will be the identifier of the page data
	 * @param string $ppath name/url path of the page to be linked
	 * @param string $page null by default as the page is usually set before however it can be individually set here
	 * 
	 * @return void
	 * @todo return status message
	 */
	function plink ($datnm, $ppath, string $page = null)
	{
		# if there is an empty page name
		if (empty($page))
		{
			$page = $this->page;
		}

		# appinfo data
		$this->appInfo();

		# get the current data to send to the page before render
		$data = $this->pdata[$page];

		# get the file contents of the page rendered
		$pcon = file_get_contents('vi/'.$ppath);

		$pcon = $this->mustake->render($pcon, $data);

		$plinkarr = [
					'page_uri' => $ppath,
					'content' => $pcon
					];

		# set data => name
		$this->pdata[$page]['page'][$datnm] = $plinkarr;
	}

	/**
	 * appInfo -
	 * implements 'appinfo' block of information about the app that can used anywhere on the page
	 * 
	 * @return void
	 * @todo return status message
	 * @todo ability to add to the appInfo repository, cutome paths
	 */
	function appInfo ()
	{
		$name = $_SERVER['SERVER_NAME'];
		$port = $_SERVER['SERVER_PORT'];
		$httpcon = $_SERVER['HTTP_CONNECTION'];

		# app root
		$app_root = Whiskers::$whisk->root;

		($httpcon = 'keep-alive') ? $protocol = 'http://' : $protocol = 'https://';

		$base_uri = $protocol.$name.':'.$port.$app_root;

		# build appinfo array
		$app_info = [
						'base' => $base_uri,
						'root' => $app_root,
						'box' => $base_uri.'box/'
					];
		
		# set the data to package for the render
		$this->data('app', $app_info);
	}
}