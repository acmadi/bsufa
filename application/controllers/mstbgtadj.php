<?php
	class mstbgtadj extends DBController{
		private $divisi;
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('mstbgtadj_model');
			$this->set_page_title('Master Budget Adjustment');
			$this->default_limit = 15;
			$this->template_dir = 'accounting/mstbgtadj';
			//$this->load->model('mstbank_model','bank');
		}
		
		protected function setup_form($data=false){
			#give parameter
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt']; 
			$divisi = "";
			//$this->parameters['divisi'] = $this->mstmodel->getglobal("db_divisi");//,"pt_id",$pt);
			$this->parameters['kodebgt'] = $this->mstmodel->getbudget($divisi,$pt,'2012');
			$bln = array("","Januari","Febuari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober",
						 "November","Desember");
			$this->parameters['bln'] = $bln;
		}
		
		function get_json(){
			$this->set_custom_function('tanggal','indo_date');
			$this->set_custom_function('monthbgt','blnbgt');
			$this->set_custom_function('status','statusadj');
			$this->set_custom_function('mutasi','mutasi');
			$this->set_custom_function('amount','currency');
			parent::get_json();
		}

		function index(){
			$this->set_grid_column('id_mstadj','ID',array('hidden'=>true));
			$this->set_grid_column('descbgt','Description',array('width'=>800,'align'=>'left'));
			$this->set_grid_column('amount','Amount',array('width'=>200,'align'=>'right'));
			$this->set_grid_column('monthbgt','Month',array('width'=>200,'align'=>'left'));
			$this->set_grid_column('tanggal','Tanggal',array('width'=>200,'align'=>'left'));
			$this->set_grid_column('status','Status',array('width'=>200,'align'=>'left'));
			$this->set_jqgrid_options(array('width'=>800,'height'=>300,'caption'=>'Master Budget','rownumbers'=>true));
			parent::index();
		}
		

		function loaddata(){
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt']; 
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				$thn = $this->input->post('thn');
				switch($data_type){
					case 'budget':
						$sql = $this->db->select("code id,' {' +code+ '}' + descbgt  nama")
										->where('divisi_id',$parent_id)
										->where('thn',$thn)
										->where('id_pt',$pt)
										->order_by('code','asc')
										->get('db_mstbgt')
										->result();
						break;
					case 'budget2':
						$sql = $this->db->select("code id,' {' +code+ '}' + descbgt  nama")
										->where('divisi_id',$parent_id)
										->where('thn',$thn)
										->where('id_pt',$pt)
										->order_by('code','asc')
										->get('db_mstbgt')
										->result();
						break;					
					default:
					    $sql = $this->db->select('divisi_id id,divisi_nm nama')
										->where('id_pt',$pt)
										->get('db_divisi')->result();
							
				}
				$response = array();
				if($sql){
					foreach($sql as $row){
						$response[] = $row;
					}
				}
				die(json_encode($response));
			}
		}


		function dtmonth($kode,$bln,$thn){
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt']; 
			$data = $this->mstmodel->getbgtdetail('db_mstbgt_update',$kode,$thn,$pt);
			$response = array
			(
				'bgt'=>number_format($data[$bln])
			);
			echo json_encode($response);
			
		}
		
		function data($id,$thn){
			// Data Master dan Actual
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt']; 
			$data = $this->mstmodel->getbgtdetail("db_mstbgt",$id,$thn,$pt);
			$dtjan = $this->mstmodel->bgtbln($id,"January");
			$dtfeb = $this->mstmodel->bgtbln($id,"Febuary");
			$dtmar = $this->mstmodel->bgtbln($id,"March");
			$dtapr = $this->mstmodel->bgtbln($id,"April");
			$dtmay = $this->mstmodel->bgtbln($id,"May");
			$dtjun = $this->mstmodel->bgtbln($id,"June");
			$dtjul = $this->mstmodel->bgtbln($id,"July");
			$dtags = $this->mstmodel->bgtbln($id,"August");
			$dtsep = $this->mstmodel->bgtbln($id,"September");
			$dtoct = $this->mstmodel->bgtbln($id,"October");
			$dtnov = $this->mstmodel->bgtbln($id,"November");
			$dtdec = $this->mstmodel->bgtbln($id,"December");
			
			// Balance 
			$blcjan = ($data['bgt1']) - ($dtjan->jml);
			$blcfeb = ($data['bgt2']) - ($dtfeb->jml);
			$blcmar = ($data['bgt3']) - ($dtmar->jml);
			$blcapr = ($data['bgt4']) - ($dtapr->jml);
			$blcmay = ($data['bgt5']) - ($dtmay->jml);
			$blcjun = ($data['bgt6']) - ($dtjun->jml);
			$blcjul = ($data['bgt7']) - ($dtjul->jml);
			$blcags = ($data['bgt8']) - ($dtags->jml);
			$blcsep = ($data['bgt9']) - ($dtsep->jml);
			$blcoct = ($data['bgt10']) - ($dtoct->jml);
			$blcnov = ($data['bgt11']) - ($dtnov->jml);
			$blcdec = ($data['bgt12']) - ($dtdec->jml);
			
			// Total
			$tot_act = $data['bgt1'] + $data['bgt2'] + $data['bgt3'] + $data['bgt4'] + 
					   $data['bgt5'] + $data['bgt6'] + $data['bgt7'] + $data['bgt8'] +
					   $data['bgt9'] + $data['bgt10'] + $data['bgt11'] + $data['bgt12'];
					   

			$tot_blc = $blcjan + $blcfeb + $blcmar + $blcapr + $blcmay + $blcjun +
					   $blcjul + $blcags + $blcsep + $blcoct + $blcnov + $blcdec;
			
			$dtarr = array
			(
				'acc' => $data['acc'],
				'cf' => $data['cf'],
				'bgt1' => $data['bgt1'],
				'bgt2' => $data['bgt2'],
				'bgt3' => $data['bgt3'],
				'bgt4' => $data['bgt4'],
				'bgt5' => $data['bgt5'],
				'bgt6' => $data['bgt6'],
				'bgt7' => $data['bgt7'],
				'bgt8' => $data['bgt8'],
				'bgt9' => $data['bgt9'],
				'bgt10' => $data['bgt10'],
				'bgt11' => $data['bgt11'],
				'bgt12' => $data['bgt12'],
				'tot_mst' => $data['tot_mst'],
				'act1' => number_format($dtjan->jml),
				'act2' => number_format($dtfeb->jml),
				'act3' => number_format($dtmar->jml),
				'act4' => number_format($dtapr->jml),
				'act5' => number_format($dtmay->jml),
				'act6' => number_format($dtjun->jml),
				'act7' => number_format($dtjul->jml),
				'act8' => number_format($dtags->jml),
				'act9' => number_format($dtsep->jml),
				'act10' => number_format($dtoct->jml),
				'act11' => number_format($dtnov->jml),
				'act12' => number_format($dtdec->jml),
				'blc1' => number_format($blcjan),
				'blc2' => number_format($blcfeb),
				'blc3' => number_format($blcmar),
				'blc4' => number_format($blcapr),
				'blc5' => number_format($blcmay),
				'blc6' => number_format($blcjun),
				'blc7' => number_format($blcjul),
				'blc8' => number_format($blcags),
				'blc9' => number_format($blcsep),
				'blc10' => number_format($blcoct),
				'blc11' => number_format($blcnov),
				'blc12' => number_format($blcdec),
				'tot_act' => number_format($tot_act),
				'tot_blc' => number_format($tot_blc),
				'kodebgt' =>$data['code'],
				'descbgt' =>$data['descbgt']
				
			);
			echo json_encode($dtarr);			
		}	
		
		
		//Get Current Budget
		function datacurrent($id,$thn){
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt']; 

			$cekrow   = $this->mstmodel->getglobal('db_mstbgt_update','code',$id);
			$row_adj  = $this->mstmodel->getbgtdetail('db_mstbgt_update',$id,$thn,$pt);
			$row_sumd = $this->mstmodel->sumbgtd($id);
			$row_sumc = $this->mstmodel->sumbgtc($id);
			$row_orgn = $this->mstmodel->getbgtdetail('db_mstbgt',$id,$thn,$pt);
			$row_acc  = $this->mstmodel->get_account($row_orgn['acc']);
			//var_dump($row_orgn['acc']);exit;
			

			if($cekrow > 0){
				$curbgt1 = $row_adj['bgt1'];
				$curbgt2 = $row_adj['bgt2'];
				$curbgt3 = $row_adj['bgt3'];
				$curbgt4 = $row_adj['bgt4'];
				$curbgt5 = $row_adj['bgt5'];
				$curbgt6 = $row_adj['bgt6'];
				$curbgt7 = $row_adj['bgt7'];
				$curbgt8 = $row_adj['bgt8'];
				$curbgt9 = $row_adj['bgt9'];
				$curbgt10 = $row_adj['bgt10'];
				$curbgt11 = $row_adj['bgt11'];
				$curbgt12 = $row_adj['bgt12'];
				$curtot_mst = $row_adj['tot_mst'];
			}else{
				$curbgt1 = $row_orgn['bgt1'];
				$curbgt2 = $row_orgn['bgt2'];
				$curbgt3 = $row_orgn['bgt3'];
				$curbgt4 = $row_orgn['bgt4'];
				$curbgt5 = $row_orgn['bgt5'];
				$curbgt6 = $row_orgn['bgt6'];
				$curbgt7 = $row_orgn['bgt7'];
				$curbgt8 = $row_orgn['bgt8'];
				$curbgt9 = $row_orgn['bgt9'];
				$curbgt10 = $row_orgn['bgt10'];
				$curbgt11 = $row_orgn['bgt11'];
				$curbgt12 = $row_orgn['bgt12'];
				$curtot_mst = $row_orgn['tot_mst'];
			}
			$response = array
			(
				'coa'=>$row_orgn['acc'],
				'cf'=>$row_orgn['cf'],
				'kdbgt'=>$row_orgn['code'],
				'descbgt'=>$row_orgn['descbgt'],
				'descacc'=>$row_acc->namaacc,
				'divisi_id' => $row_orgn['divisi_id'],
				'curbgt1'=>$curbgt1,
				'curbgt2'=>$curbgt2,
				'curbgt3'=>$curbgt3,
				'curbgt4'=>$curbgt4,
				'curbgt5'=>$curbgt5,
				'curbgt6'=>$curbgt6,
				'curbgt7'=>$curbgt7,
				'curbgt8'=>$curbgt8,
				'curbgt9'=>$curbgt9,
				'curbgt10'=>$curbgt10,
				'curbgt11'=>$curbgt11,
				'curbgt12'=>$curbgt12,
				'curtot_mst' =>$curtot_mst
			);  
			echo json_encode($response);
		}

		
		function cekthn(){
			$thn = $this->input->post('thn');
			$rows = $this->db->where('thn',$thn)
							 ->get('db_mstbgt')->num_rows();
			if($rows > 0)
				$respon = "sukses";
			else
				$respon = "gagal";
			echo json_encode($respon);
		}

		
		function save_bgt(){
			extract(PopulateForm());
			list($d,$m,$y) = split("-",$tgl);
			$session_id = $this->UserLogin->isLogin();
			$level = $session_id['level_id'];
			$pt = $session_id['id_pt'];	
			// Masukan Nilai Adjust 
			$tglbgt = $y."-".$m."-".$d;
			$lsbgt = array("",str_replace(",","",$bgtadj1),
			str_replace(",","",$bgtadj2),str_replace(",","",$bgtadj3),
			str_replace(",","",$bgtadj4),str_replace(",","",$bgtadj5),str_replace(",","",$bgtadj6),
			str_replace(",","",$bgtadj7),str_replace(",","",$bgtadj8),str_replace(",","",$bgtadj9),
			str_replace(",","",$bgtadj10),
			str_replace(",","",$bgtadj11),str_replace(",","",$bgtadj12));
			
			for($i=1;$i<=12;$i++){
				$month = "bgt".$i;
				$data = array
				(
					'codeadj'=>$code,
					'thnadj'=>$thn,
					'amount'=>$lsbgt[$i],
					'monthbgt'=>$month,
					'tanggal'=>$tglbgt,
					'status'=> 'adj',
					'mutasi'=> $adj
					
				);
				if($lsbgt[$i] > 0){
					$this->db->insert("db_mstbgtadj",$data);
				}
			}
			
			//Update Adjustment to Current
			$rows = $this->mstmodel->getglobal("db_mstbgt_update","code",$code);
			$data2 = array
			(
				'acc' => $coa,
				'cf' => $cf,
				'desccf' =>'',
				'code' => $code,
				'descacc' =>'',
				'thn' => $thn,
				'bgt1' => replace_numeric($curbgthide1),
				'bgt2' => replace_numeric($curbgthide2),
				'bgt3' => replace_numeric($curbgthide3),
				'bgt4' => replace_numeric($curbgthide4),
				'bgt5' => replace_numeric($curbgthide5),
				'bgt6' => replace_numeric($curbgthide6),
				'bgt7' => replace_numeric($curbgthide7),
				'bgt8' => replace_numeric($curbgthide8),
				'bgt9' => replace_numeric($curbgthide9),
				'bgt10' => replace_numeric($curbgthide10),
				'bgt11' => replace_numeric($curbgthide11),
				'bgt12' => replace_numeric($curbgthide12),
				'tot_mst' => replace_numeric($curtot_msthide),
				'descbgt' => $descbgt,
				'divisi_id' => $divisi_id								
			);
			
			if($rows > 0 ){
				$this->db->where("code",$code);
				$this->db->where("id_pt",$pt);
				$this->db->update("db_mstbgt_update",$data2);
			}else{
				$this->db->insert("db_mstbgt_update",$data2);
			}
			redirect('mstbgtadj');
			
		}
		
		function save_bgtreclass(){
			extract(PopulateForm());
			list($d,$m,$y) = split("-",$tgl);
			$tglbgt = $y."-".$m."-".$d;
			$data1 = array
			(
				'tanggal' => $tglbgt,
				'codeadj' => $cb_budget2,
				'coderec' => $cb_budget,
				'thnadj' => $thn,
				'monthbgt' => $bln1,
				'monthrec' => $bln2,
				'amount' => str_replace(",","",$classamount),
				'mutasi' => 'D',
				'status' => 'rec'
				
			);
			
			$data2 = array
			(
				'tanggal' => $tglbgt,
				'codeadj' => $cb_budget,
				'coderec' => $cb_budget2,
				'thnadj' => $thn,
				'monthbgt' => $bln2,
				'monthrec' => $bln1,
				'amount' => str_replace(",","",$classamount),
				'mutasi' => 'K',
				'status' => 'rec'
			);
			#var_dump($cb_budget);exit;
			
			$this->db->insert("db_mstbgtadj",$data1);
			$this->db->insert("db_mstbgtadj",$data2);
			
			//Update Adjustment to Current
			$rows1 = $this->mstmodel->getglobal("db_mstbgt_update","code",$cb_budget);
			$rows2 = $this->mstmodel->getglobal("db_mstbgt_update","code",$cb_budget2);

			
			$data_update1 = array
			(
				'acc' => $coahide1,
				//'cf' => $cf,
				//'desccf' =>'',
				'code' => $cb_budget,
				//'descacc' =>'',
				//'thn' => $thn,
				'bgt1' => replace_numeric($jan1),
				'bgt2' => replace_numeric($jan2),
				'bgt3' => replace_numeric($jan3),
				'bgt4' => replace_numeric($jan4),
				'bgt5' => replace_numeric($jan5),
				'bgt6' => replace_numeric($jan6),
				'bgt7' => replace_numeric($jan7),
				'bgt8' => replace_numeric($jan8),
				'bgt9' => replace_numeric($jan9),
				'bgt10' => replace_numeric($jan10),
				'bgt11' => replace_numeric($jan11),
				'bgt12' => replace_numeric($jan12),
				'tot_mst' => replace_numeric($tot1),
				//'descbgt' => $descbgt,
				//'divisi_id' => $divisi_id								
			);
			
			$data_update2 = array
			(
				'acc' => $coahide2,
				//'cf' => $cf,
				'code' => $cb_budget2,
				//'descacc' =>'',
				//'thn' => $thn,
				'bgt1' => replace_numeric($feb1),
				'bgt2' => replace_numeric($feb2),
				'bgt3' => replace_numeric($feb3),
				'bgt4' => replace_numeric($feb4),
				'bgt5' => replace_numeric($feb5),
				'bgt6' => replace_numeric($feb6),
				'bgt7' => replace_numeric($feb7),
				'bgt8' => replace_numeric($feb8),
				'bgt9' => replace_numeric($feb9),
				'bgt10' => replace_numeric($feb10),
				'bgt11' => replace_numeric($feb11),
				'bgt12' => replace_numeric($feb12),
				'tot_mst' => replace_numeric($tot2),
				//'descbgt' => $descbgt,
				//'divisi_id' => $divisi_id								
			);			
			
			
			if($rows1 > 0 ){
				//Update Budget I
				$this->db->where("code",$cb_budget);
				$this->db->where("thn",$thn);
				$this->db->where("id_pt",$this->pt);
				$this->db->update("db_mstbgt_update",$data_update1);
				
			}else{
				//simpan Budget I
				$this->db->insert("db_mstbgt_update",$data_update1);
			}
			
			//Update Budget II
			if($rows2 > 0 ){
				
				$this->db->where("code",$cb_budget2);
				$this->db->where("thn",$thn);
				$this->db->where("id_pt",$this->pt);
				$this->db->update("db_mstbgt_update",$data_update2);
				
			}else{
				$this->db->insert("db_mstbgt_update",$data_update2);
			}			
			redirect('mstbgtadj');
			
		}
	
	}
?>
