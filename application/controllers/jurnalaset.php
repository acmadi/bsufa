<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class jurnalaset extends DBController {

	function __construct()
	{
		parent::__construct('jurnalaset_model');
		$this->set_page_title('JOURNAL ASSET');
		$this->default_limit = 30;
		$this->template_dir = 'accounting/jurnalaset';
		//$this->load->model('');
	}

	function get_json()
	{
		$this->set_custom_function('trans_date','indo_date');
		$this->set_custom_function('debet','currency');
		$this->set_custom_function('tgl_penerimaan','indo_date');
		$this->set_custom_function('nilai_aset','currency');
		parent::get_json();
	}

	function index()
	{
		$this->set_grid_column('id','ID',array('hidden'=>true));
		$this->set_grid_column('kd_aset','Kode Aset',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('nm_brg','Nama Aset',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('nilai_aset','Nilai Aset',array('width'=>200, 'formatter' => 'cellColumn'));	
		$this->set_grid_column('debet','Nilai Depresiasi',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('trans_date','Due Date',array('width'=>200, 'formatter' => 'cellColumn'));	
		$this->set_grid_column('tgl_penerimaan','Date',array('width'=>200, 'formatter' => 'cellColumn'));	
		$this->set_jqgrid_options_ceklist(array('width'=>1300,'height'=>350,'caption'=>'JOURNAL ASSET','rownumbers'=>true,'sortname'=>'trans_date','sortorder'=>'asc'));
		parent::index();	
	}

	function postingjurnal($id){
		$jml=strlen($id);
        $a=explode(',',$id);
        $ja=count($a);
        $tgl = date('Y-m-d');
        //var_dump($a);exit();
        for ($i=0; $i < $ja; $i++) {
        	if ($i == ($ja-1)) {
        	 	$pecah = explode('&', $a[$i]);
        	 	$id = $pecah[0];
        	 	$this->db->query("sp_postjurnalaset ".$id.",'".$tgl."' ");
        	 } else {
        	 	$this->db->query("sp_postjurnalaset ".$a[$i].",'".$tgl."' ");
        	 }
        }
		echo "<script>
			alert('sukses posting');
			refreshTable();
		</script>";
	}

	function unpostingjurnal($id){
		$jml=strlen($id);
        $a=explode(',',$id);
        $ja=count($a);
        $tgl = date('Y-m-d');
        //var_dump($a);exit();
        for ($i=0; $i < $ja; $i++) {
        	if ($i == ($ja-1)) {
        	 	$pecah = explode('&', $a[$i]);
        	 	$id = $pecah[0];
        	 	$this->db->query("sp_unpostjurnalaset ".$id.",'".$tgl."' ");
        	 } else {
        	 	$this->db->query("sp_unpostjurnalaset ".$a[$i].",'".$tgl."' ");
        	 }
        }
		echo "<script>
			alert('sukses unposting');
			refreshTable();
		</script>";
	}

}

/* End of file jurnalaset.php */
/* Location: ./application/controllers/jurnalaset.php */