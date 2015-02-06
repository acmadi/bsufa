<?
	defined('BASEPATH') or die('Access Denied');
	
	class approval_call extends AdminPage{

		function approval_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Approve Tender Evaluation';
		}
		
		function index($id){
			#extract(PopulateForm());
			$data['tes'] = $this->db->select('mainjob_id,b.no_trbgtproj,mainjob_desc,tgl_proposed,a.mainjob_total,b.kd_bgtproj,b.nilai_proposed,b.id_flag')
									->join('db_trbgtproj b','a.no_trbgtproj = b.no_trbgtproj')
									->where('mainjob_id',$id)
									->group_by('mainjob_id,b.no_trbgtproj,mainjob_desc,tgl_proposed,a.mainjob_total,b.kd_bgtproj,b.nilai_proposed,b.id_flag')
									->get('db_mainjob a')->row();
			
			
			$no = $data['tes']->no_trbgtproj;
			$kode = $data['tes']->kd_bgtproj;
			
			$data['app'] = $this->db->select('sum(nilai_approved) as nilact')
									->join('db_trbgtproj b','a.no_trbgtproj = b.no_trbgtproj')
									->where('mainjob_id',$id)
									->get('db_mainjob a')->row();
									
			
			
			//~ $data['tran'] = $this->db->join('db_bgtproj_update b','a.kode_bgtproj = b.kd_bgtproj')
									//~ ->where('a.no_trbgtproj',$no)
									//~ ->get('db_trbgtproj a')->result();
							//~ 
							
			$data['sql'] = $this->db->query("sp_app_prop '".$no."'")->result();
							
			#$kode = $data['tran']->kd_bgtproj;
			
			
			
			
			
			#die($data['bgt']);exit;
				
			$this->load->view('approval/project/app_proposed',$data);
		}
	}	
