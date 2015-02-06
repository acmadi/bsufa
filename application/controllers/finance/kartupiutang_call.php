<?
	defined('BASEPATH') or die('Access Denied');
	
	class kartupiutang_call extends AdminPage{

		function kartupiutang_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
		
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->pt	= $session_id['id_pt'];
		
		
			$data['subproject'] = $this->db->select('subproject_id,nm_subproject')
																											->where('pt_id',12)
                                                                                                            ->order_by('subproject_id','ASC')
                                                                                                            ->get('db_subproject')
                                                                                                            ->result();		
		
			
			$data['account'] = $this->db->select('acc_no,(acc_no +"  ||  "+ acc_name) as acc_name')
								->where('type','2')
								->order_by('acc_no','asc')
								->get('db_coa')->result();
	
			$this->parameters=$data;
			
			$this->loadTemplate('finance/kartupiutang_view',$data);
							
			}
			
		function loaddata(){
		#die($this->input->post('parent_id'));
		if($this->input->post('data_type')){
			$data_type = $this->input->post('data_type');
			$parent_id = $this->input->post('parent_id');
			$session_id = $this->UserLogin->isLogin();
			$session_cus = $this->input->post('subproject');
			$pt = $session_id['id_pt'];
			$a=44;
			//die($a);
			switch($data_type){
				
				case 'subproject':
					$sql = $this->db->select('subproject_id id,nm_subproject nama')
									//->where('id_pt',$pt)
								->where('pt_id',12)
									//->order_by('nm_subproject','ASC')
									 ->get('db_subproject')->result();
						break;
					
				case 'unid':
						$sql = $this->db->select("unidentiacc_id id,convert(varchar, CAST((amount_unidenti-pay_unidenti) as money), 1) + ' ( ' + 
										convert(varchar,received_date,105) + ' ) ' + reference nama")
										//->where('id_paysource',$parent_id)
										->where('id_pt',$pt)
										->where('(amount_unidenti-pay_unidenti) >',0)
										->get('db_unidentified')->result();					
					break;	
				
				case 'unit' :
				
						$sql = $this->db->select('id id,(kd_tenant +"  ||  "+ customer_nama) nama')
										->join('db_customer','customer_id = id_customer','left outer')
										
										->where('id_subproject',$parent_id)
										->where('status !=',10)
										//->group_by('id')
									->order_by('kd_tenant','ASC')
										->get('db_loo_sewa')->result();
				
				
						// $sql = $this->db->select('id id,kd_tenant nama')
										// ->where('id_subproject',$parent_id)
										// //->where('status','3')
										// ->order_by('kd_tenant','ASC')
										// ->get('db_loo_sewa')->result();
						break;
							
					
						
					case 'customername' :
						$sql = $this->db->select('customer_nama,customer_hp,customer_alamat1')
										//->join('db_loo_sewa','nounit = id')
										->join('db_customer','customer_id = id_customer')
										//->where('status','3')
										->where('id',$parent_id)
										->get('db_loo_sewa')->result();
					break;
					case 'periode':
						$sql = $this->db->select('denda_periode id,denda_periode nama')
										->where('denda_unit',$parent_id)
										->get('db_denda')->result();
						//var_dump($sql);exit;
					break;
					case 'denda_unit' :
						$sql = $this->db->select('distinct(denda_unit) id,denda_unit nama')
										->where('id_customer',$parent_id)
										->get('db_denda')->result();
					break;	
					case 'project_denda':
						$sql = $this->db->select('distinct(db_denda.id_project) id_project,nm_subproject nama')
										->where('db_subproject.id_pt',$pt)
										->join('db_subproject','subproject_id = db_denda.id_project')
										->get('db_denda')->result();
					break;
					
					
									
					case 'project':
					default:
					    $sql = $this->db->select('subproject_id id,nm_subproject nama')
										->where('id_pt',$pt)
										->order_by('nm_subproject','ASC')
										->get('db_subproject')->result();
					break;
					
					case 'bank':
					if($pt == 44){
						$sql = $this->db->select('bank_id id,bank_nm nama')
										->where('id_pt',$pt)
										->get('db_bank')->result();
					
					break;}
						else{
						$sql = $this->db->select('bank_id id,bank_nm nama')
										->where('id_pt',$pt)
										->where('remark','leasing')
										->get('db_bank')->result();
					
						
						break;}
					
				}
				$response = array();
				if($sql){
					foreach($sql as $row){
						$response[] = $row;
					}
				}else{
					$response['error'] = 'Data kosong';
				}
				die(json_encode($response));exit;
			}
		}
			
		function cetakkartupiutang(){
		
			

				 $this->load->view('finance/print/print_kartupiutang_periode');
		}}	
?>
