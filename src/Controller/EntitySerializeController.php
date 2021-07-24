<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use App\Entity\User;

class EntitySerializeController extends AbstractController
{
    private $serializer;

    public function __construct()
    {
        $this->serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
    }

    private function getUserEntity()
    {
        $user = new User();
        $user->setEmail("email@testing.com")
            ->setPassword("strongPassword!!!");

        return $user;
    }

    /**
     * @Route("/entity/normalize", name="entity_test_normalize")
     */
    public function testNormalize(): JsonResponse
    {
        $userEntity = $this->getUserEntity();
        return new JsonResponse($this->serializer->normalize($userEntity), 200);
    }

    /**
     * @Route("/entity/normalize/grouped", name="entity_test_normalize_grouped")
     */
    public function testNormalizeGrouped(): JsonResponse
    {
        $userEntity = $this->getUserEntity();
        return new JsonResponse($this->serializer->normalize($userEntity, null, ['groups' => 'group1']), 200);
    }

    /**
     * @Route("/entity/serialize", name="entity_test_serialize")
     */
    public function testSerialize(): Response
    {
        $userEntity = $this->getUserEntity();
        return new Response($this->serializer->serialize($userEntity, 'json'), 200);
    }

    /**
     * @Route("/entity/serialize/grouped", name="entity_test_serialize_grouped")
     */
    public function testSerializeGrouped(): Response
    {
        $userEntity = $this->getUserEntity();
        return new Response($this->serializer->serialize($userEntity, 'json', [], ['groups' => 'group1']), 200);
    }

    /**
     * @Route("/entity/serialize/context", name="entity_test_serialize_context")
     */
    public function testSerializeContext(): Response
    {
        $userEntity = $this->getUserEntity();
        return new Response($this->serializer->serialize($userEntity, 'json', [AbstractNormalizer::IGNORED_ATTRIBUTES => ['password']]), 200);
    }
}
