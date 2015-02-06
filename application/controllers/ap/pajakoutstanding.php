<?
	defined('BASEPATH') or die('Access Denied');
	
	class pajakoutstanding extends AdminPage{

		function pajakoutstanding()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			
			
		$this->loadTemplate('report/pajakoutstanding_view');
							
			}
			
		function print_ap(){
			extract(PopulateForm());
			if(@$klik){
			$this->load->view('ap/print/print_pajakoutstanding');
			}else if(@$export){
			$this->loadtemplate('ap/print/print_apaging_excel');		
			}
		}
			
		function cetakapagin(){
		
			

				// $this->load->view('ap/print/print_apagingsum');
				 
			extract(PopulateForm());
			if(@$klik){
			$this->load->view('ap/print/print_apagingsum');
				}else if(@$export){
			$this->loadtemplate('ap/print/print_apaging_excel');		
		}
				 
				 
				 /*
				if($trx=='BM'){ 
					 $this->load->view('cb/print/print_listtranmk');
					 }
				elseif($trx=='BK'){ 
					//die('tes');
					 $this->load->view('cb/print/print_listtranbk');
					}
				elseif($trx=='DF'){ die('DF');}
				elseif($trx == 1){die('ALL');}		
				*/
		}}	
?>
