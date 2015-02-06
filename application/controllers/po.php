<?php
	class po extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('purchase_order_model');
			$this->set_page_title('Purchase Order');
			$this->default_limit = 30;
			$this->template_dir = 'procurement/po';
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
												->where('isnull(a.posting_po,0) !=',1)
												//->where('isnull(b.pilih,0)',1)
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
			$this->set_grid_column('id_pr','ID PR',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('no_pr','No PR',array('width'=>80,'formatter' => 'cellColumn'));
			$this->set_grid_column('tgl_pr','Tgl PR',array('width'=>40,'formatter' => 'cellColumn'));
			$this->set_grid_column('divisi_nm','Divisi',array('width'=>40,'formatter' => 'cellColumn'));
			$this->set_grid_column('req_pr','Requestor',array('width'=>40,'formatter' => 'cellColumn'));
			$this->set_grid_column('ket_pr','Keterangan',array('width'=>80,'formatter' => 'cellColumn'));
			$this->set_grid_column('alasan_pr','Alasan',array('width'=>60,'formatter' => 'cellColumn'));
			//~ $this->set_grid_column('approval1','Appr 1',array('width'=>40,'align'=>'center','formatter' => 'cellColumn'));
			//~ $this->set_grid_column('approval2','Appr 2',array('width'=>40,'formatter' => 'cellColumn'));
			//~ $this->set_grid_column('status_pr','Status PR',array('width'=>30,'formatter' => 'cellColumn'));
			$this->set_jqgrid_options(array('width'=>1300,'height'=>400,'caption'=>'Purchase Order','rownumbers'=>true));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}
		
		
		function cekdt($id,$pr){
			$data = $this->db->select('b.nm_supp,b.kd_supp,b.id_pnwrven,c.kontak,c.alamat,c.kota,c.telepon,c.fax,c.kodepos')
							 ->join('pemasok c','c.kd_supp_gb = b.kd_supp')
							 ->where('b.kd_supp',$id)
							 ->where('b.id_pr',$pr)
							 ->get('db_pr_pnwrvend b')->row();
							 
		    die(json_encode($data));exit;
		}
		
		function cekalldt($id,$pr){
			$data = $this->db->select('b.kd_brg_ver kd_brg_ver, nm_brg_ver, qty_req, unit_brg, a.harga_sat harga_sat, b.discnilai discnilai, a.subtotal subtotal')
							 //->where('id_pnwrven',$idpnwr)
							 ->join('db_pr_pnwrvend b','b.id_pnwrven = a.id_pnwrven')
							 ->where('b.kd_supp',$id)
							 ->where('a.id_pr',$pr)
							 ->get('db_pr_dver a')->result();
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
			'".$nm."',".$id_pr.",".$pt.",'".$kd_pos."',".$supp."");
			
			redirect("po");
		}
		
		
		function update($id){
			#die('tes');
			$qdata = $this->db->select('status_pr,approval1,approval2')
							  ->where('id_pr',$id)
							  ->get('db_pr')->row();
			if($qdata->status_pr == 9){
				echo"PR tidak di setujui";
			}elseif($qdata->approval1 == NULL){
				echo"Approval1 Belum";
			}elseif($qdata->approval2 == NULL){
				echo"Approval2 Belum";
			//}elseif($qdata->status_pr == 4){
				//echo"PO Sudah di Generate";
			}else{				
				parent::update($id);
			}			

		}
				
		function printpo($id){
		//die($id);
		$data['id'] = $id;
		$this->load->view('procurement/print/cetakpo',$data);
		
		//die('sukses'.' '.$id);
		}
		
	}

