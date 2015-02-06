<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mpettycash_call extends AdminPage {

	function mpettycash_call()
	{
		parent::AdminPage();
		$this->pageCaption = 'User Page';
	}
	
	function index(){	
		$this->loadTemplate('cb/mpettycash_view');
	}

}

/* End of file mpettycash_call.php */
/* Location: ./application/controllers/mpettycash_call.php */