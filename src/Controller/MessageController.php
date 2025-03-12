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
class MessageController extends AbstractSimpleApiController
{
    public const entityClass = Message::class;
    public const entityCreateTypeClass = MessageType::class;

    /**
     * @Route("", methods={"POST"}, name="_create")
     *
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(ref=@Model(type=self::entityCreateTypeClass))
     * ),
     * @OA\Response(response=201, description="Message created successfully"),
     * @OA\Response(response=400, description="Invalid data"),
     */
    public function create(Request $request): Response
    {
        $form = $this->createForm(static::entityCreateTypeClass);
        $form->submit($request->request->all());
        if ($form->isValid()) {
            $entity = $this->persistAndFlush($form->getData());
            return static::renderEntityResponse($entity, static::serializationGroups, [], Response::HTTP_CREATED);
        }
        $this->throwUnprocessableEntity($form);
    }

    /**
     * @Route("", methods={"GET"}, name="_getAll")
     *
     * @OA\Response(response=200, description="Successful operation"),
     */
    public function getAll()
    {
        // on demande à Doctrine toutes les entités de la classe
        $entities = $this->getRepository(self::entityClass)->findAll();
        // on les retourne sérialisées en json
        return static::renderEntityResponse($entities, static::serializationGroups, [], Response::HTTP_OK, []);
    }
}
