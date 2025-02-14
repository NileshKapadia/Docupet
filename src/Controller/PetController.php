<?php

namespace App\Controller;

use App\Entity\Pet;
use App\Form\PetType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PetController extends AbstractController
{
    #[Route('/', name: 'pet_register')]
    public function register(): Response
    {
        $pet = new Pet();
        $form = $this->createForm(PetType::class, $pet);
    
        return $this->render('pet/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/pet/{id}', name: 'pet_show')]
    public function show(Pet $pet): Response
    {
        return $this->render('pet/show.html.twig', [
            'pet' => $pet,
        ]);
    }
}
