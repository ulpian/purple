<?php
# get the router
require_once 'box/router.php';

$route = new router;

try
{
	# bake our route
	$route->bake();
}
catch (Exception $ex)
{
	echo '<b>Warning</b>: '.$ex->getMessage()."\n";
}