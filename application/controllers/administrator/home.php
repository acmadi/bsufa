<?php
	defined('BASEPATH') or die('Access Denied');
		
	class Home extends AdminPage {

		function Home()
		{
			parent::AdminPage();
			$this->pageCaption = 'Administrator Page';
		}
		
		function index()
		{
			$this->loadTemplate('administrator/home_view');
		}
	}
?>
