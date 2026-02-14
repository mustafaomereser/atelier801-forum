<?php
class Avatar{
	var $image;
	var $image_type;
	
	function load($filename){
		$image_info = getimagesize($filename);
		$this->image_type = $image_info[2];
		if ($this->image_type == IMAGETYPE_JPEG){
			$this->image = imagecreatefromjpeg($filename);
		}elseif ($this->image_type == IMAGETYPE_PNG){
			$this->image = imagecreatefrompng($filename);
		}
	}
	
	function save($filename, $image_type = IMAGETYPE_JPEG, $compression = 100, $permissions = null){
		if ($image_type == IMAGETYPE_JPEG){
			imagejpeg($this->image,$filename,$compression);
		}elseif ($image_type == IMAGETYPE_PNG){
			imagejpeg($this->image,$filename,100);
			$image_type = IMAGETYPE_JPEG;
		}
		
		if ($permissions != null){
			chmod($filename,$permissions);
		}
	}
	

	function getWidth(){
		return imagesx($this->image);
	}
	
	function getHeight(){
		return imagesy($this->image);
	}
	
	function resize($width,$height){
		$new_image = imagecreatetruecolor($width, $height);
		imagecopyresampled($new_image, $this->image, $width/50, $height/50, 0, 0, ($width-($width/25)), ($height-($height/25)), $this->getWidth(), $this->getHeight());
		$this->image = $new_image;
	}
}



						$_Avatar = new Avatar();
						$_Avatar->load("1.jpg");
						$_Avatar->resize(100,100);
						$_Avatar->save("Deneme.jpg");
 
?>


<img src="Deneme.jpg">
