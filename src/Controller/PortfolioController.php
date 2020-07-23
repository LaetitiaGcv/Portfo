<?php

namespace App\Controller;


use App\Repository\ExperiencesRepository;
use App\Repository\ProjectRepository;
use App\Repository\SkillsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PortfolioController extends AbstractController
{
    /**
     * @Route("/", name="portfolio_home")
     * @param ExperiencesRepository $experiencesRepository
     * @param ProjectRepository $projectRepository
     * @param SkillsRepository $skillsRepository
     * @return Response
     */
    public function home(ExperiencesRepository $experiencesRepository, ProjectRepository $projectRepository, SkillsRepository $skillsRepository) :Response
    {
        return $this->render('/home.html.twig', [
            'website' => 'Portfolio',
            'experiences' => $experiencesRepository->findAll(),
            'project' => $projectRepository->findAll(),
            'skills' => $skillsRepository->findAll(),

        ]);
    }

}