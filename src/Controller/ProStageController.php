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
     public function index(StageRepository $repositoryStage): Response
     {
         $stages = $repositoryStage->findAll();

         return $this->render('pro_stage/index.html.twig', ['stageList' => $stages]);
     }

    /**
     * @Route("/entreprises", name="pro_stage_entreprises")
     */
    public function afficherEntreprises(): response
    {
        return $this->render('pro_stage/affichageEntreprises.html.twig');

    }

    /**
     * @Route("/formations", name="pro_stage_formations")
     */
    public function afficherFormations(): response
    {
        return $this->render('pro_stage/affichageFormations.html.twig');

    }

        /**
         * @Route("/stages/{idstage}", name="pro_stage_stages")
         */
        public function afficherStages(Stage $stage): response
        {
            return $this->render('pro_stage/affichageStages.html.twig',
             ['stage'=> $stage]);

        }

}
