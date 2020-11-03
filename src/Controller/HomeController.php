<?php

namespace App\Controller;

use App\Entity\Subasta;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {

        $subastas_repo = $this->getDoctrine()->getRepository(Subasta::class);
        $subastas = $subastas_repo->findBy(['status' => 'activo']);
        
        return $this->render('home/index.html.twig', [
            'subastas' => $subastas,
        ]);
    }
}
