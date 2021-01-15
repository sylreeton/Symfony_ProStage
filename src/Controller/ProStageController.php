<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;
use App\Repository\StageRepository;
use App\Entity\Entreprise;
use App\Repository\EntrepriseRepository;
use App\Entity\Formation;
use App\Repository\FormationRepository;

class ProStageController extends AbstractController
{
    /**
     * @Route("/", name="pro_stage")
     */
     public function index(): Response
     {
        $stagesRepository = $this->getDoctrine()->getRepository(Stage::class);
        $stages = $stagesRepository->findAll();

        return $this->render('pro_stage/index.html.twig', ['stageList' => $stages]);
     }

    /**
     * @Route("/entreprises", name="pro_stage_entreprises")
     */
    public function afficherEntreprises(): response
    {
        $repositoryEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);
        $entreprises = $repositoryEntreprise->findAll();

        return $this->render('pro_stage/affichageEntreprises.html.twig', ['entrepriseList' => $entreprises]);
    }

    /**
     * @Route("/formations", name="pro_stage_formations")
     */
    public function afficherFormations(): response
    {
        $repositoryFormation = $this->getDoctrine()->getRepository(Formation::class);
        $formations = $repositoryFormation->findAll();

        return $this->render('pro_stage/affichageFormations.html.twig', ['formationList' => $formations]);
    }

        /**
         * @Route("/stages/{idstage}", name="pro_stage_stages")
         */
        public function afficherStages($idstage): response
        {
            $stagesRepository = $this->getDoctrine()->getRepository(Stage::class);
            $stage = $stagesRepository->find($idstage);

            return $this->render('pro_stage/affichageStages.html.twig',
             ['stage'=> $stage]);

        }

}
