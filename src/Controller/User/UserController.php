<?php

namespace App\Controller\User;

use App\Controller\AbstractSimpleApiController;
use App\Entity\User\User;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;

/**
 * @Route ("/user", name="api_user")
 * @OA\Tag(name="User")
 */
class UserController extends AbstractSimpleApiController
{
    public const entityClass = User::class;
    public const serializationGroups = ['user_short'];
    public const serializationAttributes = ['id', 'username', 'email', 'createdAt', 'updatedAt'];

    /**
     * Get me
     *
     * @Route("/me", methods={"GET"}, name="_get_me", )
     *
     * @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *     @OA\Schema(ref=@Model(type=User::class, groups={}))
     * ),
     *
     * @OA\Response(response="401", ref="#/components/schemas/401"),
     * @OA\Response(response="403", ref="#/components/schemas/403"),
     * @OA\Response(response="415", ref="#/components/schemas/415"),
     * @OA\Response(response="422", ref="#/components/schemas/422")
     *
     * @return Response
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getMeAction(): Response
    {
        $serializer = $this->container->get('serializer');
        $data = $serializer->serialize($this->getUser(), 'json', ['attributes' => static::serializationAttributes]);

        return $this->renderResponse($data, Response::HTTP_OK);
    }

}
