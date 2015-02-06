<?
	defined('BASEPATH') or die('Access Denied');
	
	class kartuhutang extends AdminPage{

		function kartuhutang()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			
			$data['vendor'] = $this->db->select('kd_supp_gb,nm_supp_gb')
								->order_by('nm_supp_gb','asc')
								->get('pemasokmaster')->result();
	
			$this->parameters=$data;
			
			$this->loadTemplate('report/kartuhutang_view',$data);
							
			}
			
		
	function get_project($id){
		$data = "<option value='0'>All</option>";
		$sql = $this->db->query("select subproject_id,nm_subproject from db_subproject where id_pt = '$id'")->result();
		
		foreach($sql as $row){
		$data .= "<option value='".$row->subproject_id."'>".$row->nm_subproject."</option>";
		}
		die($data);
	}
			
		function cetakapagin(){
		
			

				// $this->load->view('ap/print/print_apagingsum');
				 
			extract(PopulateForm());
			if(@$klik){
			$this->load->view('ap/print/print_apagingsum');
				}else if(@$export){
			$this->loadtemplate('ap/print/print_apaging_excel');		
		}
				 
				 
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
