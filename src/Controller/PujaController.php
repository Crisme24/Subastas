<?php

namespace App\Controller;

use App\Entity\Puja;
use App\Entity\User;
use App\Entity\Subasta;
use App\Form\PujaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PujaController extends AbstractController
{
    /**
     * @Route("/puja", name="puja")
     */
    public function index(): Response
    {
        return $this->render('puja/index.html.twig', [
            'controller_name' => 'PujaController',
        ]);
    }

    /**
     * @Route("/ver-pujas", name="verPujas")
     */
    public function showAll(): Response
    {
        $puja_repo = $this->getDoctrine()->getRepository(Puja::class);
        $pujas = $puja_repo->findBy([], ['id' => 'DESC']);
        
        return $this->render('puja/verPujas.html.twig', [
            'pujas' => $pujas,
             
        ]);
    }

    /**
     * @Route("/ver-puja/{id}", name="verPuja")
     */
    public function showOne(Puja $puja): Response
    {
        if(!$puja){
            return $this->redirectToRoute('verPujas');
        }

        return $this->render('puja/detallePuja.html.twig', [
            'puja' => $puja,
        ]);
    }

    /**
     * @Route("/crear-puja", name="crearPuja")
     */
    public function create(Request $request): Response
    {
       
        $puja = new Puja();

        $form = $this->createForm(PujaType::class, $puja);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
                $em = $this->getDoctrine()->getManager();
			    $em->persist($puja);
                $em->flush();
            
                return $this->redirectToRoute('home');
            }
        
        return $this->render('puja/crearPuja.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
