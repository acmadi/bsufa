<?php
class komisi extends DBController{
	function __construct(){
		parent::__construct('komisi_model');
		$this->set_page_title('Generate Komisi');
		$this->template_dir = 'sales/komisi';

	}

	protected function setup_form($data=false){
		$arr = array(1,2,3,4,5,6);
		$this->parameters['currency'] = $this->db->where('status',1)
											  ->get('db_currency')->result();
		$this->parameters['spec'] = $this->db->where_in('spec_id',$arr)
											 ->get('db_spec')->result();	
		$this->parameters['type'] = $this->db->where_in('type_id',$arr)
											 ->get('db_typeacc')->result();											 
	}

	function get_json(){
		$this->set_custom_function('tgl_proses','indo_date');
		// $this->set_custom_function('pay_date','indo_date');
		// $this->set_custom_function('amount_unidenti','currency');
		// $this->set_custom_function('pay_unidenti','currency');
		parent::get_json();
	}
	
	function index(){
		$this->set_grid_column('id_proses','ID',array('hidden'=>true));
		$this->set_grid_column('tgl_proses','Date',array('width'=>40,'align'=>'Left'));
		$this->set_grid_column('id_user','User',array('width'=>60,'align'=>'Left'));		
		$this->set_jqgrid_options(array('width'=>800,'height'=>300,'caption'=>'Generate Komisi','rownumbers'=>true,'sortname'=>'id_proses','sortorder'=>'ASC'));
		parent::index();
	}


	function simpan(){
		extract(PopulateForm());
		// //Cek Account Bank
		// $cekbank = $this->db->select('bank_coa,bank_nm')
							// ->where('bank_id',$bank)
							// ->get('db_bank')->row();
		//Simpan data
		$data = array
		(
			'acc_no'=> $acc_no,
			'acc_name'=> $acc_name,
			'level'=> $level,
			'type'=>$type,
			'group_acc'=>$group,
			'currency_cd'=>$currency,
			'status'=>$status
		);
		$this->db->insert('db_coa',$data);
		redirect('coa');
	}		
	
	function generate($id){                          
	
					$session_id = $this->UserLogin->isLogin();
					$user = $session_id['username'];
					$pt	= $session_id['id_pt'];
						
					$query = $this->db->query("sp_hitungkomisi '".$user."',".$pt."");
					 echo"
                                                <script type='text/javascript'>
                                                            alert('Generate Berhasil');
                                                            window.close();
															refreshTable();
                                                </script>
                                    ";                                              
                        }     

	function reportlisting($id){           
					
					//die($id);
					
					$dtprv['id'] = $id;
			
					$this->load->view('sales/print/print_reportkomisi',$dtprv);
					
		                                        
                        }     
						
		function reportexcel($id){           
					
					//die($id);
					
					$dtprv['id'] = $id;
			
					$this->load->view('sales/excel/print_komisi_excel',$dtprv);
					
		                                        
                        }     
	
}

