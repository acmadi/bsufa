<?php
	class barangmasuk extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('barangmasuk_model');
			$this->set_page_title('Purchase Verification');
			$this->default_limit = 30;
			$this->template_dir = 'procurement/barangmasuk';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
		}
		
		protected function setup_form($data=false){
			$this->parameters['pr'] = $this->db->where('no_pr','PR-1103/0006')
											   ->get('pr_pnwrvend')->result();
		}
		
		function index(){
			$this->set_grid_column('','',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('kd_supplier','No.PO',array('width'=>50));
			$this->set_grid_column('','Tgl.PO',array('width'=>50));
			$this->set_grid_column('','Kirim Tgl.',array('width'=>50));
			$this->set_grid_column('','Divisi',array('width'=>70));
			$this->set_grid_column('','Reff PR#',array('width'=>50));
			$this->set_grid_column('','Keterangan',array('width'=>100));
			$this->set_grid_column('','Supplier',array('width'=>70));
			$this->set_grid_column('','PIC Supplier',array('width'=>70));
			$this->set_grid_column('','Total',array('width'=>30));
			$this->set_grid_column('','Rp/$',array('width'=>30));
			$this->set_grid_column('','Kurs',array('width'=>30));
			$this->set_grid_column('','Total(IDR)',array('width'=>30));
			$this->set_grid_column('','Pejabat #1',array('width'=>30));
			$this->set_grid_column('','Pejabat #2',array('width'=>30));
			$this->set_grid_column('','Ket. Kirim',array('width'=>30));
			$this->set_grid_column('','Ket. Bayar',array('width'=>30));
			$this->set_grid_column('','User Closing',array('width'=>30));
			$this->set_grid_column('','Tgl. Closing',array('width'=>30));
			$this->set_grid_column('','Alasan PO Batal',array('width'=>30));
			$this->set_grid_column('','User Batal',array('width'=>30));
			$this->set_grid_column('','Tgl. Batal',array('width'=>30));
			$this->set_grid_column('','Input By',array('width'=>30));
			$this->set_grid_column('','Input Date',array('width'=>30));
			$this->set_grid_column('','Edit By',array('width'=>30));
			$this->set_grid_column('','Edit Date',array('width'=>30));
			$this->set_grid_column('','Place of Birth',array('width'=>30));
			$this->set_grid_column('','Sex',array('width'=>30));
			$this->set_grid_column('','Date of Issue',array('width'=>30));
			$this->set_jqgrid_options(array('width'=>1700,'height'=>200,'caption'=>'Purchase Verification','rownumbers'=>true));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}
		
			function crud($oper,$id){
			$xid = str_replace('XD','',$id);
			
			
			switch($oper){
				case 'load':
					$data = $this->db->select('nm_supp,harga_sat,kd_supp,disc')
									 ->where('id_pnwrven',$xid)
									 ->get('pr_pnwrvend')->row();
				break;
				case 'add':
					die("add");
				break;
				case 'edit':
					die("edit");
				break;
				case 'del':
					die("del");
				break;

			}
				//var_dump($data);exit;
				die(json_encode($data));exit;	
		}
		
		
		function mapingbarang($id){
			//die($id);
			$this->load->view('procurement/mapingbarang');
		}
		
		function generatepr($id){
			//die("tes");
			$this->load->view('procurement/generatepr');
		}
		function tambah($nm_supp,$satuan,$qty,$vendor){
			$data = array
			(
				'nm_supp' => $nm_supp,
				'harga_sat' => $satuan,
				'disc' => $qty,
				'alasan' => $vendor,
				'no_pr' => 'PR-1103/0006'
			);
			$this->db->insert('pr_pnwrvend',$data);
			die(json_encode($data));	
			
		}
		
				
		
		
	
	}

