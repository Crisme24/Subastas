<?php

namespace App\Controller;

use App\Entity\Puja;
use App\Entity\Subasta;
use App\Form\PujaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

use function PHPSTORM_META\type;

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
        $user = $this->getUser();
        $userId = $user->getId();
        $pujas=[];
        if($user->getRole() === 'ROLE_ADMIN'){
            $pujas = $puja_repo->findBy([], ['id' => 'DESC']);
        }else{
            $pujas = $puja_repo->findBy(['user_id'=>$userId ], ['id' => 'DESC']);
        }

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

        $subastaId = (int)$request->query->get('id');

        $pujas = new Puja();

        $form = $this->createForm(PujaType::class, $pujas);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $subasta_repo = $this->getDoctrine()->getRepository(Subasta::class);
                $subasta = $subasta_repo->findOneBy([
                    'id' => $subastaId
                ]);

            $pujas->setCreateAt(new \DateTime('now'));
            $user = $this->getUser();
            $pujas->setUser($user);
            $pujas->setSubasta($subasta);

            $em = $this->getDoctrine()->getManager();

			$em->persist($pujas);
            $em->flush();

            return $this->redirectToRoute('home');
        }


        return $this->render('puja/crearPuja.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/editar-puja/{id}", name="editarPuja")
     */
    public function edit(Request $request, UserInterface $user, Puja $puja): Response
    {

        $form = $this->createForm(PujaType::class, $puja);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = $this->getUser();
            $puja->setUser($user);
            $em = $this->getDoctrine()->getManager();
			$em->persist($puja);
            $em->flush();

            return $this->redirectToRoute('verPujas');
        }
        return $this->render('puja/crearPuja.html.twig', [
            'edit' => true,
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/borrar-puja/{id}", name="borrarPuja")
     */
    public function delete(Puja $puja)
    {
		if(!$puja){
			return $this->redirectToRoute('verPujas');
		}

		$em = $this->getDoctrine()->getManager();
		$em->remove($puja);
		$em->flush();

		return $this->redirectToRoute('verPujas');
	}

}
