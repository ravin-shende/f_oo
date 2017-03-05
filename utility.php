<?php

class Message
{
    private
    $type = null,
    $value = null;

    const
    success = "success",
    warning = "warning",
    error = "alert",
    info = "info";
     
    public function __construct($type, $value)
    {
        $this -> type = $type;
        $this -> value = $value;
    }

    public function getMessage()
    {
        return $this -> value;
    }

    public function getType() {
        return $this -> type;
    }
}

class Timer
{
    public static $previous;
    public static $current;

    public static function mark()
    {
        $time = microtime();
        $time = explode(' ', $time);
        $time = $time[1] + $time[0];
        self::$current = $time;
        if(self::$previous == null)
        {
            self::$previous = self::$current;
        }
        else
        {
            echo("Section generated in ".round((self::$current - self::$previous), 6)." seconds.");
        }
    }
}

class Utility
{
	/*
	private static $db = null;
	public static function getDB()
	{
		if(self::$db == null)
		{
			self::$db = new ezSQL_mysql();
		}
        self::$db -> debug_all = EZ_SQL_DEBUG;
		return self::$db;
    }
    */
    
	/*
    public static function importModel($model){
    	require_once(DISK_PATH_PROJ_DIR . MODELS_DIR . $model . '.php');
    }
    */
	
	
    public static function setLocation($location){
        header('location: ' . APP_URL . $location);
    }
	
	public static function setSessionVariable($varname, $value)
	{
		$_SESSION[$varname] = serialize($value);
	}
	
	public static function getSessionVariable($varname)
	{
		return unserialize($_SESSION[$varname]);
	}
	
	public static function getPostVariable($varname)
	{
        /*
         unserialize does not work if the requesting paramter is array. 
         * example: it will not work if we want a DOM checkbox to unserialize
         * because we cannot unserialize array, we can unserialize individual 
         * element of the array
         * 
         * unserializing serialized variable fails. 
         */
	    
	    /*
        $post = $_POST[$varname];
        if(is_array($post) == false) {
            if(unserialize($_POST[$varname]) == false) {
                return $post;
            }
            else {
                return unserialize($post);
            }            
        }
        else {
            return $post;
        }*/
		if(isset($_POST[$varname]) && $_POST[$varname] != null)
			return $_POST[$varname];
	}
	
	public static function debug($variable, $local_debug = 0)
	{
	
		if ($local_debug || GLOBAL_DEBUG)
			echo($variable.'<br />');
/*		
		if (GLOBAL_DEBUG)
			echo($variable."<br />");
*/				
	}
	
	/*
	public static function getVar($object, $attribute)
	{
		$class_vars = get_class_vars(get_class($my_class));	
	}
	*/
	
	public static function isEmpty($arr)
	{
		return empty($arr);
	}
	
	public static function isUserValid()
	{
		if(Utility::getSessionVariable('user') == null)
		{
			header('location: index/login');
		}
	}
	
	public static function fileExists($file)
	{
        //@todo fopen times out and takes a lot of time to verify if a file exits on server.
		return true;
		/*
		if(@fopen($file, 'r'))
			return true;
		else
			return false;
		*/			
		//return (fopen($file,'r')==true);
	}
}