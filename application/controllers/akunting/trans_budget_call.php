<?
	defined('BASEPATH') or die('Access Denied');
	
	class trans_budget_call extends AdminPage{

		function trans_budget_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('Acc/trans_budget_call');
		}}		
