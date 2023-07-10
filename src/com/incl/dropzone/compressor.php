<?php

namespace Kwerqy\Ember\com\incl\dropzone;

/**
 * @package mod\intf
 * @author Ryno Van Zyl
 */
class compressor extends \Kwerqy\Ember\com\intf\standard {

    private $filename;
    public $image;
    public $image_type;
    public $transparent = true;
    public $background_color = "black";
    public $red = 0;
    public $green = 0;
    public $blue = 0;
    public $alpha = 127;
    //--------------------------------------------------------------------------------
    public function __construct($filename = null) {
        if (!empty($filename)) {
            $this->load($filename);
        }
    }
    //--------------------------------------------------------------------------------
    public function load($filename) {

        $this->filename = $filename;

		if(filesize($filename) == 0) $this->runAndFinish();

        $image_info = getimagesize($filename);
        $this->image_type = isset($image_info[2]) ? $image_info[2] : false;

        if(!$this->image_type){
        	throw new \Exception("The file you're trying to open is not supported");
		}

        if ($this->image_type == IMAGETYPE_JPEG) {
            $this->image = imagecreatefromjpeg($filename);
        } elseif ($this->image_type == IMAGETYPE_GIF) {
            $this->image = imagecreatefromgif($filename);
        } elseif ($this->image_type == IMAGETYPE_PNG) {
            $this->image = imagecreatefrompng($filename);
        } elseif ($this->image_type == IMAGETYPE_BMP) {
			$this->image = $this->imagecreatefrombmp($filename);
        } else {
            throw new \Exception("The file you're trying to open is not supported");
        }
    }
	//--------------------------------------------------------------------------------
	private function runAndFinish(){
		exit();
	}
	//--------------------------------------------------------------------------------
    public function save($filename = false, $image_type = false, $compression = 75, $permissions = null) {

        if(!$filename) $filename = $this->filename;

        if(!is_dir(dirname($filename))) \Kwerqy\Ember\com\os\os::mkdir(dirname($filename));

		if(!$image_type) $image_type = $this->image_type;

//		$filename = str_replace(".jpeg", ".jpg", $filename);
        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image, $filename, $compression);
        } elseif ($image_type == IMAGETYPE_GIF) {
            imagegif($this->image, $filename);
        } elseif ($image_type == IMAGETYPE_PNG) {
            imagepng($this->image, $filename);
        }

        if ($permissions != null) {
            chmod($filename, $permissions);
        }

        return $filename;
    }
    //--------------------------------------------------------------------------------
    public function output($image_type = IMAGETYPE_JPEG, $quality = 80) {
        if ($image_type == IMAGETYPE_JPEG) {
            header("Content-type: image/jpeg");
            imagejpeg($this->image, null, $quality);
        } elseif ($image_type == IMAGETYPE_GIF) {
            header("Content-type: image/gif");
            imagegif($this->image);
        } elseif ($image_type == IMAGETYPE_PNG) {
            header("Content-type: image/png");
            imagepng($this->image);
        }
    }
    //--------------------------------------------------------------------------------
    public function getWidth() {
        return imagesx($this->image);
    }
    //--------------------------------------------------------------------------------
    public function set_background_color($type = "white") {
		$this->background_color = $type;
        switch ($type) {
			case "black":
				$this->red = 0;
				$this->green = 0;
				$this->blue = 0;
				$this->alpha = 0;
				break;
			case "white":
				$this->red = 255;
				$this->green = 255;
				$this->blue = 255;
				$this->alpha = 0;
				break;
		}
    }
    //--------------------------------------------------------------------------------
    public function getHeight() {
        return imagesy($this->image);
    }
    //--------------------------------------------------------------------------------
    public function resizeToHeight($height) {
        $ratio = $height / $this->getHeight();
        $width = round($this->getWidth() * $ratio);
        $this->resize($width, $height);
    }
    //--------------------------------------------------------------------------------
    public function resizeToWidth($width, $height = false) {
        $ratio = $width / $this->getWidth();
        if(!$height){
            $height = round($this->getHeight() * $ratio);
        }
        $this->resize($width, $height);
    }
    //--------------------------------------------------------------------------------
    public function square($size) {
        $new_image = imagecreatetruecolor($size, $size);

        if ($this->getWidth() > $this->getHeight()) {
            $this->resizeToHeight($size);
            if(!$this->transparent){
                switch ($this->background_color) {
                    case "black":
                        $this->red = 0;
                        $this->green = 0;
                        $this->blue = 0;
                        $this->alpha = 0;
                        break;
                    case "white":
                        $this->red = 255;
                        $this->green = 255;
                        $this->blue = 255;
                        $this->alpha = 0;
                        break;
                }
                imagefill($new_image, 0, 0, imagecolorallocatealpha($new_image, $this->red, $this->green, $this->blue, $this->alpha));
            }else{
                imagefill($new_image, 0, 0, imagecolorallocatealpha($new_image, 0, 0, 0, 127));
            }
            imagealphablending($new_image, true);
            imagesavealpha($new_image, true);
            imagecopy($new_image, $this->image, 0, 0, round(($this->getWidth() - $size) / 2), 0, $size, $size);
        } else {
            $this->resizeToWidth($size);

            if(!$this->transparent){
                switch ($this->background_color) {
                    case "black":
                        $this->red = 0;
                        $this->green = 0;
                        $this->blue = 0;
                        $this->alpha = 0;
                        break;
                    case "white":
                        $this->red = 255;
                        $this->green = 255;
                        $this->blue = 255;
                        $this->alpha = 0;
                        break;
                }
                imagefill($new_image, 0, 0, imagecolorallocatealpha($new_image, $this->red, $this->green, $this->blue, $this->alpha));
            }else{
                imagefill($new_image, 0, 0, imagecolorallocatealpha($new_image, 0, 0, 0, 127));
            }
            imagealphablending($new_image, true);
            imagesavealpha($new_image, true);
            imagecopy($new_image, $this->image, 0, 0, 0, ($this->getHeight() - $size) / 2, $size, $size);
        }

        $this->image = $new_image;
    }
    //--------------------------------------------------------------------------------
    public function scale($scale) {
        $width = $this->getWidth() * $scale / 100;
        $height = $this->getHeight() * $scale / 100;
        $this->resize($width, $height);
    }
    //--------------------------------------------------------------------------------
    public function resize($width, $height) {
        $new_image = imagecreatetruecolor($width, $height);

        if(!$this->transparent){
            switch ($this->background_color) {
                case "black":
                    $this->red = 0;
                    $this->green = 0;
                    $this->blue = 0;
                    $this->alpha = 0;
                    break;
                case "white":
                    $this->red = 255;
                    $this->green = 255;
                    $this->blue = 255;
                    $this->alpha = 0;
                    break;
            }
            imagefill($new_image, 0, 0, imagecolorallocatealpha($new_image, $this->red, $this->green, $this->blue, $this->alpha));
        }else{
            imagefill($new_image, 0, 0, imagecolorallocatealpha($new_image, 0, 0, 0, 127));
        }
        imagesavealpha($new_image, true);

        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $new_image;
    }
    //--------------------------------------------------------------------------------
    public function cut($x, $y, $width, $height) {
        $new_image = imagecreatetruecolor($width, $height);

        if(!$this->transparent){
            switch ($this->background_color) {
                case "black":
                    $this->red = 0;
                    $this->green = 0;
                    $this->blue = 0;
                    $this->alpha = 0;
                    break;
                case "white":
                    $this->red = 255;
                    $this->green = 255;
                    $this->blue = 255;
                    $this->alpha = 0;
                    break;
            }
            imagefill($new_image, 0, 0, imagecolorallocatealpha($new_image, $this->red, $this->green, $this->blue, $this->alpha));
        }else{
            imagefill($new_image, 0, 0, imagecolorallocatealpha($new_image, 0, 0, 0, 127));
        }
        imagesavealpha($new_image, true);

        imagecopy($new_image, $this->image, 0, 0, $x, $y, $width, $height);

        return $this->image = $new_image;
    }
    //--------------------------------------------------------------------------------
    public function maxarea($width) {
        $this->resizeToWidth($width);
    }
    //--------------------------------------------------------------------------------
    public function minarea($width, $height = null) {
        $height = $height ? $height : $width;

        if ($this->getWidth() < $width) {
            $this->resizeToWidth($width);
        }
        if ($this->getHeight() < $height) {
            $this->resizeToheight($height);
        }
    }
    //--------------------------------------------------------------------------------
    public function cutFromCenter($width, $height) {

        if ($width < $this->getWidth() && $width > $height) {
            $this->resizeToWidth($width);
        }
        if ($height < $this->getHeight() && $width < $height) {
            $this->resizeToHeight($height);
        }

        $x = ($this->getWidth() / 2) - ($width / 2);
        $y = ($this->getHeight() / 2) - ($height / 2);

        return $this->cut($x, $y, $width, $height);
    }
    //--------------------------------------------------------------------------------
    public function cropToHeight($width, $height) {

        if ($height < $this->getHeight()) {
            $this->resizeToHeight($height);
        }

        $x = ($this->getWidth() / 2) - ($width / 2);
        $y = ($this->getHeight() / 2) - ($height / 2);

        return $this->cut($x, $y, $width, $height);
    }
    //--------------------------------------------------------------------------------
    public function cropToWidth($width, $height) {

        if ($width < $this->getWidth()) {
            $this->resizeToWidth($width);
        }

        $x = ($this->getWidth() / 2) - ($width / 2);
        $y = ($this->getHeight() / 2) - ($height / 2);

        return $this->cut($x, $y, $width, $height);
    }
	//--------------------------------------------------------------------------------
	public function imagecreatefrombmp($filename) {
		if (!function_exists("imagecreatetruecolor")) {
            trigger_error("The PHP GD extension is required, but is not installed.", E_ERROR);
            return false;
        }
        // version 1.00
        if (!($fh = fopen($filename, 'rb'))) {
            trigger_error('imagecreatefrombmp: Can not open ' . $filename, E_USER_WARNING);
            return false;
        }
        $bytes_read = 0;
        // read file header
        $meta = unpack('vtype/Vfilesize/Vreserved/Voffset', fread($fh, 14));
        // check for bitmap
        if ($meta['type'] != 19778) {
            trigger_error('imagecreatefrombmp: ' . $filename . ' is not a bitmap!', E_USER_WARNING);
            return false;
        }
        // read image header
        $meta += unpack('Vheadersize/Vwidth/Vheight/vplanes/vbits/Vcompression/Vimagesize/Vxres/Vyres/Vcolors/Vimportant', fread($fh, 40));
        $bytes_read += 40;
        // read additional bitfield header
        if ($meta['compression'] == 3) {
            $meta += unpack('VrMask/VgMask/VbMask', fread($fh, 12));
            $bytes_read += 12;
        }
        // set bytes and padding
        $meta['bytes'] = $meta['bits'] / 8;
        $meta['decal'] = 4 - (4 * (($meta['width'] * $meta['bytes'] / 4) - floor($meta['width'] * $meta['bytes'] / 4)));
        if ($meta['decal'] == 4) {
            $meta['decal'] = 0;
        }
        // obtain imagesize
        if ($meta['imagesize'] < 1) {
            $meta['imagesize'] = $meta['filesize'] - $meta['offset'];
            // in rare cases filesize is equal to offset so we need to read physical size
            if ($meta['imagesize'] < 1) {
                $meta['imagesize'] = @filesize($filename) - $meta['offset'];
                if ($meta['imagesize'] < 1) {
                    trigger_error('imagecreatefrombmp: Can not obtain filesize of ' . $filename . '!', E_USER_WARNING);
                    return false;
                }
            }
        }
        // calculate colors
        $meta['colors'] = !$meta['colors'] ? pow(2, $meta['bits']) : $meta['colors'];
        // read color palette
        $palette = array();
        if ($meta['bits'] < 16) {
            $palette = unpack('l' . $meta['colors'], fread($fh, $meta['colors'] * 4));
            // in rare cases the color value is signed
            if ($palette[1] < 0) {
                foreach ($palette as $i => $color) {
                    $palette[$i] = $color + 16777216;
                }
            }
        }
        // ignore extra bitmap headers
        if ($meta['headersize'] > $bytes_read) {
            fread($fh, $meta['headersize'] - $bytes_read);
        }
        // create gd image
        $im = imagecreatetruecolor($meta['width'], $meta['height']);
        $data = fread($fh, $meta['imagesize']);
        // uncompress data
        switch ($meta['compression']) {
            case 1:
                $data = Helpers::rle8_decode($data, $meta['width']);
                break;
            case 2:
                $data = Helpers::rle4_decode($data, $meta['width']);
                break;
        }
        $p = 0;
        $vide = chr(0);
        $y = $meta['height'] - 1;
        $error = 'imagecreatefrombmp: ' . $filename . ' has not enough data!';
        // loop through the image data beginning with the lower left corner
        while ($y >= 0) {
            $x = 0;
            while ($x < $meta['width']) {
                switch ($meta['bits']) {
                    case 32:
                    case 24:
                        if (!($part = substr($data, $p, 3 /*$meta['bytes']*/))) {
                            trigger_error($error, E_USER_WARNING);
                            return $im;
                        }
                        $color = unpack('V', $part . $vide);
                        break;
                    case 16:
                        if (!($part = substr($data, $p, 2 /*$meta['bytes']*/))) {
                            trigger_error($error, E_USER_WARNING);
                            return $im;
                        }
                        $color = unpack('v', $part);
                        if (empty($meta['rMask']) || $meta['rMask'] != 0xf800) {
                            $color[1] = (($color[1] & 0x7c00) >> 7) * 65536 + (($color[1] & 0x03e0) >> 2) * 256 + (($color[1] & 0x001f) << 3); // 555
                        } else {
                            $color[1] = (($color[1] & 0xf800) >> 8) * 65536 + (($color[1] & 0x07e0) >> 3) * 256 + (($color[1] & 0x001f) << 3); // 565
                        }
                        break;
                    case 8:
                        $color = unpack('n', $vide . substr($data, $p, 1));
                        $color[1] = $palette[$color[1] + 1];
                        break;
                    case 4:
                        $color = unpack('n', $vide . substr($data, floor($p), 1));
                        $color[1] = ($p * 2) % 2 == 0 ? $color[1] >> 4 : $color[1] & 0x0F;
                        $color[1] = $palette[$color[1] + 1];
                        break;
                    case 1:
                        $color = unpack('n', $vide . substr($data, floor($p), 1));
                        switch (($p * 8) % 8) {
                            case 0:
                                $color[1] = $color[1] >> 7;
                                break;
                            case 1:
                                $color[1] = ($color[1] & 0x40) >> 6;
                                break;
                            case 2:
                                $color[1] = ($color[1] & 0x20) >> 5;
                                break;
                            case 3:
                                $color[1] = ($color[1] & 0x10) >> 4;
                                break;
                            case 4:
                                $color[1] = ($color[1] & 0x8) >> 3;
                                break;
                            case 5:
                                $color[1] = ($color[1] & 0x4) >> 2;
                                break;
                            case 6:
                                $color[1] = ($color[1] & 0x2) >> 1;
                                break;
                            case 7:
                                $color[1] = ($color[1] & 0x1);
                                break;
                        }
                        $color[1] = $palette[$color[1] + 1];
                        break;
                    default:
                        trigger_error('imagecreatefrombmp: ' . $filename . ' has ' . $meta['bits'] . ' bits and this is not supported!', E_USER_WARNING);
                        return false;
                }
                imagesetpixel($im, $x, $y, $color[1]);
                $x++;
                $p += $meta['bytes'];
            }
            $y--;
            $p += $meta['decal'];
        }
        fclose($fh);
        return $im;
	}
    //--------------------------------------------------------------------------------
    public function maxareafill($width, $height, $options = []) {

        $options = array_merge([
            "resize_to" => false
        ], $options);

		if($options["resize_to"] == "width") $this->resizeToWidth(($width));
		if($options["resize_to"] == "height") $this->resizeToHeight(($height));

        $this->maxarea($width, $height);
        $new_image = imagecreatetruecolor($width, $height);
        $color_fill = imagecolorallocate($new_image, $this->red, $this->green, $this->blue);
        imagefill($new_image, 0, 0, $color_fill);
        imagecopyresampled($new_image, $this->image, floor(($width - $this->getWidth()) / 2), floor(($height - $this->getHeight()) / 2), 0, 0, $this->getWidth(), $this->getHeight(), $this->getWidth(), $this->getHeight());
        $this->image = $new_image;
    }
    //--------------------------------------------------------------------------------

}

//// Usage:
//// Load the original image
//$image = new app_compressor('lemon.jpg');
//
//// Resize the image to 600px width and the proportional height
//$image->resizeToWidth(600);
//$image->save('lemon_resized.jpg');
//
//// Create a squared version of the image
//$image->square(200);
//$image->save('lemon_squared.jpg');
//
//// Scales the image to 75%
//$image->scale(75);
//$image->save('lemon_scaled.jpg');
//
//// Resize the image to specific width and height
//$image->resize(80,60);
//$image->save('lemon_resized2.jpg');
//
//// Resize the canvas and fill the empty space with a color of your choice
//$image->maxareafill(600,400, 32, 39, 240);
//$image->save('lemon_filled.jpg');
//
//// Output the image to the browser:
//$image->output();
