<?php
	defined('BASEPATH') or die('Access Denied');
	
	class trans_budget_call extends AdminPage{

		function mstdivisi_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Transaksi Budget';
		}
		
		function index(){	
			$this->loadTemplate('accounting/trans_budget-call');
		}}		


