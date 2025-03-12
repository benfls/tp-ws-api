<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\User;
use App\Form\MessageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/message", name="message")
 * @OA\Tag(name="Messages")
 */
class MessageController extends AbstractController
{
    /**
     * @Route("", methods={"POST"}, name="_create")
     */
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em->persist($message);
            $em->flush();

            if ($message->getType() === 'text') {
                // Appeler un LLM (ChatGPT, etc.)
                $response = "Réponse du chatbot : " . strtoupper($message->getContent());
            } else {
                // Appeler un générateur d'image (DALL·E, etc.)
                $response = "Lien de l'image générée pour : " . $message->getContent();
            }

            return $this->json([
                'message' => $message->getContent(),
                'response' => $response,
            ], Response::HTTP_CREATED);
        }

        return $this->json(['error' => 'Invalid data'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("", methods={"GET"}, name="_getAll")
     */
    public function getAll(EntityManagerInterface $em): Response
    {
        $messages = $em->getRepository(Message::class)->findBy(['user' => $this->getUser()]);
        return $this->json($messages, Response::HTTP_OK, [], ['groups' => 'message_read']);
    }
}
