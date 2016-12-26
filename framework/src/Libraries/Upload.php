<?php
namespace Framework\Libraries;

/**
 * @author aduartem
 */

class Upload
{

    /**
     * Upload a file
     *
     * @author aduartem
     * 
     * @param array $aFile $_FILES['nameInputFile']
     * @param array $aTypesAllowed Mime types allowed
     * @param string $uploadPath upload path (optional)
     * @param int $maxSize Maximum upload file size (optional)
     *
     * @return array Result of method
     */
    
    public static function doUpload($aFile, $aTypesAllowed, $uploadPath = NULL, $maxSize = NULL)
    {
        if( ! isset($aFile["name"]))
            return array('success' => FALSE, 'message' => '[ERROR] Request not valid.');

        $name       = $aFile["name"];
        $mimeType   = $aFile["type"];
        $tmpPath    = $aFile["tmp_name"];
        $size       = $aFile["size"];
        $imageSize  = getimagesize($tmpPath);
        $width      = $imageSize[0];
        $height     = $imageSize[1];
        $uploadPath = ( ! empty($uploadPath)) ? $uploadPath : FCPATH . "public/upload/";

        if(in_array($mimeType, $aTypesAllowed) === FALSE)
            return array('success' => FALSE, 'message' => '[ERROR] Type not valid.');

        $mb      = (1024*1024);
        $maxSize = ( ! empty($maxSize)) ? $mb * $maxSize : $mb * 20;

        if($size > $maxSize)
            return array('success' => FALSE, 'message' => '[ERROR] The maximum allowed size is '.$maxSize.' MB.');

        $fullPath = $uploadPath . $name;

        move_uploaded_file($tmpPath, $fullPath);

        if(file_exists($fullPath) === FALSE)
            return array('success' => FALSE, 'message' => '[ERROR] Permission denied');

        return array('success' => TRUE, 'message' => '');
    }
}