<?php

namespace App\Controller;

use App\Repository\ImageFileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function index(Request $request, ImageFileRepository $repository)
    {
        $q = $request->query->get('q');
        $images = $repository->searchByFullTextColumn($q);


        return $this->render('list/index.html.twig', [
            'images' => $images,
        ]);
    }
}
