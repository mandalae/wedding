<?php
require_once '_inc/phpthumb/ThumbLib.inc.php';

class Image extends Content {
    
    protected $_tableName = 'images';
    private $_cachePath = 'http://aqua.rpediem.com/images';
    private $_realPath = '/home/rpediem/public_html/aqua/images/';
    //private $_iccPath = '/Users/skaa/Sites/aquatron.co.uk/icc';
    private $_im;
    private $_thumb = null;
    
    function Image($data = null){
        $this->_im = new Imagick();
        $this->_realPath = str_replace('mobile', '', $_SERVER['DOCUMENT_ROOT']) . "/images/";
        parent::__construct($data);
    }
    
    public function addTags($tags){
        $it = new Image_Tag();
        $it->addTags($tags, $this->getId());
    }
    
    public function getAll($offset = 0, $limit = 25, $q = null){
        if (is_null($q)){
            $sql = "SELECT * FROM " . $this->_tableName . " ORDER BY timestamp DESC";
        } else {
            $sql = "SELECT 
                        i.* 
                    FROM 
                        " . $this->_tableName . " i, 
                        image_tags it
                    WHERE 
                        i.id = it.image_id AND
                        it.tag LIKE '%" . $q . "%' 
                    GROUP BY 
                        i.id
                    ORDER BY 
                        i.timestamp DESC
                    ";
        }
        if ($limit > 0){
            $sql .= " LIMIT ".$offset.", " . $limit;
        }
        $res = $this->_db->query($sql);
        $return = array();
        while ($row = mysql_fetch_array($res)){
            $return[] = new Image($row);
        }
        return $return;
    }
    
    public function getTag($width = 0, $height = 0){
        $path = $this->getPath($width, $height);
        if ($path == 'about:blank') return '<img src="/_gfx/blank.gif" width="'.$width.'" height="'.$height.'" alt="'.$this->getName().'" />';
        
        $info = $this->identifyImage($path);

        $width = $info['width'];
        $height = $info['height'];

        return '<img src="'.$path.'" width="'.$width.'" height="'.$height.'" alt="'.$this->getName().'" />';
    }
    
    public function getImageName($width = 0, $height = 0){
        if ($width == 0 && $height == 0){
            return $this->getId().'-'.$this->getWidth().'x'.$this->getHeight().'.'.$this->getExt();
        } else {
            return $this->getId().'-'.$width.'x'.$height.'.'.$this->getExt();
        }
    }
    
    public function identifyImage($file)
    {
    	$this->_im->readImage($file);
    	return $this->_im->identifyImage();
    	
//    	$this->thumb = PhpThumbFactory::create($file);
//
//    	$dimensions = $this->thumb->getCurrentImageInformation();
//    	return $dimensions;
    }
    
