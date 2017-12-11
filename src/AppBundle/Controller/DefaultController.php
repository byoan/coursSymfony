<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $entityManager = $this->container->get('doctrine.orm.entity_manager');
        $fiches = $entityManager->getRepository('AppBundle:Fiche')->findAll();

        $fiche = $entityManager->getRepository('AppBundle:Fiche')->find(1);

        $ficheCool = $entityManager->getRepository('AppBundle:Fiche')->findBy(array('project' => 'ProjetCool'));

        $fiches = $entityManager
            ->getRepository('AppBundle:Fiche')
            ->createQueryBuilder('f')
            ->where('f.ficheDate > :date')
            ->setParameter('date', new \DateTime())
            ->orderBy('f.ficheDate', 'DESC')
            ->getQuery()
            ->getResult();

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT f
            FROM AppBundle:Fiche f
            WHERE f.ficheDate > :date'
        )->setParameter('date', new \DateTime());

        $fiches = $query->getResult();

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'fiches' => $fiches,
        ]);
    }

    /**
     * @Route("/hello/{name}", name="hello")
     */
    public function helloAction(Request $request, $name)
    {
        // replace this example code with whatever you need
        return $this->render('default/hello.html.twig', [
            'name' => $name,
        ]);
    }
}
