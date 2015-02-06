<?php
	class viewpo extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('purchase_orderview_model');
			$this->set_page_title('View Purchase Order');
			$this->default_limit = 30;
			$this->template_dir = 'procurement/viewpo';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->id = $session_id['id'];
			$this->pt = $session_id['id_pt'];
		}
		
		protected function setup_form($data=false){
			$id = @$data->id_pr;
			$this->parameters['dver'] = $this->db->where("id_pr",$id)
									             ->get("db_pr_dver")->result();
									 
		    $pt = $this->pt;
		    $divisi = 4;
		       
		    $this->parameters['ven'] = $this->db->select('b.kd_supp,b.nm_supp')
											    ->join('db_pr_pnwrvend b','a.id_pnwrven = b.id_pnwrven')
												->where('a.id_pr',$id)
												->group_by('b.kd_supp,b.nm_supp')
												->get('db_pr_dver a')->result();
			//Cek No PO
			$qno = $this->db->query("sp_cek_po_no ".$pt.",".$divisi."")->row();
			
			$this->parameters['no_po'] = $qno->no_po;
		}
		
		function get_json(){
			$this->set_custom_function('tgl_pr','indo_date');
			parent::get_json();
		}
		
		function index(){
			$this->set_grid_column('BrgPOH_ID','ID PH',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('no_po','No.PO',array('width'=>60,'formatter' => 'cellColumn'));
			$this->set_grid_column('tgl_po','Tgl.PO',array('width'=>40,'formatter' => 'cellColumn'));
			$this->set_grid_column('kirm_tgl','Kirim Tgl.',array('width'=>40,'formatter' => 'cellColumn'));
			//$this->set_grid_column('','Batal',array('width'=>15,'align'=>'center','formatter' => 'cellColumn'));
			$this->set_grid_column('divisi_nm','Divisi',array('width'=>40,'formatter' => 'cellColumn'));
			$this->set_grid_column('reff_pr','Reff PR#',array('width'=>50,'formatter' => 'cellColumn'));
			$this->set_grid_column('ket_po','Keterangan',array('width'=>90,'formatter' => 'cellColumn'));
			$this->set_grid_column('nm_supp','Supplier',array('width'=>30,'formatter' => 'cellColumn'));
			$this->set_grid_column('up_supp','PIC Supplier',array('width'=>30,'formatter' => 'cellColumn'));
			$this->set_grid_column('harga_tot','Total',array('width'=>15,'align'=>'center','formatter' => 'cellColumn'));
			$this->set_grid_column('matauang','RP/$',array('width'=>30,'formatter' => 'cellColumn'));
			$this->set_grid_column('kurs','Kurs',array('width'=>30,'formatter' => 'cellColumn'));
			
			$this->set_jqgrid_options(array('width'=>1300,'height'=>400,'caption'=>'Purchase Order','rownumbers'=>true));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}
		
		
		function cekdt($id,$pr){
			$data = $this->db->select('b.nm_supp,b.kd_supp,b.id_pnwrven,c.kontak,c.alamat,c.kota,c.telepon,c.fax,c.kodepos')
							 ->join('pemasokmaster c','c.kd_supplier = b.kd_supp')
							 ->where('b.kd_supp',$id)
							 ->where('b.id_pr',$pr)
							 ->get('db_pr_pnwrvend b')->row();
							 
		    die(json_encode($data));exit;
		}
		
		function cekalldt($id,$pr){
			$data = $this->db->select('kd_brg_ver,nm_brg_ver,qty_req,unit_brg,harga_sat,discnilai,subtotal')
							 ->where('kd_supp',$id)
							 ->where('id_pr',$pr)
							 ->get('db_pr_dver')->result();
			$respon = array();
			foreach($data as $row){
				$respon[] = $row;
			}
			die(json_encode($respon));
							 
		}
		
		function saveall(){
			extract(PopulateForm());
			$tgl_po = inggris_date($tgl_po);
			$tgl_kirim = inggris_date($tgl_kirim);
			$sub_all = replace_numeric($sub_all);
			$iduser = $this->id;
			$pt = $this->pt;
			$nm = $this->user;
			
			$this->db->query("sp_insert_po '".$no_po."','".$tgl_po."','".$reff."',".$div_pr.",'".$divisi."','".$ket."'
			,'".$tgl_kirim."','".$kd_supp."','".$nm_supp."','".$pic."','".$alamat."','".$kota."','".$tlp."'
			,'".$fax."',".$sub_all.",'".$uang."','".$ttd1."','".$kirim."','".$bayar."',".$iduser.",
			'".$nm."',".$id_pr.",".$pt.",".$kd_pos.",".$supp."");
			
			redirect("po");
		}
		
		
		function update($id){
			$qdata = $this->db->select('status_pr,approval1,approval2')
							  ->where('id_pr',$id)
							  ->get('db_pr')->row();
			if($qdata->status_pr == 9){
				echo"PR tidak di setujui";
			}elseif($qdata->approval1 == NULL){
				echo"Approval1 Belum";
			}elseif($qdata->approval2 == NULL){
				echo"Approval2 Belum";
			}elseif($qdata->status_pr == 4){
				echo"PO Sudah di Generate";
			}else{				
				parent::update($id);
			}			

		}
				
		function printpo($id){
		//die($id);
		$data['id'] = $id;
		//var_dump($id);exit;
		$this->load->view('procurement/print/cetakpo',$data);
		
		//die('sukses'.' '.$id);
		}
		
	}

