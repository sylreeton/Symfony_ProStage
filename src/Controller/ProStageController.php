<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProStageController extends AbstractController
{
    /**
     * @Route("/", name="pro_stage")
     */
    public function index(): response
    {
        return $this->render('pro_stage/index.html.twig');

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
         * @Route("/stages/{id}", name="pro_stage_stages")
         */
        public function afficherStages($id): response
        {
            return $this->render('pro_stage/affichageStages.html.twig',
             ['idStages'=> $id]);

        }

}
