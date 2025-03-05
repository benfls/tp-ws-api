<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

/**
 * @Route("/author", name="author")
 * @OA\Tag(name="Authors")
 */
class AuthorControler extends AbstractSimpleApiController
{
    public const entityClass = Author::class;
    public const entityCreateTypeClass = AuthorType::class;
    public const entityUpdateTypeClass = AuthorType::class;

    /**
     * @Route(methods={"POST"}, name="_create")
     *
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(ref=@Model(type=self::entityCreateTypeClass))
     * ),
     * @OA\Response(response=200, description="Successful operation"),
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
     * @Route("/{id}", methods={"GET"}, requirements={"id"="\d+"}, name="_get")
     *
     * @OA\Response(response=200, description="Successful operation"),
     * @OA\Response(response="404", description="Entity not found"),
     */
    public function read(Request $request): Response
    {
        $entity = $this->getEntityOfRequest($request);
        return static::renderEntityResponse($entity, static::serializationGroups, [], Response::HTTP_OK, []);
    }

    /**
     * @Route("", methods={"GET"}, name="_getAll")
     *
     * @OA\Response(response=200, description="Successful operation"),
     */
    public function getAll()
    {
        $entities = $this->getRepository(self::entityClass)->findAll();
        return static::renderEntityResponse($entities, static::serializationGroups, [], Response::HTTP_OK, []);
    }

    /**
     * @Route("/{id}", methods={"DELETE"}, requirements={"id"="\d+"}, name="_delete")
     *
     * @OA\Response(response=204, description="Successful operation")
     * @OA\Response(response=404, description="Entity not found")
     */
    public function delete(Request $request): Response
    {
        $entity = $this->getEntityOfRequest($request);
        $this->removeAndFlush($entity);
        return static::renderResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/{id}", methods={"PUT"}, requirements={"id"="\d+"}, name="_update")
     *
     * @OA\RequestBody(required=true, @OA\JsonContent(ref=@Model(type=self::entityUpdateTypeClass))),
     * @OA\Response(response=200, description="Successful operation"),
     * @OA\Response(response=404, description="Entity not found"),
     */
    public function update(Request $request): Response
    {
        $entity = $this->getEntityOfRequest($request);
        $form = $this->createForm(static::entityUpdateTypeClass, $entity);
        $form->submit($request->request->all(), false);

        if ($form->isValid()) {
            $entity = $this->persistAndFlush($entity);
            return static::renderEntityResponse($entity, static::serializationGroups, [], Response::HTTP_OK);
        }

        $this->throwUnprocessableEntity($form);
    }
}