    public function generateOrigFilename($id = 0)
    {		
    	if ($id == 0) $id = $this->getId();
    	
    	$dir = $this->getIdDir($id, true, true);
    	
    	return $dir.$this->getImageName();
    }
    
    
    public function getPath($width = 0, $height = 0){
        $dir = $this->_realPath.$this->getIdDir($this->getId());
        if ($width == 0 && $height == 0){
            $width = $this->getWidth();
            $height = $this->getHeight();
        }
        
        $fileName = $dir.$this->getImageName($width, $height);

        if (file_exists($fileName)){
            return $this->_cachePath .'/'. str_replace($this->_realPath, '', $fileName);
        } else {
            // Create image
            $origFile = $dir.$this->getImageName();

            if (!is_file($origFile)) return 'about:blank';
            
            $this->_im->clear();
			$this->_im->readImage($origFile);
			$info = $this->_im->identifyImage($origFile);

			if ($info['colorSpace'] == 'CMYK') {
				$profiles = $this->_im->getImageProfiles('*', false); // get profiles
				$has_icc_profile = (array_search('icc', $profiles) !== false); // we're interested if ICC profile(s) exist

				if ($has_icc_profile === false) {
					// image does not have CMYK ICC profile, we add one
					$icc_cmyk = file_get_contents($this->_iccPath.'/USWebCoatedSWOP.icc');
					$this->_im->profileImage('icc', $icc_cmyk);
				}

				// Then we need to add RGB profile
				$icc_rgb = file_get_contents($this->_iccPath.'/AdobeRGB1998.icc');
				$this->_im->profileImage('icc', $icc_rgb);
			}

			$this->_im->setImageColorSpace(Imagick::COLORSPACE_RGB);
			if ($width == 0){
				$width = $this->calculate('width', $height, $info['geometry']);
			}
			if ($height == 0){
				$height = $this->calculate('height', $width, $info['geometry']);
			}
			
			if ($width > $info['geometry']['width']){
				$width = $info['geometry']['width'];
			}
			if ($height > $info['geometry']['height']){
				$height = $info['geometry']['height'];
			}
			
			$crop = true;
			if ($crop) {
				$this->_im->cropThumbnailImage($width, $height);
			} else {
				$this->_im->thumbnailImage($width, $height);
			}

			$this->_im->setImageFormat("jpg");
			$this->_im->setCompression(Imagick::COMPRESSION_JPEG);
			$this->_im->setCompressionQuality(80);
			$this->_im->writeImage($fileName);
			$this->_im->clear();
			
			
//			$this->thumb = PhpThumbFactory::create($origFile);
//			
//			$dimensions = $this->thumb->getCurrentDimensions();
//			
//			if ($width == 0 && $height == 0) {
//				$this->thumb->save($fileName);
				//copy($tmpName, $fileName);
//				chmod($fileName, 0666);
				//unlink($tmpName);
				//copy($this->getPath(), $imagepath);
//			} else {
//			    if ($width == 0){
//			    	$width = $this->calculate('width', $height, $dimensions);
//			    }
//			    if ($height == 0){
//			    	$height = $this->calculate('height', $width, $dimensions);
//			    }
//			
//				if ($width == $height) {
//					$size = $width;
//					if ($this->getWidth() < $this->getHeight()) {
//						$height = 0;
//					} else {
//						$width = 0;
//					}
//					$this->thumb->resize($width, $height);
//					$this->thumb->cropFromCenter($size);
//				} else {
//					$this->thumb->resize($width, $height);
//				}
//
//				$image = $this->thumb->save($fileName);
				//copy($tmpName, $fileName);
//				chmod($fileName, 0666);
				//unlink($tmpName);
//			}
			return $this->_cachePath.'/'.str_replace($this->_realPath, '', $fileName);
        }
    }
    
    public function getIdDir($id, $full = false, $orig = false)
    {
    	$dir = chunk_split($id, 1, '/');
    	$fulldir = $this->_realPath.'/'.$dir;

    	if (!file_exists($fulldir)) {
    		mkdir($fulldir, 0777, true);
    	}
    	
    	return ($full) ? $fulldir : $dir;
    }
    
    public function calculate($what, $from, $info = array(), $path = null){
    	$data = 0;
    	if (count($info) == 0) $info = array('width' => $this->getWidth(), 'height' => $this->getHeight());
    	switch ( $what ){
    		case 'width':
    			$data = round(($info['width'] / $info['height']) * $from);
    		  	break;
    		case 'height':
    			$data = round(($info['height'] / $info['width']) * $from);
    		  	break;
    	}
    	
    	if (isset($path)){
    	    $info = $this->identifyImage($path);
    	    $data = $info[$what];
    	}
    	
    	return $data;
    }
    
    public function upload($source, $name = ''){
        $info = $this->identifyImage($source);
    	$t = strtolower($info['format']);
    	switch ($t) {
    		case 'tiff':
    			$type = 'tif';
    			break;
    		
    		case 'jpeg':
    			$type = 'jpg';
    			break;
    		
    		default:
    			$type = $t;
    			break;
    	}
    
    	// create image in db
    	$data = array(
    		'width' => $info['width'],
    		'height' => $info['height'],
    		'ext' => $type,
    		'name' => $name,
    		'timestamp' => time(),
    		'id' => 0
    	);
    	$this->populate($data);
    	$this->save();

    	// move file
    	$old = $source;
    	$new = $this->generateOrigFilename();
    	
    	if (!move_uploaded_file($old, $new)){
            return json_encode(array('msg' => 'Permission denied', 'success' => false));
            exit;
        }
    	$thumb = $this->getPath(135, 135);
    	
    	return array("path" => $thumb, "id" => $this->getId());
    }
    
    public function findAllFiles(){
        $dir = $this->getIdDir($this->getId(), true);
        return glob($dir . $this->getId() . '-*');
    }
    
    public function delete(){
        $files = $this->findAllFiles();
        foreach ($files as $file){
            unlink($file);
        }
        $this->_delete();
        return true;
    }
}