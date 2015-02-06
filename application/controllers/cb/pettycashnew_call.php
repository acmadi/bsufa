<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pettycashnew_call extends AdminPage {

	function pettycashnew_call()
	{
		parent::AdminPage();
		$this->pageCaption = 'User Page';
	}
	
	function index(){	
		$this->loadTemplate('cb/pettycashnew_view');
	}

}