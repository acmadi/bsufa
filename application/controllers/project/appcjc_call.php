<?
	defined('BASEPATH') or die('Access Denied');
	
	class appcjc_call extends AdminPage{

		function workinginst_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Approve CJC';
		}
		
		function index($id){	
			//~ $data ['data'] = $this->db->where('id_cjc','57')
									//~ ->get('db_cjc')->row();
			//~ 
			$data ['data'] = $this->db->where('id_cjc',$id)
									->get('db_cjc')->row();
			
			$idkontrak = $data ['data']->id_kontrak;
			$data ['view'] = $this->db->where('id_kontrak',$idkontrak)
									->get('db_kontrak')->row();
			
			$data['sql'] = $this->db->select('sum(claim_amount) as tot')
									->where('id_kontrak',$idkontrak)
									->where('flag_id','1')
									->get('db_cjc')->row();
									
			$this->load->view('approval/project/app_appcjc',$data);
		}
	}	
