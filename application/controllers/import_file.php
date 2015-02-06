<?php 
	defined('BASEPATH') or die('Access Denied');
    class import_file extends AdminPage {  
      function import_file(){  
        parent::AdminPage();   
        $this->load->helper('form'); // untuk menangani proses form   
      }  
      
      function index() {  
        $this->loadTemplate('import_file_excel');  
      }  
      
      function import_realisasi(){
		  $this->loadTemplate('import_file_realisasi');
	  }
      
      function read_file(){  
        include_once ( APPPATH."libraries/excel_reader2.php"); 
        extract(PopulateForm()); 
       // var_dump($_FILES['userfile']['tmp_name']);exit;
        $data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']); 
             
        $j = -1;  
        for ($i=2; $i <= ($data->rowcount($sheet_index=0)); $i++){   
          $j++;  
          $code[$j]   = $data->val($i, 1);
		  $desc[$j]   = $data->val($i, 2);          
          $acc[$j]   = $data->val($i, 3);  
          $bgt1[$j]    = $data->val($i, 4);  
          $bgt2[$j]  = $data->val($i, 5);
          $bgt3[$j]  = $data->val($i, 6); 
          $bgt4[$j]  = $data->val($i, 7);
          $bgt5[$j]  = $data->val($i, 8);
          $bgt6[$j]  = $data->val($i, 9);
          $bgt7[$j]  = $data->val($i, 10);
          $bgt8[$j]  = $data->val($i, 11);
          $bgt9[$j]  = $data->val($i, 12);
          $bgt10[$j]  = $data->val($i, 13);
          $bgt11[$j]  = $data->val($i, 14);
          $bgt12[$j]  = $data->val($i, 15); 
          $total[$j]  = $data->val($i, 16);
          $thn[$j]  = $data->val($i, 17);
          $divisi[$j] = $data->val($i, 18);
          $pt[$j] = $data->val($i, 19);
          $tglinput = date('Y-m-d');
          
          $datasave = array
          (
			'code'=>$code[$j],
			'acc'=>$acc[$j],
			'descbgt' => $desc[$j],
			'bgt1' => $bgt1[$j],
			'bgt2' => $bgt2[$j],
			'bgt3' => $bgt3[$j],
			'bgt4' => $bgt4[$j],
			'bgt5' => $bgt5[$j],
			'bgt6' => $bgt6[$j],
			'bgt7' => $bgt7[$j],
			'bgt8' => $bgt8[$j],
			'bgt9' => $bgt9[$j],
			'bgt10' => $bgt10[$j],
			'bgt11' => $bgt11[$j],
			'bgt12' => $bgt12[$j],
			'tot_mst' => $total[$j],
			'thn' => $thn[$j],
			'tglinput_mstbgt' => $tglinput,
			'divisi_id' => $divisi[$j],
			'id_pt' => $pt[$j],
			'flag_id' => 0
          );
          $cekdata = $this->db->where('thn',$thn[$j])
							  ->where('code',$code[$j])
							  ->where('id_pt',$pt[$j])
							  ->get('db_mstbgt')->num_rows();
		  
		  if($cekdata > 0){
			echo"
				<script type='text/javascript'>
					alert('Data sudah ada tolong cek kembali');
					document.location.href = 'import_file';
				</script>
			";
			exit;
		  }
          
          $this->db->insert('db_mstbgt',$datasave);
          $this->db->insert('db_mstbgt_update',$datasave);
          echo"
			<script type='text/javascript'>
				alert('Data berhasil di import');
				document.location.href = 'import_file';
			</script>
          ";
        }            
      }
      
      function read_file_realisasi(){  
        include_once ( APPPATH."libraries/excel_reader2.php"); 
        extract(PopulateForm()); 
        //var_dump($_FILES['userfile']['tmp_name']);exit;
        $data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']); 
             
        $j = -1;  
        for ($i=2; $i <= ($data->rowcount($sheet_index=0)); $i++){   
          $j++;  
          $code[$j]   = $data->val($i, 1);
		  $proposed[$j]   = $data->val($i, 2);          
          $approved[$j]   = $data->val($i, 3);  
          $status[$j]    = $data->val($i, 4);  
          $proposed_date[$j]  = $data->val($i, 5);
          $approved_date[$j]  = $data->val($i, 6); 
          $remark_proposed[$j]  = $data->val($i, 7);
          $remark_approved[$j]  = $data->val($i, 8);
          $divisi[$j]  = $data->val($i, 9);
          $pt[$j]  = $data->val($i, 10);
          $form_kode[$j]  = $data->val($i, 11);
          
          $datasave = array
          (
			'code_id'=>$code[$j],
			'amount'=>$proposed[$j],
			'appamount' => $approved[$j],
			'status_bgt' => $status[$j],
			'tanggal' => $proposed_date[$j],
			'apptanggal' => $approved_date[$j],
			'remark' => $remark_proposed[$j],
			'appremark' => $remark_approved[$j],
			'divisi_id' => $divisi[$j],
			'id_pt' => $pt[$j],
			'form_kode' => $form_kode[$j],
			'flag_id' => 1
          );
          
          $this->db->insert('db_trbgtdiv',$datasave);
          echo"
			<script type='text/javascript'>
				alert('Data berhasil di import');
				document.location.href = 'import_file';
			</script>
          ";
        }            
      }  
      
        
    }  
