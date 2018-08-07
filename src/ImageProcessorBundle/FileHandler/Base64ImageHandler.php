<?php
namespace ImageProcessorBundle\FileHandler;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * Class Base64ImageHandler
 * @package ImageProcessorBundle\FileHandler
 */
class Base64ImageHandler extends UploadedFile
{
    /**
     * Base64ImageHandler constructor.
     * @param string $base64Content
     */
   public function __construct($base64Content)
   {
      $filePath = tempnam(sys_get_temp_dir(), 'UploadedFile');

      list(, $data) = explode(',', $base64Content);
      $data = base64_decode($data);
      file_put_contents($filePath, $data);
      $mimeType = null;
      $size = null;
      $error = null;

      $test = true;
      parent::__construct($filePath, 'imageUploaded', $mimeType, $size, $error, $test);
   }
}
