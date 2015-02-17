<?
	defined('BASEPATH') or die('Access Denied');
	
	class cetakmutasibank_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$session = $this->UserLogin->isLogin();
			$pt = $session['id_pt'];
			
			$type = array('BM', 'BK');
			$data['trxtype'] = $this->db->select('trx_type,descs')
								->where_in('trx_type',$type)
								->get('db_trxtype')->result();
	
			$t = 'select * from db_bank where id_pt = '.$pt;
			$data['bank'] = $this->db->query($t)->result();
			
			
			$this->parameters=$data;
			$this->loadTemplate('cb/cetakmutasibank_view');
							
			}
			
		function cetakmutasi(){
		
			extract(PopulateForm());

				$data['trx'] = $trx;
				$data['project_detail'] = $project_detail;
				$data['startdate'] = $startdate;
				$data['enddate'] = $enddate;
				$data['bank'] = $bank;

				 $this->load->view('cb/print/print_listtranmk',$data);
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
