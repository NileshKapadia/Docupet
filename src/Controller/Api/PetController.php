<?php

namespace App\Controller\Api;
use App\Entity\Pet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/pet')]
class PetController extends AbstractController
{
    #[Route('/create', name: 'api_pet_create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if (!$data) {
            return new JsonResponse(['error' => 'Invalid JSON']);
        }

        $pet = new Pet();
        $pet->setName($data['name']);
        $pet->setType($data['type']);
        $pet->setBreed($data['breed']);
        $pet->setGender($data['gender']);
        $pet->setIsDangerous($data['isDangerous']);
        if (!empty($data['dateOfBirth'])) {
            $pet->setDateOfBirth(new \DateTime($data['dateOfBirth']));
            $pet->setApproximateAge(null);
        } else {
            $pet->setDateOfBirth(null);
            $pet->setApproximateAge($data['approximateAge']);
        }
        $entityManager->persist($pet);
        $entityManager->flush();

        return new JsonResponse([
            'status' => '201',
            'id' => $pet->getId()
        ]);
    }
}
