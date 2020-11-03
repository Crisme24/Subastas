<?php

namespace App\Controller;

use App\Entity\Subasta;
use App\Form\SubastaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class SubastaController extends AbstractController
{
    /**
     * @Route("/", name="subasta")
     */
    public function index(): Response
    {
        return $this->render('subasta/index.html.twig', [
            'controller_name' => 'SubastaController',
        ]);
    }

    /**
     * @Route("/crear-subasta", name="crearSubasta")
     */
    public function create(Request $request): Response
    {
       
        $subasta = new Subasta();

        $form = $this->createForm(SubastaType::class, $subasta);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $File = $form['image']->getData();
            if ($File) {
                $originalFilename = pathinfo($File->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$File->guessExtension();
                try {
                    $File->move(
                        $this->getParameter('photos_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                   throw new \Exception('UPs! ha ocurrido un error, lo sentimos :c');
                }

                $subasta->setImage($newFilename);
            }
            $user = $this->getUser();
            $user->getRole();
            if($user->getRole() == 'ROLE_ADMIN'){
                $subasta->setUser($user);
                $em = $this->getDoctrine()->getManager();
			    $em->persist($subasta);
                $em->flush();
            
                return $this->redirectToRoute('home');
            }
        }
        
        return $this->render('subasta/crear.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/ver-subasta", name="verSubastas")
     */
    public function showAll(): Response
    {
        $subastas_repo = $this->getDoctrine()->getRepository(Subasta::class);
        $subastas = $subastas_repo->findBy([], ['id' => 'DESC']);

        return $this->render('subasta/verSubasta.html.twig', [
            'subastas' => $subastas,
            // 'activo' => $subastas_activa
        ]);
    }

    /**
     * @Route("/ver-subasta/{id}", name="verSubasta")
     */
    public function showOne(Subasta $subasta): Response
    {
        if(!$subasta){
            return $this->redirectToRoute('verSubastas');
        }

        return $this->render('subasta/detalleSubasta.html.twig', [
            'subasta' => $subasta,
        ]);
    }

    /**
     * @Route("/editar-subasta/{id}", name="editarSubasta")
     */
    public function edit(Request $request, UserInterface $user, Subasta $subasta): Response
    {
        // if($user->getRoles != "ROLE_ADMIN"){
        //     return $this->redirectToRoute('home');
        // }
        $form = $this->createForm(SubastaType::class, $subasta);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $File = $form['image']->getData();
            if ($File) {
                $originalFilename = pathinfo($File->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$File->guessExtension();
                try {
                    $File->move(
                        $this->getParameter('photos_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                   throw new \Exception('UPs! ha ocurrido un error, lo sentimos :c');
                }

                $subasta->setImage($newFilename);
            }
            $user = $this->getUser();
            $subasta->setUser($user);
            $em = $this->getDoctrine()->getManager();
			$em->persist($subasta);
            $em->flush();

            return $this->redirect($this->generateUrl('editarSubasta', ['id' => $subasta->getId()]));
        }
        return $this->render('subasta/crear.html.twig', [
            'edit' => true,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/borrar-subasta/{id}", name="borrarSubasta")
     */
    public function delete(UserInterface $user, Subasta $subasta){
        // if($user->getRoles != "ROLE_ADMIN"){
        //     return $this->redirectToRoute('home');
        // }
		
		if(!$subasta){
			return $this->redirectToRoute('home');
		}
		
		$em = $this->getDoctrine()->getManager();
		$em->remove($subasta);
		$em->flush();
		
		return $this->redirectToRoute('home');
	}
}
