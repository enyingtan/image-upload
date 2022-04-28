<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\ImageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(Request $request): Response
    {
        $image = new Image();

        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();
            $destination = $this->getParameter('kernel.project_dir').'/public/uploads';

            $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
            $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();
            // $newFilename = Urlizer ::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();
            // $uploadedFile->move(
            //     $destination,
            //     $newFilename
            // );

            // // Save
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($image);
            // $em->flush();

            dd($newFilename);

            $this->addFlash('success', 'Image uploaded!');
        }

        return $this->render('admin/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
