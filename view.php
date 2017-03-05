<?php

class View {

	private $smarty = null;
	private $messages = array();
	private $cssFiles = array();
	private $scriptFiles = array();
	
	function __construct() {
		$this -> smarty = new Smarty();
		$this -> smarty -> compile_dir = SMARTY_COMPILE_DIR;
		$this -> smarty -> template_dir = SMARTY_TEMPLATE_DIR;
		//$this -> smarty -> cache_dir = SMARTY_CACHE_DIR;
		$this -> smarty -> cache_dir = SMARTY_TEMPLATE_DIR;
		$this -> assign("app_url", APP_URL);
		$this -> assign("app_img", APP_IMG);
		$this -> assign("app_lib", APP_LIB);
	    //$this -> addLibraryCSS("960/960");
		//$this -> addCSS("reset");
		//$this -> addLibraryCSS("foundation/css/foundation.min");
        //$this -> addLibraryJS("jquery/jquery");
        //$this -> addLibraryJS("foundation/js/foundation.min");
        //$this -> addLibraryJS("foundation/js/foundation/foundation");
        //$this -> addLibraryJS("foundation/js/foundation/foundation.alert");
		//$this -> addJS("global");
		$this -> smarty -> debugging = SMARTY_DEBUG;
	}

	public function display($name)
	{
/*
		this needs to be enabled when Utility::fileExists() start working fine.
		//$this -> addCSS($name);		
		//$this -> addJS($name);
*/
        $this -> assign("scriptFiles", $this -> scriptFiles); //to assign script files
		$this -> assign("cssFiles", $this -> cssFiles); //to assign css files
        $this -> assign("messages", $this -> getMessages()); // to assign the messages that might be added to view
		$this -> smarty -> display($name.".tpl");
	}
	
	public function assign($smarty_variable, $value)
	{
		$this -> smarty -> assign($smarty_variable, $value);
	}
	
	public function addMessage($message)
	{
		if(is_array($message))
			$this -> messages = array_merge($this -> messages, $message);
		else
			$this -> messages = array_merge($this -> messages, array($message));
	}
	
	public function getMessages()
	{
		return $this -> messages;
	}
    
    public function addCSS($cssFiles)
    {
        if(is_array($cssFiles))
		{
			foreach($cssFiles as $cssFile)
			{
				$this -> addCSS($cssFile);
			}
		}
        else
		{
			if(Utility::fileExists(APP_CSS . $cssFiles . ".css"))
			{
				$this-> cssFiles = array_merge($this -> cssFiles, array(APP_CSS . $cssFiles . ".css"));
			}
		}            
    }
	
	public function addJS($scriptFiles)
    {	
        if(is_array($scriptFiles))
		{
			foreach($scriptFiles as $scriptFile)
			{
				$this -> addJS($scriptFile);
			}
		}
        else
		{	
			if(Utility::fileExists(APP_JS . $scriptFiles . ".js"))
			{
				$this-> scriptFiles = array_merge($this -> scriptFiles, array(APP_JS . $scriptFiles . ".js"));
			}
		}
    }
    
    public function addLibraryJS($scriptFiles)
    {
        if(is_array($scriptFiles))
        {
            foreach($scriptFiles as $scriptFile)
            {
                $this -> addLibraryJS($scriptFile);
            }
        }
        else
        {
            if(Utility::fileExists(APP_LIB . $scriptFiles . ".js"))
            {
                $this-> scriptFiles = array_merge($this -> scriptFiles, array(APP_LIB . $scriptFiles . ".js"));
            }
        }
    }
    
    public function addLibraryCSS($cssFiles)
    {
        if(is_array($cssFiles))
        {
            foreach($cssFiles as $cssFiles)
            {
                $this -> addLibraryCSS($cssFile);
            }
        }
        else
        {
            if(Utility::fileExists(APP_LIB . $cssFiles . ".css"))
            {
                $this-> cssFiles = array_merge($this -> cssFiles, array(APP_LIB . $cssFiles . ".css"));
            }
        }
    }
}