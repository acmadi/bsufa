<?
	defined('BASEPATH') or die('Access Denied');
	
	class cetakapaging_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			
			$data['vendor'] = $this->db->select('kd_supp_gb,nm_supp_gb')
								->order_by('nm_supp_gb','asc')
								->get('pemasokmaster')->result();
	
			$this->parameters=$data;
			
			$this->loadTemplate('ap/cetakapaging_view',$data);
							
			}
			
		function cetakapagin(){
		
			

				// $this->load->view('ap/print/print_apagingsum');
				 
			extract(PopulateForm());
			if(@$klik){
			$this->load->view('ap/print/print_apagingsum');
				}else if(@$export){
			$this->load->view('ap/print/print_apaging_excel');		
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
