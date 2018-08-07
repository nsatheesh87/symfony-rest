<?php
namespace ImageProcessorBundle\FileHandler;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class Base64ImageHandler extends UploadedFile
{
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

    public function test($base64Content)
    {
        $isValid = $this->validateBase64Image($base64Content);

        if($isValid) {

            $filePath = tempnam(sys_get_temp_dir(), 'UploadedFile');
            $filePath = $filePath.'.png';
            $file = fopen($filePath, "w");
            stream_filter_append($file, 'convert.base64-decode');
            fwrite($file, $base64Content);
            $meta_data = stream_get_meta_data($file);
            $path = $meta_data['uri'];
            fclose($file);
            parent::__construct($path, true);
        }

        return false;
    }

    public function validateBase64Image($base64Content)
    {
        $explode = explode(',', $base64Content);
        $allow = ['png'];
        $format = str_replace(
            [
                'data:image/',
                ';',
                'base64',
            ],
            [
                '', '', '',
            ],
            $explode[0]
        );
        // check file format
        if (!in_array($format, $allow)) {
           // throw new UnexpectedTypeException("Invalid base64 format",'png');
            throw new \InvalidArgumentException('PNG format only allowed.');
        }
        // check base64 format
        if (!preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $explode[1])) {
            throw new \InvalidArgumentException('Invalid base64 content');
        }

        if ($this->getBase64ImageSize($base64Content) > 5) {
            throw new \InvalidArgumentException('File size is too large');
        }


        return true;
    }


    public function getBase64ImageSize($base64Image){ //return memory size in B, KB, MB
            $size_in_bytes = (int) (strlen(rtrim($base64Image, '=')) * 3 / 4);
            $size_in_kb    = $size_in_bytes / 1024;
            $size_in_mb    = $size_in_kb / 1024;
            return $size_in_mb;
    }
}
