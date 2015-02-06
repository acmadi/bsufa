<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mpettycash extends DBController {

	function __construct()
	{
		parent::__construct('mstpettycash_model');
		$this->set_page_title('PETTY CASH');
		$this->default_limit = 10;
		$this->template_dir = 'cb/mpettycash';
		//$this->load->model('');
	}
	
	function get_json(){
		$this->set_custom_function('bln_mptcash','indo_date');
		$this->set_custom_function('amount_mptcash','currency');
		$this->set_custom_function('saldo_mptcash','currency');
		parent::get_json();
	}

	function index()
	{
		$this->set_grid_column('id_mptcash','ID',array('hidden'=>true));
		$this->set_grid_column('nomor_mptcash','No Master Pettycash',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('bln_mptcash','Date',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('amount_mptcash','Amount',array('width'=>200, 'formatter' => 'cellColumn'));	
		$this->set_grid_column('saldo_mptcash','Saldo',array('width'=>200, 'formatter' => 'cellColumn'));	
		$this->set_jqgrid_options(array('width'=>1300,'height'=>350,'caption'=>'PETTY CASH','rownumbers'=>true,'sortname'=>'','sortorder'=>'id_mptcash'));
		parent::index();
		#id_mptcash, nomor_mptcash, bln_mptcash, amount_mptcash, saldo_mptcash, deskripsi
	}
	
	function input_saldo(){
		$no = $this->db->query("select top 1 voucher from db_cashheader order by id_cash desc")->row();
		$old_no = explode('/', $no->voucher);
		$new_no = $old_no[3] + 1; 
		$m = date('m');
		if(($m==11) or ($m==12)){
			$mon = $m;
		}else{
			$mon = substr($m,1,1);
		}		    
		if($new_no<=9){
			$voucher = "AP/".date('Y')."/".$mon."/0000".$new_no;
		}elseif($new_no<=99){
			$voucher = "AP/".date('Y')."/".$mon."/000".$new_no;
		}elseif($new_no<=999){
			$voucher = "AP/".date('Y')."/".$mon."/00".$new_no;
		}elseif($new_no<=9999){
			$voucher = "AP/".date('Y')."/".$mon."/0".$new_no;
		}elseif($new_no<=99999){
			$voucher = "AP/".date('Y')."/".$mon."/".$new_no;
		}
		$cekbulan = $this->db->query("select top(1) month(bln_mptcash) as m from master_pettycash")->row();
		$cektahun = $this->db->query("select top(1) year(bln_mptcash) as y from master_pettycash")->row();
		$cekstatus = $this->db->query("select top(1) status from master_pettycash")->row();
		$mpt = $this->input->post('nomor_mpt');
		$project = $this->input->post('', TRUE);
		$tgl = date('Y')."-".$this->input->post('bln_mptcash')."-".date('d');
		$amt = str_replace(",","",$this->input->post('amount'));
		$sld = str_replace(",","",$this->input->post('saldo')) + $amt;
		$des = $this->input->post('petty_desc');
		$Q = "insert into master_pettycash (
									nomor_mptcash,
									bln_mptcash,
									amount_mptcash,
									saldo_mptcash,
									deskripsi,
									status
								) values 
								(
									'".$mpt."',
									'".$tgl."',
									'".$sld."',
									'".$sld."',
									'".$des."',
									1
								)";
		//echo $Q;
		if ( ($cekbulan->m == $this->input->post('bln_mptcash')) and ($cektahun->y == date('Y')) and ($cekstatus->status == 1) ) {
			die('Opening Sudah Ada');
		} else {
			//insert into master petty cash
			$q = $this->db->query($Q);

			//insert into cash header
			$query_cash = "insert into db_cashheader(modules,trans_date,descs,currency,rate,datetime,paidby,voucher) values 
			('CB','".$tgl."','".$des."',1,1,'".date('Y-m-d h:i:s')."','Cash','".$voucher."')";
			$q2 = $this->db->query($query_cash);
			if (($q == true) and ($q2 == true)) {
				die('sukses');
			} else {
				die('Gagal Simpan');
			}
		}
		
	}

	function edit_saldo($id){
		$ceksaldo = $this->db->query("select saldo_mptcash from master_pettycash where id_mptcash = ".$id." ")->row();
		$mpt = $this->input->post('nomor_mpt');
		$tgl = date('Y')."-".$this->input->post('bln_mptcash')."-".date('d');
		$amt = replace_numeric($this->input->post('amount'));
		$sld = replace_numeric($this->input->post('saldo')) + $amt - $ceksaldo->saldo_mptcash;
		$des = $this->input->post('petty_desc');
		$Q = "update master_pettycash set bln_mptcash = '".$tgl."',amount_mptcash = '".$amt."',saldo_mptcash = '".$sld."',deskripsi = '".$des."' where id_mptcash = ".$id."";
		//var_dump($Q);exit();
		$q = $this->db->query($Q);
		if ($q == true) {
			die('sukses');
		} else {
			die('Gagal Update');
		}
	}

	function delete($id)
	{
		$key = explode('&', $id);
		$cek = $this->db->query("select status from master_pettycash where id_mptcash = ".$key[0]." ")->row();
		if ($cek->status == 0) {
			echo "<script>alert('Blm Di Closing');refreshTable();</script>";
		} else {
			$no = $this->db->query("select nomor_mptcash from master_pettycash where id_mptcash = ".$key[0]." ")->row();
			$q = $this->db->query("update master_pettycash set status = 2 where id_mptcash = ".$key[0]." ");
			$q2 = $this->db->query("update db_pettynew set flag_hapus = 1 where nomor_petty = ".$no->nomor_mptcash."");
			if (($q == TRUE) or ($q2 == TRUE)) {
				echo "<script>alert('Sukses');history.go(-1);refreshTable();</script>";
			} else {
				die('Gagal Hapus');
			}
		}
	}

	function closing($id)
	{
		$key = explode('&', $id);
		$cek = $this->db->query("select status,nomor_mptcash,bln_mptcash from master_pettycash where id_mptcash = ".$key[0]." ")->row();
		if ($cek->status == 0) {
			echo "<script>alert('Sudah Di Closing');refreshTable();</script>";
		} else {
			$q = $this->db->query("update master_pettycash set status = 0 where id_mptcash = ".$key[0]." ");
			$now = date('Y-m-d');
			$range = $this->db->query("select voucher from db_pettynew where status != 1 or status is null and flag_hapus != 1 and nomor_petty = '".$cek->nomor_mptcash."' ")->result();
			if (count($range) > 0) {
				foreach ($range as $row) {
					$bk = $this->db->query("select voucher from db_gldetail where SUBSTRING(voucher,0,3) = 'BK' order by gl_id desc")->row();
					$pecah = explode('/', $bk->voucher);
					$no = $pecah[3]+1;
					if($no<=9){
						$voucherbk = "BK/".date('Y')."/".date('m')."/0000".$no;
					}elseif($no<=99){
						$voucherbk = "BK/".date('Y')."/".date('m')."/000".$no;
					}elseif($no<=999){
						$voucherbk = "BK/".date('Y')."/".date('m')."/00".$no;
					}elseif($no<=9999){
						$voucherbk = "BK/".date('Y')."/".date('m')."/0".$no;
					}elseif($no<=99999){
						$voucherbk = "BK/".date('Y')."/".date('m')."/".$no;
					}
					$voucher = $row->voucher;
					$q = $this->db->query("sp_insertpettynewa '".$voucher."','".$voucherbk."'");
					echo "<script>alert('Closing');refreshTable();</script>";
				}
			} else {
				echo "<script>alert('Sudah Di Reimburse');refreshTable();</script>";
			}
		}
	}

}

/* End of file mpettycash.php */
/* Location: ./application/controllers/mpettycash.php */