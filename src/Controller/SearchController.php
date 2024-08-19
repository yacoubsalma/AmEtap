<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ConventionRepository ;
use App\Entity\Convention;

class SearchController extends AbstractController
{
    
    #[Route('/search', name: 'app_search')]
    public function searchUser(Request $request, ConventionRepository $repository): Response
    {
        $query = $request->request->get('query');
        $conventions = $repository->searchByNom($query);
        return $this->render('convention/index.html.twig', [
            'conventions' => $conventions
        ]);
    }

    
}
