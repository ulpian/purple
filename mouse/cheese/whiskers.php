<?php
// ---------------------------------------------------
// Whiskers
// -> whiskers package management
// -> whiskers config and env var chk
// ---------------------------------------------------
class Whiskers
{
	// private status
	protected $db_stat;
	protected $sc_stat;
	
	// whisk
	static $whiskers_rt;
	static $whisk;
	
	// ---------------------------------------------------
	// On construct
	// -> run whiskers.json check - wpm()
	// -> run status check
	// ---------------------------------------------------
	function __construct()
	{
		// save path
		Whiskers::$whiskers_rt = 'whiskers.json';
		
		if(file_exists(Whiskers::$whiskers_rt))
		{
			// read file into array
			Whiskers::$whisk = json_decode(file_get_contents(Whiskers::$whiskers_rt));
			
			// check root
			Whiskers::rootchk();
		}
		else
		{
			// need whiskers or turn off in configuration
			throw new Exception("missing whiskers file, if you do not want whiskers, turn off this feature in your configuration");
		}
	}
	
	// ---------------------------------------------------
	// static Whiskers Packege Manager (wpm) status
	// -> see if dependencies have been updated
	// ---------------------------------------------------
	static function wpm_den_stat()
	{
		// check if curr.den file exists
		if(file_exists('mouse/cheese/den/curr.den.json'))
		{
			// check if there is any difference
			if(json_decode(file_get_contents('mouse/cheese/den/curr.den.json')) == Whiskers::$whisk->den)
            {
                // no change
                // *** WIP
            }
            else
            {
                // some change
                // *** WIP
            }
		}
	}
	
	// ---------------------------------------------------
	// Checking root of the server to update .htaccess Rewritebase
	// -> update if in different root
	// ---------------------------------------------------
	static function rootchk()
	{
		// check to see if path is changed
		$rootpath = Whiskers::$whisk->root;
		
		if(file_exists('.htaccess'))
		{
			if($rootpath == 'root')
			{
				// need for Rewritebase
				$hta_f = fopen('.htaccess','w') or die("cannot open .htaccess file");
				
$htac = "
RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-l
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d

RewriteRule ^([a-zA-Z0-9]+) index.php?page=$1 [L,NC]
";
				
				fwrite($hta_f,$htac);
				
				fclose($hta_f);
			}
			else
			{
				// clean rootpath
				if(!Whiskers::cleanroothpath($rootpath) == NULL)
				{
					// cleaned rootpath
					$rootpath = Whiskers::cleanroothpath($rootpath);
					
					// need for Rewritebase
					$hta_f = fopen('.htaccess','w') or die("cannot open .htaccess file");
					
				$htac = "
RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-l
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d

Rewritebase ".$rootpath."

RewriteRule ^([a-zA-Z0-9]+) index.php?page=$1 [L,NC]
";
					
					fwrite($hta_f,$htac);
					
					fclose($hta_f);
				}
			}
		}
	}
		// ---------------------------------------------------
		// .htaccess Rewritebase rootpath cleanup
		// -> make some security checks *
		// ---------------------------------------------------
		// htaccess commands
		static $hta_cm = array
		(
			"RewriteEngine on","RewriteRule","RewriteCond",
			"RedirectMatch","ErrorDocument","AuthUserFile",
			"AuthGroupFile","AuthName","AuthType",
			"AddType","AddHandler","Options",
			"AddHandler","order","deny",
			"allow","DirectoryIndex","Redirect",
			"IndexIgnore");
		
		static function cleanroothpath($rootpath)
		{
			// check if folders / special symb
			if(
				strpos($rootpath, '/') != FALSE 
				|| 
				strpos($rootpath, '#') != FALSE
				|| 
				strpos($rootpath, '>') != FALSE
				|| 
				strpos($rootpath, '<') != FALSE 
				& 
				!in_array($rootpath, Whiskers::$hta_cm)
			)
			{
				// has slashes so there is
				return utf8_encode(htmlentities($rootpath));
			}
			else
			{
				// return nothing
				return NULL;
			}
		}
}
