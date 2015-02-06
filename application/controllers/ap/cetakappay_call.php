<?
	defined('BASEPATH') or die('Access Denied');
	
	class cetakappay_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->pt	= $session_id['id_pt'];
			
			$data['vendor'] = $this->db->select('kd_supp_gb,nm_supplier')
																											->join('db_subproject','kd_project = subproject_id')
																											->where('pt_id',$this->pt)
                                                                                                            ->order_by('kd_supp_gb','ASC')
                                                                                                            ->get('pemasok')
                                                                                                            ->result();	
			$data['project'] = $this->db->select('subproject_id,nm_subproject')
																											->where('id_pt',$this->pt)
                                                                                                            ->order_by('subproject_id','ASC')
                                                                                                            ->get('db_subproject')
                                                                                                            ->result();	

			$this->parameters=$data;
			
			$this->loadTemplate('ap/cetakappay_view',$data);
							
			}
			
		function cetakappay(){
		
			extract(PopulateForm());
			if(@$klik){
			$this->load->view('ap/print/print_listappay');	
				}else if(@$export){
			$this->load->view('ap/print/print_listappay_excel');		
		}

				// $this->load->view('ap/print/print_listappay');
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
