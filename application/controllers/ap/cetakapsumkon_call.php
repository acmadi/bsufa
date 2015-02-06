<?
	defined('BASEPATH') or die('Access Denied');
	
	class cetakapsumkon_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			
			$data['proj'] = $this->db->select('subproject_id,nm_subproject')
								->where('pt_id = 44')
								->get('db_subproject')->result();
			$data['category'] = $this->db->select('id_kelusaha,nm_kelusaha')
								->order_by('nm_kelusaha','asc')
								->get('db_kelusaha')->result();
			
			$this->parameters=$data;
			
			$this->loadTemplate('ap/cetakapsumkon_view',$data);
							
			}
			
			
			

			
			
			
		function cetakapsumkon(){
		
			

				 $this->load->view('ap/print/print_listapagingsumkon');
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
