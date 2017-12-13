<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Helper\Table;

class ProjectCommand extends Command
{
    private $projectService;

    public function __construct(\AppBundle\Service\ProjectService $projectService)
    {
        $this->projectService = $projectService;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('project:status')
             ->setDescription('Liste l\'état des projets.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $table = new Table($output);
        $rows = array();

        foreach ($this->projectService->getAvancementProjet() as $projectName => $progression) {
            $rows[] = array($projectName, $progression . '%');
        }

        $table
            ->setHeaders(array('Nom du project', 'Avancement'))
            ->setRows($rows);
        $table->render();
    }
}
