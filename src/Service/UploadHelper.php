<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gedmo\Sluggable\Util\Urlizer;


class UploadHelper
{
    private $uploadsPath;

    const IMAGE_PATH = 'images';

    public function __construct(string $uploadsPath)
    {
        $this->uploadsPath = $uploadsPath;
    }

    public function uploadImage(UploadedFile $uploadedFile): string
    {
        $destination = $this->uploadsPath.'/'.self::IMAGE_PATH;

        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();
        $uploadedFile->move(
            $destination,
            $newFilename
        );

        return $newFilename;
    }

    public function getOriginalFileName(UploadedFile $uploadedFile): string
    {

        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);

        return $originalFilename;
    }

    public function getPublicPath(string $path): string
    {
        return 'uploads/'.$path;
    }
}