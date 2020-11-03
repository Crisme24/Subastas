<?php

namespace App\Controller;

use App\Entity\Puja;
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
        $puja_repo = $this->getDoctrine()->getRepository(Puja::class);
        $pujas = $puja_repo->findBy([], ['price' => 'DESC']);
        return $this->render('home/index.html.twig', [
            'subastas' => $subastas,
            'pujas' => $pujas[0]
        ]);
    }
}
