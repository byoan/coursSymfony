<?php

namespace AppBundle\Service;

class ProjectService
{
    private $doctrine;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getAvancementProjet()
    {
        $avancement = array();

        $projects = $this->doctrine->getRepository('AppBundle:Projet')->findAll();

        foreach ($projects as $project) {
            $avancement[$project->getProjectName()] = $project->getProgression();
        }

        return $avancement;
    }
}
