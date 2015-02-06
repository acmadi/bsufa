<?php
	defined('BASEPATH') or die('Access Denied');
	
	class trans_app_call extends AdminPage{

		function trans_app_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'List Approved Budget';
		}
		
		function index(){	
			$this->loadTemplate('accounting/trans_app-call');
		}}		



