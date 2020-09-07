<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\MGlobal;
use App\Entity\MPrivate;
use App\Form\PrivateMessageType;
use App\Repository\MPrivateRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PrivateMessageController extends AbstractController
{
    /**
     * @Route("/Privatemessage/{receiver_id}", name="private_message")
     */
    public function index(UserInterface $user, $receiver_id,  Request $request)
    {
        //User logged or not
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        //Create Mprivate object
        $message = new MPrivate();
        $message->setUserId($user);
        $message->setReceiverId($receiver_id);
        
        //PrivateMessage From
        $form = $this->createForm(PrivateMessageType::class, $message);
        $form->handleRequest($request);
   
        if ($form->isSubmitted() && $form->isValid()) {
        
        $task = $form->getData();
        
        //Create data in database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($task);
        $entityManager->flush();
    }
        //Find UserMessage in the database
        $repository = $this->getDoctrine()->getRepository(MPrivate::class);
        $userMessage = $repository->findBy([
            'userId'=> $user,
            'receiverId' => $receiver_id
        ]);

        //Create user object for find ReceiverMessage
        $repository = $this->getDoctrine()->getRepository(User::class);
        $userId = $repository->find($receiver_id);
        
        //Find ReceiverMessage in the database
        $repository = $this->getDoctrine()->getRepository(MPrivate::class);
        $receiverMessage = $repository->findBy([
            'userId'=> $userId,
            'receiverId' => $user->getId()
        ]);
        
        //Merge UserMessage, ReceiverMessage and sort that by id Desc 
        $messages = array_merge($userMessage, $receiverMessage);
        array_multisort($messages, SORT_DESC);
        
        return $this->render('private_message/index.html.twig', [
            'controller_name' => 'PrivateMessageController',
            'messages' =>  $messages,
            'form' => $form->createView()
        ]);
    }
}
