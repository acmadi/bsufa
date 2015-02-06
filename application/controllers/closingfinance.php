<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class closingfinance extends DBController {

	function __construct(){
		parent::__construct('closingfinance_model');
		$this->set_page_title('Closing Month');
		$this->template_dir = 'finance/closing';
	}

	/*function get_json()
	{
		$this->set_custom_function('','');
		parent::get_json();
	}*/

	function index()
	{
		$this->set_grid_column('id_closf','ID',array('hidden'=>true));
		$this->set_grid_column('nm_pt','Company',array('width'=>40,'align'=>'Left'));
		$this->set_grid_column('periode_tahun','Periode Tahun',array('width'=>60,'align'=>'Left'));
		$this->set_grid_column('periode_bulan','Periode Bulan',array('width'=>60,'align'=>'Left'));		
		$this->set_jqgrid_options(array('width'=>800,'height'=>300,'caption'=>'Closing Month','rownumbers'=>true,'sortname'=>'id_closf','sortorder'=>'desc'));
		parent::index();
	}

	function closingf()
	{  //
		$session_id = $this->UserLogin->isLogin();
		$user = $session_id['username'];
		$pt = $session_id['id_pt'];
		$input = date('Y-m-d');
		$cek = $this->db->query("select top 1 * from db_closingfinance order by id_closf desc")->row();
		$month = $cek->periode_bulan;
		$bulan = $month + 1;
		if($bulan > 12){
			$tahun = $cek->periode_tahun + 1;
			$bulan = 1;
		} else {
			$tahun = $cek->periode_tahun;
		}
		$data = array(
		'id_pt'			=> $pt,
		'periode_tahun'	=> $tahun,
		'periode_bulan'	=> $bulan,
		'tgl_input'		=> $input,
		'user_input'	=> $user
		);
		$this->db->insert('db_closingfinance',$data);
		//var_dump($input);exit();
		//$this->db->query("sp_closingfinance '".$tahun."','".$bulan."','".$pt."','".$user."','".$input."'");

	}

	function unclosingf($id)
	{
		$this->db->where('id_closf', $id);
		$this->db->delete('db_closingfinance');
	}

}

/* End of file closingfinance.php */
/* Location: ./application/controllers/closingfinance.php */