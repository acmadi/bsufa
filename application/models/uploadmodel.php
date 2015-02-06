<?
	if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class UploadModel extends Model{
		var $filepath = '';
		var $upload = NULL;
		
		function UploadModel(){
			parent::Model();
			$this->load->library('upload');		
		}
		
		function setup($filepath){
			$this->filepath = $filepath;
			
		    $config['upload_path'] = $filepath;
		    $config['allowed_types'] = 'gif|jpg|jpeg|bmp|png|pdf|txt|swf';
			
			$this->upload->initialize($config);
		}
						
		function fileExists($fileName){
			return is_file($this->filepath.$fileName);
		}
		
		function deleteFile($fileName){
			return @unlink($this->filepath.$fileName);
		}
		
		function doUpload($fieldName){
			if($this->upload->do_upload($fieldName)){
			  $dataUpload = $this->upload->data();
			  return $dataUpload['file_name'];			
			}else return NULL;
		}
		
		function getError(){
			return $this->upload->display_errors();
		}
	}	
?>
