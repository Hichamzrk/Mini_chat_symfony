<?php

namespace App\Controller;

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
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $message = new MGlobal();
        $message->setUserId($user);
        $form = $this->createForm(GeneralMessageType::class, $message);
        
        $form->handleRequest($request);
   
        if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $task = $form->getData();

        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
         $entityManager = $this->getDoctrine()->getManager();
         $entityManager->persist($task);
         $entityManager->flush();
    }

        $repository = $this->getDoctrine()->getRepository(MGlobal::class);
        $messages = $repository->findAll();
        
        return $this->render('global_message/index.html.twig', [
            'controller_name' => 'GlobalMessageController',
            'form' => $form->createView(),
            'messages' => $messages
        ]);
    }
}
