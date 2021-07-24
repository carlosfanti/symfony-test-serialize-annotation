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
use App\DTO\UserDTO;

class DTOSerializeController extends AbstractController
{
    private $serializer;

    public function __construct()
    {
        $this->serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
    }

    private function getUserDTO()
    {
        return new UserDTO("email@testing.com", "strongPassword!!!");
    }

    /**
     * @Route("/dto/normalize", name="dto_test_normalize")
     */
    public function testNormalize(): JsonResponse
    {
        $userDTO = $this->getUserDTO();
        return new JsonResponse($this->serializer->normalize($userDTO), 200);
    }

    /**
     * @Route("/dto/normalize/grouped", name="dto_test_normalize_grouped")
     */
    public function testNormalizeGrouped(): JsonResponse
    {
        $userDTO = $this->getUserDTO();
        return new JsonResponse($this->serializer->normalize($userDTO, null, ['groups' => 'group1']), 200);
    }

    /**
     * @Route("/dto/serialize", name="dto_test_serialize")
     */
    public function testSerialize(): Response
    {
        $userDTO = $this->getUserDTO();
        return new Response($this->serializer->serialize($userDTO, 'json'), 200);
    }

    /**
     * @Route("/dto/serialize/grouped", name="dto_test_serialize_grouped")
     */
    public function testSerializeGrouped(): Response
    {
        $userDTO = $this->getUserDTO();
        return new Response($this->serializer->serialize($userDTO, 'json', [], ['groups' => 'group1']), 200);
    }

    /**
     * @Route("/dto/serialize/context", name="dto_test_serialize_context")
     */
    public function testSerializeContext(): Response
    {
        $userDTO = $this->getUserDTO();
        return new Response($this->serializer->serialize($userDTO, 'json', [AbstractNormalizer::IGNORED_ATTRIBUTES => ['password']]), 200);
    }
}
