<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gedmo\Sluggable\Util\Urlizer;


class UploadHelper
{
    public function uploadImage(UploadedFile $uploadedFile): string
    {
        // $destination = $this->getParameter('kernel.project_dir').'/public/uploads/article_image';
        // $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        // $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();
        // $uploadedFile->move(
        //     $destination,
        //     $newFilename
        // );

        return '';
    }
}