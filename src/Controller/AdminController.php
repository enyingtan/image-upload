<?php

namespace App\Controller;

use App\Entity\ImageFile;
use App\Form\ImageType;
use App\Service\UploadHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(EntityManagerInterface $em, Request $request, UploadHelper $uploaderHelper): Response
    {
        $image = new ImageFile();

        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();

            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadImage($uploadedFile);
                $originalFilename = $uploaderHelper->getOriginalFileName($uploadedFile);
                $image->setImageName($originalFilename);
                $image->setPathName($newFilename);

                // Save
                $em->persist($image);
                $em->flush();
            }

            $this->addFlash('success', 'Image uploaded!');
        }

        return $this->render('admin/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
