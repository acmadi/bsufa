<?
	defined('BASEPATH') or die('Access Denied');
	
	class mstbudgetdiv extends AdminPage{

		function mstbudget()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function get_kperdetail($id){
			$this->load->Model('mstbudgetdiv_model','mstbudget');
			echo json_encode((array)$this->mstbudget->get_kperdetail($id));
		}
		
		function index(){		
			$this->load->Model('mstbudgetdiv_model','mstbudget');
			
			$data['proyek'] = $this->mstbudget->get_proyek();
			$data['divisi'] = $this->mstbudget->get_divisi();
			$data['kper'] = $this->mstbudget->get_kper();
			$this->parameters['data'] = $data;	
			
			
			if($this->input->post('simpan')){
				#Replace Coma
				
				$jan =	str_replace(",","",$this->input->post('jan'));
				$feb =	str_replace(",","",$this->input->post('feb'));
				$mar =	str_replace(",","",$this->input->post('mar'));
				$apr =	str_replace(",","",$this->input->post('apr'));
				$mei =	str_replace(",","",$this->input->post('mei'));
				$jun =	str_replace(",","",$this->input->post('jun'));
				$jul =	str_replace(",","",$this->input->post('jul'));
				$ags =	str_replace(",","",$this->input->post('ags'));
				$sep =	str_replace(",","",$this->input->post('sep'));
				$okt =	str_replace(",","",$this->input->post('okt'));
				$nop =	str_replace(",","",$this->input->post('nop'));
				$des =	str_replace(",","",$this->input->post('des'));
				$tot = 	str_replace(",","",$this->input->post('tot'));
				
				
				
				/*var_dump($tot);*/
				$insert_data = array(
					'prj' => $this->input->post('prj'),
					'kodeacc' => $this->input->post('kodeacc'),
					'nama' => $this->input->post('nama'),
					'div' => $this->input->post('div'),
					'code' => $this->input->post('code'),
					'thn' => $this->input->post('thn'),
					'jan' => $jan,
					'feb' => $feb,
					'mar' => $mar,
					'apr' => $apr,
					'mei' => $mei,
					'jun' => $jun,
					'jul' => $jul,
					'ags' => $ags,
					'sep' => $sep,
					'okt' => $okt,
					'nop' => $nop,
					'des' => $des,
					'tot' => $tot,
					'codedesc' => $this->input->post('codedesc'),
					'id_user' => $this->input->post('id_user'),
					
				);
					$proses = $this->mstbudget->insertbudgetdiv($insert_data);
			
		}
			
			
			
			
			$this->loadTemplate('mis/mstbudgetdiv_view');
			
		}		
		

		
	}
?>
