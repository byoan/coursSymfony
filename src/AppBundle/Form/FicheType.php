<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Projet;

class FicheType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('ficheDate')
                ->add('nbDayDone')
                ->add('nbDaySold')
                ->add('progression')
                ->add('comment')
                ->add('manager')
                ->add('project', EntityType::class, array(
                    'label' => 'Veuillez choisir ',
                    'class' => Projet::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->getOpenedProjects();
                        // Equivalent à ceci
                        // return $er->createQueryBuilder('p')
                        //     ->where('p.dateEnd >= :date')
                        //     ->setParameter('date', new \Datetime());
                    }
                ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Fiche'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_fiche';
    }
}
