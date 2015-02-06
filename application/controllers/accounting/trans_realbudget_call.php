<?php
	defined('BASEPATH') or die('Access Denied');
	
	class trans_realbudget_call extends AdminPage{

		function mstdivisi_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Transaksi Budget';
		}
		
		function index(){	
			$this->loadTemplate('accounting/trans_realbudget-call');
		}}		


