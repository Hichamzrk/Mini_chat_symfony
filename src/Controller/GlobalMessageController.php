<?php

namespace App\Controller;

use App\Entity\Aime;
use App\Entity\MGlobal;
use App\Form\GeneralMessageType;
use App\Repository\MGlobalRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GlobalMessageController extends AbstractController
{
    /**
     * @Route("/Minichat", name="global_message")
     */
    public function index(UserInterface $user, Request $request)
    {
        //User logged or not 
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        //Set userId
        $message = new MGlobal();
        $message->setUserId($user);
        
        //GeneralMessage Form 
        $form = $this->createForm(GeneralMessageType::class, $message);
        $form->handleRequest($request);
   
        if ($form->isSubmitted() && $form->isValid()) {

        $task = $form->getData();
        
        //Create data in database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($task);
        $entityManager->flush();
    }
        //Find All GlobalMessage
        $repository = $this->getDoctrine()->getRepository(MGlobal::class);
        $messages = $repository->findAll();
        
        return $this->render('global_message/index.html.twig', [
            'controller_name' => 'GlobalMessageController',
            'form' => $form->createView(),
            'messages' => $messages
        ]);
    }

    /**
      * @Route("/Minichat/Aime/{message}", name="Aime")
      */
    public function Aime(UserInterface $user, ?MGlobal $message)
    {
        //Find Aime in database
        $repository = $this->getDoctrine()->getRepository(Aime::class);
        $messages = $repository->findOneBy([
            'userId' => $user,
            'mGlobal' => $message
        ]);
        
        //Verify if User like the message reditect in minichat and don't like the message
        if ($messages !== null) {
            return $this->redirectToRoute('global_message');
            die();
        }

        //Create Aime object
        $aime = new Aime();
        $aime->setUserId($user);
        $aime->setMessageIdId($message);
        $aime->setMGlobal($message);

        //Create data in database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($aime);
        $entityManager->flush();

        return $this->redirectToRoute('global_message');
    }
    
}
