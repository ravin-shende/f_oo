<?php

abstract class Model
{

	protected $db = null;

	public $messages = array();

	private $state = true;	

	public function __construct()
	{
		if($this -> db == null)
		{
			$this -> db = new ezSQL_mysql();
		}
		$this -> db -> debug_all = EZ_SQL_DEBUG;
		//return $this -> db;
		// $this -> db = Utility::getDB();
	}

	public function getState()
	{
		return $this -> state;
	}

	public function getMessages()
	{
		return $this -> messages;
	}

	public function addMessage($message)
	{
		if(is_array($message))
		{
			$this -> messages = array_merge($this -> messages, $message);
		}
		else
		{
			$this -> messages = array_merge($this -> messages, array(
				$message
			));
		}
		
		if($message instanceof Message && $this -> state == true && $message -> getType() == Message::error)
		{
			$this -> state = false;
		}
	}
	
	public static function import($model){
		require_once(DISK_PATH_PROJ_DIR . MODELS_DIR . $model . '.php');
	}

	abstract public function dbToObj($db_record);	
}