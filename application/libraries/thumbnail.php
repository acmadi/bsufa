<?
	class Thumbnail{
		var $maxWidth = 200; // default lebar maksimal adalah 200px
		
		function Thumbnail(){
		}
		
		function setMaxWidth($maxWidth){ // method untuk mengubah nilai lebar maksimal
			$this->maxWidth = $maxWidth;
		}
		
		function getThumbnail($path){			
			$maxheight = $this->maxWidth; // tinggi maksimal disamakan saja dengan lebar maksimal
			
			if(file_exists($path)){
				list($width,$height)=getimagesize($path);
				if($width < $this->maxWidth){
					$new_width  = $width;
					$new_height = $height;
				}else{
					if($width>$height) $ratio=$this->maxWidth/$width;
					else $ratio = $maxheight/$height;
			
					$new_width  = $ratio*$width;
					$new_height = $ratio*$height;			
				}
				
			  $ext=strtolower(strchr(basename($path),"."));
			  switch($ext){
			   case ".jpeg":
			   case ".jpg": 
			      $header = "jpeg";
				  $func1="imagecreatefromjpeg";
				  $func2="imagejpeg";
				break;					
			   case ".gif": 
			      $header = "gif";
				  $func1="imagecreatefromgif";
				  $func2="imagegif";
				break;
			   case ".png": 
				  $header = "png";
				  $func1="imagecreatefrompng";
				  $func2="imagepng";
				break;
			  }
			  header("Content-type: image/$header");
				
			  $thumb  = imagecreatetruecolor($new_width,$new_height);
			  $source = $func1($path);
			  imagecopyresized($thumb,$source,0,0,0,0,$new_width,$new_height,$width,$height);
			  $func2($thumb);	  
			}
		}		
	}
?>
