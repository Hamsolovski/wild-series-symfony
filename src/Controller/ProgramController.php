<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;

class ProgramController extends AbstractController
{
    #[Route('/program', name: 'program_index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', [
            'website' => 'Wild Series',
            'programs' => $programs,
        ]);
    }

    #[Route('/program/{id}', requirements: ['id'=>'\d+'], methods: ['GET'], name: 'program_{id}')]
    public function show(int $id, ProgramRepository $programRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $id]);

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id ' . $id . ' found in database'
            );
        }        
    
        return $this->render('program/show.html.twig', [
            'website' => 'Wild Series',
            'program' => $program,
        ]);
    }

    #[Route('/program/{programId}/season/{seasonId}', methods: ['GET'], name: 'program_season_show')]
    public function showSeason(int $programId, int $seasonId, ProgramRepository $programRepository, SeasonRepository $seasonRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $programId]);
        $season = $seasonRepository->findOneBy(['id' => $seasonId]);

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id ' . $programId . ' found in database'
            );
        } else if (!$season) {
            throw $this->createNotFoundException(
                'No season with id ' . $seasonId . ' found in database'
            );
        }

        return $this->render('program/season_show.html.twig', [
            'website' => 'Wild Series',
            'program' => $program,
            'season' => $season,
        ]);
    }
}
