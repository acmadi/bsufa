<?
	defined('BASEPATH') or die('Access Denied');
	
	class hrdreport extends AdminPage{

		function sumary()
		{
			#die("tes oi");
			
			$data['div'] = $this->db->where('id_pt',11)->order_by('divisi_id','asc')->get('db_divisi')->result();
			#var_dump($data['div']);
			
			
			
			$this->parameters=$data;
			$this->loadTemplate('hrd/summaryleaving_view',$data);
			
		}
		
		function leaving(){
			$data['div'] 	= $this->db->where('id_pt',11)->order_by('divisi_id','asc')->get('db_divisi')->result();
			$data['kary'] 	= $this->db->where('id_pt',11)->order_by('nama','asc')->get('db_kary')->result();
			
			
			$this->parameters=$data;
			$this->loadTemplate('hrd/leavingemployee_view',$data);
		}
		
		function print_leaving(){
			extract(PopulateForm());
			#die($div);
			$data['div'] = $div;
			$data['kary'] = $kary;
			$data['tgl1'] = $tgl1;
			//$data['tgl2'] = $tgl2;
			
			$this->parameters=$data;
			$this->load->view('hrd/print/leavingperemployee',$data);
		}
		
		function print_sumary(){
			extract(PopulateForm());
			#die($div);
			$data['div'] = $div;
			$data['years'] = $years;
			
			$this->parameters=$data;
			$this->load->view('hrd/print/cutidetail',$data);
		}
	
		function index(){	
		die('Ga bisa');
		}
		
		
		function allleaving(){
			$this->loadTemplate('hrd/allreportallowance_view');
			
			
		}
		
		function print_allleaving(){
			extract(PopulateForm());
			#die($div);
			
			$data['years'] = $years;
			
			
			$this->load->view('hrd/print/allemployee_leavingalowance',$data);
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
					case 'div':
						$sql = $this->db->select('divisi_id id,divisi_nm nama')
										->where('id_pt','11')
										->order_by('divisi_nm','ASC')
										->get('db_divisi')->result();
						break;
						
						
					case 'kary' :
						$sql = $this->db->select('id_kary id,nama nama')
				//						->join('db_unit_yogya','unit_no = id_unit')
										->where('id_divisi',$parent_id)
										->where('isnull(id_flag,0) !=',10)
										->order_by('nama','ASC')
										->get('db_kary')->result();
						break;
				
						
					
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
		
		function cutidetail(){
			$this->load->view('cutidetail');
		}
		
	}		
?>
