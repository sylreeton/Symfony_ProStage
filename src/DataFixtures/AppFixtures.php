<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprise;
use App\Entity\Stage;
use App\Entity\Formation;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        /***************************************
        ***     CREATION DES FORMATIONS     ***
        ****************************************/
        $info = new Formation();
        $info -> setIntitule("DUT Informatique");
        $info -> setNiveau("Bac+2");
        $info -> setVille("Anglet");

        $gim = new Formation();
        $gim -> setIntitule("DUT GIM");
        $gim -> setNiveau("Bac+2");
        $gim -> setVille("Anglet");

        $gea = new Formation();
        $gea -> setIntitule("DUT GEA");
        $gea -> setNiveau("Bac+2");
        $gea -> setVille("Anglet");

        $lpprog = new Formation();
        $lpprog -> setIntitule("Licence pro Prog avancée");
        $lpprog -> setNiveau("Bac+3");
        $lpprog -> setVille("Anglet");

        /* On regroupe les objets "formations" dans un tableau
        pour pouvoir s'y référer au moment de la création d'une ressource particulière */
        $listeFormations = array($info, $gim, $gea, $lpprog);

        // Mise en persistance des objets typeRessource
        foreach ($listeFormations as $formation) {
            $manager->persist($formation);
        }

        /*******************************
        *** CREATION DES ENTREPRISES ***
        ********************************/

        for ($i=0; $i <10 ; $i++) {

            // ************* Création d'un nouveau module *************
            $entreprise = new Entreprise();
            // Définition du nom de l'entreprise
            $entreprise->setNom($faker->company);
            // Définition de l'adresse de l'entreprise
            $entreprise->setAdresse($faker->address);
            // Définition du numéro du semestre
            $entreprise->setActivite($faker->realText($maxNbChars = 150, $indexSize = 2));

            // **** Création de plusieurs stages associées à l'entreprise
            $nbStagesAGenerer = $faker->numberBetween($min = 0, $max = 7);

            for ($numStages=0; $numStages < $nbStagesAGenerer; $numStages++) {
                $stage = new Stage();
                $stage -> setTitre($faker->realText($maxNbChars = 80, $indexSize = 2));
                $stage -> setDescription($faker->paragraph($nbSentences = 4, $variableNbSentences = true));
                $stage -> setEmail($faker->email);

                // Création relation Stage --> Entreprise
                $stage -> setEntreprise($entreprise);
                $entreprise->addStage($stage);

                // Création relation Stage --> Formations
                $nbFormations = $faker->numberBetween($min = 0, $max = 3);
                for ($numFormations=0; $numFormations < $nbFormations; $numFormations++) {
                    $randFormation = $faker->numberBetween($min = 0, $max = 3);
                    $stage -> addFormation($listeFormations[$randFormation]);
                    $listeFormations[$randFormation] -> addStage($stage);
                    $manager->persist($listeFormations[$randFormation]);
                }
                // Persister les objets modifiés
                $manager->persist($stage);
            }
            $manager->persist($entreprise);
        }
        $manager->flush();
    }
}
