<?php
// src/Controller/ConventionController.php

namespace App\Controller;

use App\Entity\Convention;
use App\Form\ConventionType;
use App\Repository\ConventionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ConventionController extends AbstractController
{
    #[Route('/conventions', name: 'app_convention_index')]
    public function index(Request $request, ConventionRepository $conventionRepository): Response
    {
        $search = $request->query->get('search');

        if ($search) {
            // Query builder to search based on title or description
            $conventions = $conventionRepository->createQueryBuilder('c')
                ->where('c.title LIKE :search OR c.description LIKE :search')
                ->setParameter('search', '%' . $search . '%')
                ->getQuery()
                ->getResult();
        } else {
            $conventions = $conventionRepository->findAll();
        }

        return $this->render('convention/index.html.twig', [
            'conventions' => $conventions,
        ]);
    }

    #[Route('/conventionsback', name: 'app_convention_indexback')]
    public function indexback(ConventionRepository $conventionRepository): Response
    {
        $conventions = $conventionRepository->findAll();

        return $this->render('convention/indexback.html.twig', [
            'conventions' => $conventions,
        ]);
    }

    #[Route('/conventions/new', name: 'app_convention_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $convention = new Convention();
        $form = $this->createForm(ConventionType::class, $convention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pdfFile = $form->get('pdfFile')->getData();
            if ($pdfFile) {
                $originalFilename = pathinfo($pdfFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$pdfFile->guessExtension();

                try {
                    $pdfFile->move(
                        $this->getParameter('pdf_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // Handle exception if something happens during file upload
                }

                $convention->setPdfFile($newFilename);
            }

            $entityManager->persist($convention);
            $entityManager->flush();

            return $this->redirectToRoute('app_convention_indexback');
        }

        return $this->render('convention/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit/{idc}', name: 'convention_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Convention $convention, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ConventionType::class, $convention);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_convention_indexback');
        }

        return $this->render('convention/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete/{idc}', name: 'convention_delete', methods: ['POST'])]
    public function delete(Request $request, Convention $convention, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$convention->getIdc(), $request->request->get('_token'))) {
            $entityManager->remove($convention);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_convention_indexback');
    }
   
}
