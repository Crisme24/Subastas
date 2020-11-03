<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


use App\Form\RegisterType;
use App\Entity\User;

class UserController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
			$user->setRole('ROLE_USER');
			$user->setCreatedAt(new \Datetime('now'));
			

			$encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);

			$em = $this->getDoctrine()->getManager();
			$em->persist($user);
			$em->flush();
			
			return $this->redirectToRoute('app_login');
		}

        return $this->render('user/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $autenticationUtils){
		$error = $autenticationUtils->getLastAuthenticationError();
		
        $lastUsername = $autenticationUtils->getLastUsername();

		
		return $this->render('user/login.html.twig', array(
			'error' => $error,
			'last_username' => $lastUsername
        ));
        
    }
    
    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
