<?php
// src/Controller/CustomFormController.php

namespace App\Controller;

use App\Entity\CustomForm;
use App\Entity\Reservation;
use App\Entity\Evenement;
use App\Form\CustomFormType;
use App\Form\CustomFormTypeAFF;

use App\Form\SubmitType;
use App\Repository\CustomFormRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CustomFormController extends AbstractController
{
    #[Route('/evenement/{id}/create-custom-form', name: 'app_custom_form_create')]
    public function createCustomForm(Request $request, EntityManagerInterface $em, int $id): Response
    {
        $evenement = $em->getRepository(Evenement::class)->find($id);

        if (!$evenement) {
            throw new NotFoundHttpException(sprintf('Événement avec l\'ID %d non trouvé.', $id));
        }

        $customForm = new CustomForm();
        $customForm->setEvenement($evenement);

        $form = $this->createForm(CustomFormType::class, $customForm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $customForm = $form->getData();

            $em->persist($customForm);
            $em->flush();

            return $this->redirectToRoute('app_evenement_show', ['ide' => $id]);

        }

        return $this->render('custom_form/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/reservation/{id}/custom-form', name: 'app_custom_form_Aff')]
    public function createCustomFormaff(Request $request, EntityManagerInterface $em, CustomFormRepository $customFormRepository, int $id): Response
    {
        $reservation = $em->getRepository(Reservation::class)->find($id);
    
        if (!$reservation) {
            throw new NotFoundHttpException(sprintf('Réservation avec l\'ID %d non trouvée.', $id));
        }
    
        $evenement = $reservation->getEvenement();
        
        if (!$evenement) {
            throw new NotFoundHttpException('Événement associé à la réservation non trouvé.');
        }
    
        $customForms = $customFormRepository->findBy(['evenement' => $evenement]);
    
        if (empty($customForms)) {
            throw new NotFoundHttpException('Aucun formulaire personnalisé trouvé pour cet événement.');
        }
    
        $form = $this->createForm(CustomFormTypeAFF::class, null, ['custom_forms' => $customForms]);
        $form->handleRequest($request);
        dump($form->getData());
        if ($form->isSubmitted() && $form->isValid()) {
            $customData = $form->getData();
    
            $customDataArray = [];
            foreach ($customForms as $customForm) {
                $fieldLabel = $customForm->getFieldLabel();
                $customDataArray[$fieldLabel] = $customData[$fieldLabel] ?? null;
            }
    
            $reservation->setCustomData($customDataArray);
            $em->persist($reservation);
            $em->flush();
    
            $this->addFlash('success', 'Données personnalisées enregistrées avec succès.');
    
            return $this->redirectToRoute('app_reservation_index');
        }
    
        return $this->render('custom_form\custom_form.htm.twig', [
            'form' => $form->createView(),
            'reservation' => $reservation,
        ]);
    }
}    