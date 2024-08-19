<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Form\MembreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/membre')]
class MembreController extends AbstractController
{
    #[Route('/', name: 'app_membre_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $membres = $entityManager->getRepository(Membre::class)->findAll();

        return $this->render('membre/index.html.twig', [
            'membres' => $membres,
        ]);

    } #[Route('/back', name: 'app_membre_indexback', methods: ['GET'])]
    public function indexback(EntityManagerInterface $entityManager): Response
    {
        $membres = $entityManager->getRepository(Membre::class)->findAll();

        return $this->render('membre/indexback.html.twig', [
            'membres' => $membres,
        ]);
    }

    #[Route('/new', name: 'app_membre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $membre = new Membre();
        $form = $this->createForm(MembreType::class, $membre);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = uniqid() . '.' . $imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // Handle exception
                }

                $membre->setImage($newFilename);
            }

            $entityManager->persist($membre);
            $entityManager->flush();

            return $this->redirectToRoute('app_membre_indexback');
        }

        return $this->render('membre/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_membre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Membre $membre, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MembreType::class, $membre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_membre_indexback');
        }

        return $this->render('membre/edit.html.twig', [
            'form' => $form->createView(),
            'membre' => $membre,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_membre_delete', methods: ['POST'])]
    public function delete(Request $request, Membre $membre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$membre->getIdm(), $request->request->get('_token'))) {
            $entityManager->remove($membre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_membre_index');
    }
}
