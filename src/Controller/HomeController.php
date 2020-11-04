<?php

namespace App\Controller;

use App\Entity\Puja;
use App\Entity\Subasta;
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
       
        foreach ($subastas as $subasta) {
            $pujas = $subasta->getPujas()->toArray();
            $subasta->maxPuja = max(array_map(function($puja) {
                return $puja->getPrice();
             },
             $pujas));
        }
        
        return $this->render('home/index.html.twig', [
            'subastas' => $subastas,
        ]);
    }
    
}
