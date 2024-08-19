<?php
namespace App\Controller;

use App\Entity\Evenement;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TriController extends AbstractController
{
    #[Route('/tri/{id}', name: 'app_tri')]
    public function index(Evenement $evenement, ReservationRepository $reservationRepository): Response
    {
        $reservations = $reservationRepository->findBy(['evenement' => $evenement]);

        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
            'reservations' => $reservations,
        ]);
    }

    #[Route('/evenement/{id}/tri/idr/asc', name: 'reservation_display_sorted_by_id_asc')]
    public function displaySortedByIdASC(Evenement $evenement, ReservationRepository $reservationRepository): Response
    {
        $reservations = $reservationRepository->findBy(['evenement' => $evenement], ['idr' => 'ASC']);

        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
            'reservations' => $reservations,
        ]);
    }

    #[Route('/evenement/{id}/tri/idr/desc', name: 'reservation_display_sorted_by_id_desc')]
    public function displaySortedByIdDESC(Evenement $evenement, ReservationRepository $reservationRepository): Response
    {
        $reservations = $reservationRepository->findBy(['evenement' => $evenement], ['idr' => 'DESC']);

        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
            'reservations' => $reservations,
        ]);
    }

    #[Route('/evenement/{id}/tri/nom/asc', name: 'reservation_display_sorted_by_nom_asc')]
    public function displaySortedByNomASC(Evenement $evenement, ReservationRepository $reservationRepository): Response
    {
        $reservations = $reservationRepository->findBy(['evenement' => $evenement], ['nom' => 'ASC']);

        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
            'reservations' => $reservations,
        ]);
    }

    #[Route('/evenement/{id}/tri/nom/desc', name: 'reservation_display_sorted_by_nom_desc')]
    public function displaySortedByNomDESC(Evenement $evenement, ReservationRepository $reservationRepository): Response
    {
        $reservations = $reservationRepository->findBy(['evenement' => $evenement], ['nom' => 'DESC']);

        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
            'reservations' => $reservations,
        ]);
    }

    #[Route('/evenement/{id}/tri/prenom/asc', name: 'reservation_display_sorted_by_prenom_asc')]
    public function displaySortedByPrenomASC(Evenement $evenement, ReservationRepository $reservationRepository): Response
    {
        $reservations = $reservationRepository->findBy(['evenement' => $evenement], ['prenom' => 'ASC']);

        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
            'reservations' => $reservations,
        ]);
    }

    #[Route('/evenement/{id}/tri/prenom/desc', name: 'reservation_display_sorted_by_prenom_desc')]
    public function displaySortedByPrenomDESC(Evenement $evenement, ReservationRepository $reservationRepository): Response
    {
        $reservations = $reservationRepository->findBy(['evenement' => $evenement], ['prenom' => 'DESC']);

        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
            'reservations' => $reservations,
        ]);
    }

    #[Route('/evenement/{id}/tri/matricule/asc', name: 'reservation_display_sorted_by_matricule_asc')]
    public function displaySortedByMatriculeASC(Evenement $evenement, ReservationRepository $reservationRepository): Response
    {
        $reservations = $reservationRepository->findBy(['evenement' => $evenement], ['matricule' => 'ASC']);

        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
            'reservations' => $reservations,
        ]);
    }

    #[Route('/evenement/{id}/tri/matricule/desc', name: 'reservation_display_sorted_by_matricule_desc')]
    public function displaySortedByMatriculeDESC(Evenement $evenement, ReservationRepository $reservationRepository): Response
    {
        $reservations = $reservationRepository->findBy(['evenement' => $evenement], ['matricule' => 'DESC']);

        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
            'reservations' => $reservations,
        ]);
    }

    #[Route('/evenement/{id}/tri/adresse/asc', name: 'reservation_display_sorted_by_adresse_asc')]
    public function displaySortedByAdresseASC(Evenement $evenement, ReservationRepository $reservationRepository): Response
    {
        $reservations = $reservationRepository->findBy(['evenement' => $evenement], ['adresse' => 'ASC']);

        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
            'reservations' => $reservations,
        ]);
    }

    #[Route('/evenement/{id}/tri/adresse/desc', name: 'reservation_display_sorted_by_adresse_desc')]
    public function displaySortedByAdresseDESC(Evenement $evenement, ReservationRepository $reservationRepository): Response
    {
        $reservations = $reservationRepository->findBy(['evenement' => $evenement], ['adresse' => 'DESC']);

        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
            'reservations' => $reservations,
        ]);
    }

    #[Route('/evenement/{id}/tri/num/asc', name: 'reservation_display_sorted_by_num_asc')]
    public function displaySortedByNumASC(Evenement $evenement, ReservationRepository $reservationRepository): Response
    {
        $reservations = $reservationRepository->findBy(['evenement' => $evenement], ['num' => 'ASC']);

        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
            'reservations' => $reservations,
        ]);
    }

    #[Route('/evenement/{id}/tri/num/desc', name: 'reservation_display_sorted_by_num_desc')]
    public function displaySortedByNumDESC(Evenement $evenement, ReservationRepository $reservationRepository): Response
    {
        $reservations = $reservationRepository->findBy(['evenement' => $evenement], ['num' => 'DESC']);

        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
            'reservations' => $reservations,
        ]);
    }
}
