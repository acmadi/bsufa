<?php
class closing extends DBController{
	function __construct(){
		parent::__construct('closing_model');
		$this->set_page_title('Closing Month');
		$this->template_dir = 'gl/closing';

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
		 $this->set_custom_function('trans_date','indo_date');
		// $this->set_custom_function('pay_date','indo_date');
		// $this->set_custom_function('amount_unidenti','currency');
		// $this->set_custom_function('pay_unidenti','currency');
		parent::get_json();
	}
	
	function index(){
		$this->set_grid_column('id_acct','ID',array('hidden'=>true));
		$this->set_grid_column('nm_pt','Company',array('width'=>40,'align'=>'Left'));
		$this->set_grid_column('acc_period','Periode',array('width'=>60,'align'=>'Left'));		
		$this->set_jqgrid_options(array('width'=>800,'height'=>300,'caption'=>'Closing Month','rownumbers'=>true,'sortname'=>'id_acct','sortorder'=>'ASC'));
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
	
	function approve($id){                          
					$query = $this->db->query("sp_closingmonth '".$id."'");
					 echo"
                                                <script type='text/javascript'>
                                                            alert('Closing Berhasil');
                                                            window.close();
															refreshTable();
                                                </script>
                                    ";                                              
                        }     

	function unclose($id){                          
					$query = $this->db->query("sp_unclosingmonth '".$id."'");
					 echo"
                                                <script type='text/javascript'>
                                                            alert('UnClosing Berhasil');
                                                            window.close();
															refreshTable();
                                                </script>
                                    ";                                              
                        }         
	
}

