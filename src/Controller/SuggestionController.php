<?php
namespace App\Controller;

use App\Entity\Suggestion;
use App\Form\SuggestionType;
use App\Repository\SuggestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/suggestion')]
class SuggestionController extends AbstractController
{
    #[Route('/', name: 'app_suggestion_index', methods: ['GET', 'POST'])]
    public function index(Request $request, SuggestionRepository $suggestionRepository, EntityManagerInterface $entityManager): Response
    {
        $suggestion = new Suggestion();
        $form = $this->createForm(SuggestionType::class, $suggestion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($suggestion);
            $entityManager->flush();

            return $this->redirectToRoute('app_suggestion_index');
        }

        $suggestions = $suggestionRepository->findAll();

        return $this->render('suggestion/index.html.twig', [
            'form' => $form->createView(),
            'suggestions' => $suggestions,
        ]);
    }

    #[Route('/back', name: 'app_suggestion_indexBack', methods: ['GET', 'POST'])]
    public function indexBack(Request $request, SuggestionRepository $suggestionRepository, EntityManagerInterface $entityManager): Response
    {
        $suggestion = new Suggestion();
        $form = $this->createForm(SuggestionType::class, $suggestion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($suggestion);
            $entityManager->flush();

            return $this->redirectToRoute('app_suggestion_indexBack');
        }

        $suggestions = $suggestionRepository->findAll();

        return $this->render('suggestion/indexBack.html.twig', [
            'form' => $form->createView(),
            'suggestions' => $suggestions,
        ]);
    }

    #[Route('/{ids}', name: 'app_suggestion_show', methods: ['GET'])]
    public function show(Suggestion $suggestion): Response
    {
        return $this->render('suggestion/show.html.twig', [
            'suggestion' => $suggestion,
        ]);
    }

    #[Route('/{ids}/edit', name: 'app_suggestion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Suggestion $suggestion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SuggestionType::class, $suggestion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_suggestion_index');
        }

        return $this->render('suggestion/edit.html.twig', [
            'suggestion' => $suggestion,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{ids}', name: 'app_suggestion_delete', methods: ['POST'])]
    public function delete(Request $request, Suggestion $suggestion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$suggestion->getIds(), $request->request->get('_token'))) {
            $entityManager->remove($suggestion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_suggestion_index');
    }
}
