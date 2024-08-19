<?php

namespace App\Controller;
use App\Entity\Evenement;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExampleController extends AbstractController
{
     
    #[Route('/baseBack', name: 'baseBack')]
     
    public function index(EvenementRepository $evenementRepository): Response
    {
       
        $evenements = $evenementRepository->findAll();

        return $this->render('accueilback.html.twig', [
            'evenements' => $evenements,
        ]);
    }
    #[Route('/base', name: 'base')]
     
    public function index1(): Response
    {
        // Passer une variable à la vue
        $ma_variable = 'Ceci est une variable';

        return $this->render('accueil.html.twig', [
            'ma_variable' => $ma_variable,
        ]);
    }

    #[Route('/bureau', name: 'bureau')]
     
    public function bureau(): Response
    {
        // Passer une variable à la vue
        $ma_variable = 'Ceci est une variable';

        return $this->render('bureau.html.twig', [
            'ma_variable' => $ma_variable,
        ]);
    }

    
    
}