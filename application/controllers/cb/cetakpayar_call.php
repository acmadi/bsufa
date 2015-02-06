<?
	defined('BASEPATH') or die('Access Denied');
	
	class cetakpayar_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	

			$session_id = $this->UserLogin->isLogin();
			$id_pt = $session_id['id_pt'];

			$data['project'] = $this->db->query("select * from db_subproject where id_pt = ".$id_pt." ")->result();
			
			$data['vendor'] = $this->db->select('kd_supp_gb,nm_supp_gb')
								->order_by('nm_supp_gb','asc')
								->get('pemasokmaster')->result();
	
			$this->parameters=$data;
			
			$this->loadTemplate('cb/cetakpayar_view',$data);
							
			}
			
		function cetakpayar(){
		
			

				 $this->load->view('cb/print/print_listpayar');
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
