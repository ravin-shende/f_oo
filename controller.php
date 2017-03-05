<?php

abstract class Controller {

	protected $view = null;
	
	function __construct() {
		$this -> view = new View();
	}
}