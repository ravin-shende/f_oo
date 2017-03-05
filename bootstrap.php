<?php

class Bootstrap {
	
    function __construct() {
    	if(!isset($_GET['url'])) 
    	{
    		$url = DEFAULT_CONTROLLER;
    	}
    	else 
    	{
    		$url = $_GET['url'];
    	}
	
	$url = rtrim($url, '/');
	$url = explode('/', $url);
	$file = CONTROLLERS_DIR . $url[0] . '.php';	
	require_once($file);
	$controller = new $url[0];	
	
		switch (count($url)) {
			case 1:
				return $controller -> index();
			case 2:
				return $controller -> {$url[1]}();
			case 3:
				return $controller -> {$url[1]}($url[2]);
			case 4:
				return $controller -> {$url[1]}($url[2], $url[3]);
			case 5:
				return $controller -> {$url[1]}($url[2], $url[3], $url[4]);
			case 6:
				return $controller -> {$url[1]}($url[2], $url[3], $url[4], $url[5]);
		}	
     }
}