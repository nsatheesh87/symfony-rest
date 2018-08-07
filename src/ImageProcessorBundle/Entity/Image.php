<?php

namespace ImageProcessorBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;


class Image
{
    private $uploadedImage;

    public function getUploadedimage()
    {
        return $this->uploadedImage;
    }

    public function setUploadedimage(File $uploadedImage = null)
    {
        $this->uploadedImage = $uploadedImage;
    }

}