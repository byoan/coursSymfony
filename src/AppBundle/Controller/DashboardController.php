<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use AppBundle\Entity\Projet;
use AppBundle\Service\RandomImageGenerator;

class DashboardController extends Controller
{
    /**
     * Displays the dashboard view
     *
     * @Route("/dashboard", name="dashboard")
     *
     * @param Request $request
     */
    public function displayDashboardAction(Request $request)
    {
        $entityManager = $this->container->get('doctrine.orm.entity_manager');

        // Get random image
        $randomImage = $this->container->get(RandomImageGenerator::class)->getRandomImageURL();

        $projects = $entityManager
                ->getRepository('AppBundle:Projet')
                ->createQueryBuilder('p')
                ->where('p.dateEnd >= :date')
                ->setParameter('date', new \DateTime())
                ->getQuery()
                ->getResult();

        $managers = $entityManager->getRepository('AppBundle:Manager')->findAll();

        $form = $this->createFormBuilder(new Projet())
            ->setAction($this->generateUrl('dashboard'))
            ->add('id', ChoiceType::class, array(
                'placeholder' => 'All',
                'label' => 'Par projet',
                'choices' => $projects,
                'choice_label' => 'projectName',
            ))
            ->add('submit', SubmitType::class, array('label' => 'OK'))
            ->setMethod('POST')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $project = $form->getData();
            $fiches = $entityManager->getRepository('AppBundle:Fiche')->findBy(array('project' => $project->getId()));
        } else {
            $fiches = $entityManager->getRepository('AppBundle:Fiche')->findAll();
        }

        return $this->render('projet/dashboard.html.twig', array(
            'projects' => $projects,
            'managers' => $managers,
            'fiches' => $fiches,
            'form' => $form->createView(),
            'randomImage' => $randomImage,
        ));
    }
}
