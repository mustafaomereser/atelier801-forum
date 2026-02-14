<?php
/**
 * Image processing class
 *
 * @package framework.components
 * @since 1.0.0
 */
class pjImage
{
/**
 * RGB color
 * 
 * @var array
 * @access private
 */
	private $color = array(255, 255, 255);
/**
 * Font path
 *
 * @var string
 * @access private
 */
	private $font;
/**
 * Font size
 *
 * @var int
 * @access private
 */
	private $fontSize;
/**
 * Image resource identifier
 *
 * @var resource
 * @access private
 */
	private $image;
/**
 * One of the IMAGETYPE_* constants indicating the type of the image.
 *
 * @var int
 * @access private
 */
	private $imageType;
/**
 * Image width
 * 
 * @var int
 * @access private
 */
	private $width;
/**
 * Image height
 *
 * @var int
 * @access private
 */
	private $height;
	

	private $file;
/**
 * Constructor - automatically called when you create a new instance of a class with new
 *
 * @access public
 * @return self
 */
	public function __construct()
	{
		if (!extension_loaded('gd') || !function_exists('gd_info'))
		{
			$this->error = "GD extension is not loaded";
			$this->errorCode = 200;
		}
	}
/**
 * Get color
 *
 * @access public
 * @return array
 */
	public function getColor()
	{
		return $this->color;
	}

	public function getHeight()
	{
		return imagesy($this->getImage());
	}
/**
 * Get image resource
 *
 * @access public
 * @return resource
 */
	public function getImage()
	{
		return $this->image;
	}
/**
 * Get the size of an image
 *
 * @access public
 * @return Returns an array with 7 elements.
 */
	public function getImageSize()
    {
    	return getimagesize($this->file['tmp_name']);
    }
/**
 * Get the type of image resource
 * 
 * @access public
 * @return number
 */
    public function getImageType()
    {
    	return $this->imageType;
    }
/**
 * Get image width
 *
 * @access public
 * @return int|false Return the width of the image or FALSE on errors.
 */
	public function getWidth()
	{
		return imagesx($this->getImage());
	}
/**
 * Check if system memory is enough for image processing
 *
 * @access public
 * @return array
 */
	public function isConvertPossible()
	{
		$status = true;
		if (function_exists('memory_get_usage') && ini_get('memory_limit'))
		{
			$info = $this->getImageSize();
			$MB = 1024 * 1024;
			$K64 = 64 * 1024;
			$tweak_factor = 1.6;
			$channels = isset($info['channels']) ? $info['channels'] : 3;
			$memory_needed = round(($info[0] * $info[1] * $info['bits'] * $channels / 8 + $K64) * $tweak_factor);
			$memory_needed = memory_get_usage() + $memory_needed;
			$memory_limit = ini_get('memory_limit');
			if ($memory_limit != '')
			{
				$memory_limit = substr($memory_limit, 0, -1) * $MB;
			}
			if ($memory_needed > $memory_limit)
			{
				$status = false;
			}
		}
		return compact('status', 'memory_needed', 'memory_limit');
	}
/**
 * Load locale image file for later processing
 *
 * @param string $path The path to image
 * @access public
 * @return self
 */
	public function loadImage($path=NULL)
	{
		if (!is_null($path))
		{
			$this->file = array(
				'tmp_name' => $path,
				'name' => basename($path)
			);
		}
		$info = $this->getImageSize();
		
		$this->width = $info[0];
		$this->height = $info[1];
		$this->setImageType($info[2]);
		$file = $path;
		
		switch ($this->imageType)
		{
			case IMAGETYPE_JPEG:
				$this->setImage(@imagecreatefromjpeg($file));
				break;
			case IMAGETYPE_GIF:
				$this->setImage(@imagecreatefromgif($file));
				break;
			case IMAGETYPE_PNG:
				$this->setImage(@imagecreatefrompng($file));
				break;
		}
		return $this;
	}

/**
 * Set image resource
 * 
 * @param resource $resource
 * @access public
 * @return self
 */
	public function setImage($resource)
	{
		if (is_resource($resource))
		{
			$this->image = $resource;
		}
		return $this;
	}
/**
 * Set the type of image resource
 *  
 * @param int $value
 * @return self
 */
	public function setImageType($value)
	{
		if (is_int($value))
		{
			$this->imageType = $value;
		}
		return $this;
	}
/**
 * Outputs image without saving
 * 
 * @param string $image_type
 * @param number $compression
 */	
	public function output($compression=100,$path)
	{
		$image = $this->getImage();
		//$renk = imagecolorallocate($image, 255, 255, 255);
		//imagefill($image, 0, 0, $renk);
		
		
		switch ($this->imageType)
		{
			case IMAGETYPE_JPEG:
				//header("Content-Type: image/jpeg");
				imageinterlace($image, true);
				imagejpeg($image, $path, $compression);
				imagedestroy($image);
				break;
			case IMAGETYPE_GIF:
				//header("Content-Type: image/gif");
				imagegif($image,$path);
				imagedestroy($image);
				break;
			case IMAGETYPE_PNG:
				//header("Content-Type: image/png");
				imagepng($image,$path);
				imagedestroy($image);
				break;
		}
		
		
	}
	/**
	 * Image resize to fixed size
	 *
	 * @param int $width
	 * @param int $height
	 * @access public
	 * @return self
	 */
	public function resize($width, $height)
	{
		$new_image = imagecreatetruecolor($width, $height);
		imagecopyresampled($new_image, $this->image, $width/50, $height/50, 0, 0, ($width-($width/25)), ($height-($height/25)), $this->getWidth(), $this->getHeight());
		$this->image = $new_image;
	}

}
?>