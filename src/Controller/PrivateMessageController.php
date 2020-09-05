<?php

namespace App\Controller;

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
     * @Route("/Privatemessage/{destinate_id}", name="private_message")
     */
    public function index(UserInterface $user, $destinate_id,  Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $message = new MPrivate();
        $message->setUserId($user);
        
        $form = $this->createForm(PrivateMessageType::class, $message);
        
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
        $repository = $this->getDoctrine()->getRepository(MPrivate::class);
        $mPrivate = $repository->findBy([
            'userId'=> $user,
            'receiverId' => 1
        ]);

        $mReceiver = $repository->findBy([
            'userId'=> $user,
            'receiverId' => 3
        ]);

        $mPrivateGeneral = array_merge($mPrivate, $mReceiver);

        return $this->render('private_message/index.html.twig', [
            'controller_name' => 'PrivateMessageController',
            'destinate_id' => $destinate_id,
            'mPrivate' =>  $mPrivateGeneral,
        ]);
    }
}
