<?php
class cashplaningx extends DBController{
	function __construct(){
		parent::__construct('cashplaningx_model');
		$this->set_page_title('Cash Planing ');
		$this->default_limit = 30;
		$this->template_dir = 'cb/cashplaningx';

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
		 $this->set_custom_function('doc_date','indo_date');
		 $this->set_custom_function('inv_date','indo_date');
		 $this->set_custom_function('plan_date','indo_date');
		 $this->set_custom_function('trx_amt','currency');
		 $this->set_custom_function('plan_amount','currency');
		 $this->set_custom_function('malloc_amt','currency');
		 $this->set_custom_function('mdoc_amt','currency');
		// $this->set_custom_function('pay_unidenti','currency');
		
		parent::get_json();
	}
	
	function index(){
		$this->set_grid_column('apinvoice_id','id',array('hidden'=>true,'key'=>true));
		$this->set_grid_column('doc_no','AP No',array('width'=>50,'align'=>'Left' ,'formatter' => 'cellColumn'));
		$this->set_grid_column('nm_supplier','Supplier',array('width'=>80,'align'=>'Left', 'formatter' => 'cellColumn'));
		$this->set_grid_column('doc_date','AP Date',array('width'=>50,'align'=>'Left', 'formatter' => 'cellColumn'));
		// $this->set_grid_column('inv_no','Invoice',array('width'=>50,'align'=>'left', 'formatter' => 'cellColumn'));
		// $this->set_grid_column('inv_date','Invoice Date',array('width'=>60,'align'=>'left', 'formatter' => 'cellColumn'));
		$this->set_grid_column('descs','Description',array('width'=>100,'align'=>'left', 'formatter' => 'cellColumn'));
		$this->set_grid_column('plan_date','Plan Date',array('width'=>50,'align'=>'left', 'formatter' => 'cellColumn'));
		$this->set_grid_column('plan_amount','Plan Amount',array('width'=>50,'align'=>'right', 'formatter' => 'cellColumn'));		
		$this->set_grid_column('trx_amt','Amount',array('width'=>50,'align'=>'right', 'formatter' => 'cellColumn'));		
		$this->set_grid_column('malloc_amt','Paid',array('width'=>50,'align'=>'right', 'formatter' => 'cellColumn'));		
		$this->set_grid_column('mdoc_amt','Balance',array('width'=>50,'align'=>'right', 'formatter' => 'cellColumn'));		
		$this->set_jqgrid_options_ceklist(array('width'=>1500,'height'=>400,'caption'=>'Cash Planning','rownumbers'=>true,'sortname'=>'apinvoice_id','sortorder'=>'DESC'));
		parent::index();
	}


	function saveplan(){
		extract(PopulateForm());
		
		$id_ap = $this->input->post('id_ap');
		$plan_date = $this->input->post('tgl');
		$plan_amount = $this->input->post('amount');
		
		$data = array
		(
			'id_ap'=> $id_ap,
			'plan_date'=> $plan_date,
			'plan_amount'=> replace_numeric($plan_amount)
		);

		$this->db->insert('db_cashplan',$data);
		redirect('cashplaningx');
	}		
	
	function approve($id){		
	
			extract(PopulateForm());
	
			$cek_plan = $this->db->select('id_ap as id')
							   ->where('id_ap',$id)
							   ->get('db_cashplan')->row();
							   
			if($cek_plan->id == NULL ){
			echo"
				<script type='text/javascript'>
					alert('Input Payment Plan Dahulu !!');
					refreshTable();
				</script>
			";
		}else{

			$jml=strlen($id);
            $a=explode(',',$id);
            $ja=count($a);
            for($i=0;$i<$ja;$i++){
                $q=$this->db->query("Update db_apinvoice  set status=2 WHERE apinvoice_id='$a[$i]'");
            }	
					// $query = $this->db->query("sp_approveGL '".$id."'");
					 echo"
                                                <script type='text/javascript'>
                                                            alert('Planning Sukses');
                                                            window.close();
															 refreshTable();
                                                </script>
                                     ";        
			}									 
                        }         	
	function planning($id){
		
			$cek_plan = $this->db->select('count(id_ap) as id')
							   ->where('id_ap',$id)
							   ->get('db_cashplan')->row();
							   
			if($cek_plan->id == 2 ){
			echo"
				<script type='text/javascript'>
					alert('Payment Plan sudah dilakukan');
					refreshTable();
				</script>
			";
		}elseif($id == NULL ){
			echo"
				<script type='text/javascript'>
					alert('Pilih Data dahulu !!');
					refreshTable();
				</script>
			";
		}else{
		
		
		
			$data['id'] = $id;
			$data['row'] = $this->db->select('convert(varchar,CONVERT(money, (db_apinvoice.trx_amt-isnull(db_apinvoicedet.pph,0))),1) as trx_amt')
											->join('db_apinvoicedet', 'db_apinvoicedet.doc_no = db_apinvoice.doc_no')
										->where('apinvoice_id',$id)
										->get('db_apinvoice')->row();
										
										
			$this->load->view('cb/cashplaningx-planning',$data);
			}
	}	
	
	// function saveplan($id){
			// die($id);
	
		// //	$this->load->view('cb/cashplaning-planning');
	// }	
}

