<?php

class ResizeImage
{
	private $ext;
	private $image;
	private $newImage;
	private $origWidth;
	private $origHeight;
	private $resizeWidth;
	private $resizeHeight;

	public function __construct( $filename )
	{
		if(file_exists($filename))
		{
			$this->setImage( $filename );
		} else {
			throw new Exception('L\'image ' . $filename . ' n\'existe pas.');
		}
	}

	private function setImage( $filename )
	{
		$size = getimagesize($filename);
		$this->ext = $size['mime'];

		switch($this->ext)
	    {
	        case 'image/jpg':
	        case 'image/jpeg':
	            $this->image = imagecreatefromjpeg($filename);
	            break;

	        case 'image/gif':
	            $this->image = @imagecreatefromgif($filename);
	            break;

	        case 'image/png':
	            $this->image = @imagecreatefrompng($filename);
	            break;

	        default:
	            throw new Exception("Le fichier n'est pas une image.", 1);
	    }

	    $this->origWidth = imagesx($this->image);
	    $this->origHeight = imagesy($this->image);
	}

	public function getWidth() {
		return $this->origWidth;
	}

	public function getHeight() {
		return $this->origHeight;
	}

	public function saveImage($savePath, $imageQuality="100", $download = false)
	{
	    switch($this->ext)
	    {
	        case 'image/jpg':
	        case 'image/jpeg':
	            if (imagetypes() & IMG_JPG) {
	                imagejpeg($this->newImage, $savePath, $imageQuality);
	            }
	            break;

	        case 'image/gif':
	            if (imagetypes() & IMG_GIF) {
	                imagegif($this->newImage, $savePath);
	            }
	            break;

	        case 'image/png':
	            $invertScaleQuality = 9 - round(($imageQuality/100) * 9);

	            if (imagetypes() & IMG_PNG) {
	                imagepng($this->newImage, $savePath, $invertScaleQuality);
	            }
	            break;
	    }

	    if($download)
	    {
	    	header('Content-Description: File Transfer');
			header("Content-type: application/octet-stream");
			header("Content-disposition: attachment; filename= ".$savePath."");
			readfile($savePath);
	    }

	    imagedestroy($this->newImage);
	}

	public function resizeTo( $width, $height, $resizeOption = 'default' )
	{
		switch(strtolower($resizeOption))
		{
			case 'exact':
				$this->resizeWidth = $width;
				$this->resizeHeight = $height;
			break;

			case 'maxwidth':
				if($this->origWidth > $width) {
					$this->resizeWidth  = $width;
					$this->resizeHeight = $this->resizeHeightByWidth($width);
				} else {
					$this->resizeWidth = $this->origWidth;
					$this->resizeHeight = $this->origHeight;
				}
				
			break;

			case 'maxheight':
				$this->resizeWidth  = $this->resizeWidthByHeight($height);
				$this->resizeHeight = $height;
			break;

			case 'precrop': //Redimensionnement de l'image avant crop pour la partie admin 
				if($this->origWidth > $width || $this->origHeight > $height)
				{
					if ( $this->origWidth <= $this->origHeight ) {
				    	 $this->resizeHeight = $this->resizeHeightByWidth($width);
			  			 $this->resizeWidth  = $width;
					} else if( $this->origWidth > $this->origHeight ) {
						$this->resizeWidth  = $this->resizeWidthByHeight($height);
						$this->resizeHeight = $height;
					}
				} else {
		            $this->resizeWidth = $this->origWidth;
		            $this->resizeHeight = $this->origHeight;
		        }
			break;

			case 'crop': //crop pour la partie admin

		        if($this->origWidth < 120 || $this->origHeight < 120) { //Si l'image d'origine est plus petite que le thumbnail désiré, pas de crop
		        	$this->newImage = imagecreatetruecolor($this->origWidth, $this->origHeight);
					return imagecopyresampled($this->newImage, $this->image, 0, 0, 0, 0, $this->origWidth, $this->origHeight, $this->origWidth, $this->origHeight);
					break;
				}

				if($this->origWidth > $width || $this->origHeight > $height)
				{
					if ( $this->origWidth <= $this->origHeight ) {
				    	 $this->resizeHeight = $this->resizeHeightByWidth($width);
			  			 $this->resizeWidth  = $width;
					} else if( $this->origWidth > $this->origHeight ) {
						$this->resizeWidth  = $this->resizeWidthByHeight($height);
						$this->resizeHeight = $height;
					}
				} else {
		            $this->resizeWidth = $this->origWidth;
		            $this->resizeHeight = $this->origHeight;
		        }

		        $centreX = round($this->resizeWidth / 2);
	            $centreY = round($this->resizeHeight / 2);

	            //dimensions : 120x120
	            $x1 = $centreX - 60;
	            $y1 = $centreY - 60; 
	            $x2 = $centreX + 60;
	            $y2 = $centreY + 60;

	            if($this->resizeWidth == 120) {
	            	$this->resizeHeight = $y2 - $y1;
	            } elseif ($this->resizeHeight == 120) {
	            	$this->resizeWidth = $x2 - $x1;
	            }
			break;

			default:
				if($this->origWidth > $width || $this->origHeight > $height)
				{
					if ( $this->origWidth >= $this->origHeight ) {
				    	 $this->resizeHeight = $this->resizeHeightByWidth($width);
			  			 $this->resizeWidth  = $width;
					} else if( $this->origWidth < $this->origHeight ) {
						$this->resizeWidth  = $this->resizeWidthByHeight($height);
						$this->resizeHeight = $height;
					}
				} else {
		            $this->resizeWidth = $this->origWidth;
		            $this->resizeHeight = $this->origHeight;
		        }
			break;
		}


		$this->newImage = imagecreatetruecolor($this->resizeWidth, $this->resizeHeight);
		if($resizeOption == "crop") {
			return imagecopy($this->newImage, $this->image, 0, 0, $x1, $y1, $this->resizeWidth, $this->resizeHeight);
		} else {
			imagecopyresampled($this->newImage, $this->image, 0, 0, 0, 0, $this->resizeWidth, $this->resizeHeight, $this->origWidth, $this->origHeight);
		}
    	
	}

	private function resizeHeightByWidth($width)
	{
		return floor(($this->origHeight/$this->origWidth)*$width);
	}

	private function resizeWidthByHeight($height)
	{
		return floor(($this->origWidth/$this->origHeight)*$height);
	}
}
?>