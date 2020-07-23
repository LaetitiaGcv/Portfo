<?php

namespace App\Controller;


use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ExperiencesRepository;
use App\Repository\ProjectRepository;
use App\Repository\SkillsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PortfolioController extends AbstractController
{
    /**
     * @Route("/", name="portfolio_home")
     * @param Request $request
     * @param ExperiencesRepository $experiencesRepository
     * @param ProjectRepository $projectRepository
     * @param SkillsRepository $skillsRepository
     * @return Response
     */
    public function home(Request $request, ExperiencesRepository $experiencesRepository, ProjectRepository $projectRepository, SkillsRepository $skillsRepository): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            $this->addFlash('success', 'Ton message a bien été envoyé');

        }

        return $this->render('/home.html.twig', [
            'website' => 'Portfolio',
            'experiences' => $experiencesRepository->findAll(),
            'project' => $projectRepository->findAll(),
            'skills' => $skillsRepository->findAll(),
            'form' => $form->createView(),

        ]);
    }

}