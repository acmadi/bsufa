<?
	defined('BASEPATH') or die('Access Denied');
	
	class BaseUpload_model extends Base_model{
		var $fieldFile = 'image_location';
		var $filePath = 'images/';
		
		function BaseUpload_model(){
			parent::Base_model();
			$this->load->model('UploadModel','upl');
		}
		
		function save($id = false){
			$oldfile_location = $this->input->post('old_'.$this->fieldFile);
			if(is_upload($this->fieldFile)){
			  $this->upl->setup($this->filePath);
			  
			  if($oldfile_location && $this->upl->fileExists($oldfile_location)) 
			    $this->upl->deleteFile($oldfile_location);
			  $result = $this->upl->doUpload($this->fieldFile);
				
			  if(!$result){
				$this->errorMessage("Upload Failed<br>".$this->upl->getError());
				return false;
			  }else{
			  	$this->db->set($this->fieldFile,$result);		
			  	return parent::save($id);
			  }
			}else{
			  return parent::save($id);
/*
			  if($id) return parent::save($id);
			  else{
			  	$this->errorMessage("No Selected File Upload");
			  	return false;
			  }
*/
			}	
		}
		
		function delete($id){
			$this->upl->setup($this->filePath);
			$this->upl->deleteFile($this->getValue($this->fieldFile,$id));
			return parent::delete($id);
		}
	}
?>
