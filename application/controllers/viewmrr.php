<?php
	class viewmrr extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('viewmrr_model');
			$this->set_page_title('Material Receipt');
			$this->default_limit = 30;
			$this->template_dir = 'procurement/viewmrr';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->id = $session_id['id'];
			$this->pt = $session_id['id_pt'];
			$this->div = $session_id['divisi_id'];
			
		}
		
		protected function setup_form($data=false){
			//Pengecekan No MRR
			$pt = $this->pt;
			$div = $this->div;
			$chkmrr = $this->db->query("sp_cek_mrr_no ".$pt.",".$div."")->row();
			$this->parameters['no_mrr'] = $chkmrr->no_mrr;
		}

		function get_json(){
			$this->set_custom_function('tgl_mrr','indo_date');
			parent::get_json();
		}		
		
		function index(){
			$this->set_grid_column('BrgMsk_ID','POH',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('no_po','Reff PO',array('width'=>120,'formatter' => 'cellColumn'));
			$this->set_grid_column('no_mrr','No.MRR',array('width'=>120,'formatter' => 'cellColumn'));
			$this->set_grid_column('tgl_mrr','Tgl.MRR',array('width'=>90,'formatter' => 'cellColumn'));		
			$this->set_grid_column('nm_brg','Nama Barang',array('width'=>90,'formatter' => 'cellColumn'));		
			#$this->set_grid_column('qtyPO','QTY',array('width'=>40,'formatter' => 'cellColumn'));		
			$this->set_grid_column('qtyMsk','QTY Masuk',array('width'=>40,'formatter' => 'cellColumn'));		
			$this->set_jqgrid_options(array('width'=>1200,'height'=>400,'caption'=>'Material Receipt','rownumbers'=>true));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}
		
		function get_dg($idpo){
			$ckdata = $this->db->select('BrgPOD_ID,BrgPOH_ID,kd_brg,nm_brg,qty,satuan,qtybuy')
							   ->where('BrgPOH_ID',$idpo)
							   ->get('db_barangpod')->result();
			$data = array();
			foreach($ckdata as $row){
				$sisa = $row->qty - $row->qtybuy;
				$data[] = array 
				(
					'id' => $row->BrgPOD_ID,
					'kode' => $row->kd_brg,
					'brg' => $row->nm_brg,
					'qty_po' => number_format($row->qty),
					'out_po' => number_format($sisa),
					'qty_rc' => number_format($row->qtybuy),
					'satuan' => $row->satuan,
					'masuk' => ''
				);
			}
			die(json_encode($data));exit;
			
		}
		
		function show_mrr($idpo){
			$this->load->view('procurement/show_mrr');
		}
		
		
		//CRUD GRID
		function save_dg($id=false){
			$kode = $_REQUEST['kode'];
			$brg = $_REQUEST['brg'];
			$qty_po = $_REQUEST['qty_po'];
			$qty_rc = $_REQUEST['qty_rc'];
			$out_po = $_REQUEST['out_po'];
			$satuan = $_REQUEST['satuan'];
			$masuk = $_REQUEST['masuk'];
			
			$qtybuy = $qty_rc + $masuk;
			$data = array 
				(
					'qtybuy'=> $qtybuy,
					'qty_real'=> $masuk
				);
			$this->db->where('BrgPOD_ID',$id);
			$this->db->update('db_barangpod',$data);
			
			
			//Menampilkan di JSON
			$xtampil = array 
				(
					 'kode' => $kode,
					 'brg' => $brg,
					 'qty_po' => $qty_po,
					 'out_po' => $out_po,
					 'qty_rc' => $qtybuy,
					 'satuan' => $satuan,				
					 'masuk' => $masuk 				
				);
			die(json_encode($xtampil));
		}		
		
		
		function saveall(){
			extract(PopulateForm());
			$id = $this->id;
			$user = $this->user;
			$this->db->query("sp_insert_mrr ".$idpoh.",'".$reff_type."','".indo_date($reff_date)."','".inggris_date($tgl_mrr)."'
						,'".$no_mrr."',".$id.",'".$user."'");
			redirect("mrr");
		}
		
		
		function closemrr($id){
			$cek = $this->db->where('BrgPOH_ID',$id)
							->get('db_barangpoh')->row();
			
			
			$data = array 
			(
				'status_pr' => 6
			);
			$this->db->where('id_pr',$cek->id_pr);
			$this->db->update('db_pr',$data);		
			redirect('mrr');		
		}
		
		
		function printmrr($id){
			$data['id'] = $id;
			$this->load->view('procurement/print/print_mrr',$data);
		}
		

			
		
					
}

