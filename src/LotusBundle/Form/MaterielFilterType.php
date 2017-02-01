<?php
// adc/src/LotusBundle/Form/MaterielFilterType

namespace LotusBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MaterielFilterType extends AbstractType
{
    private $doctrine;
    /** @var \Doctrine\ORM\EntityManager */
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('marque', EntityType::class,array('class'=>'LotusBundle:Marque', 'choice_label'=>'title','preferred_choices' => array(null)))
            ->add('materielFamille', EntityType::class,array('class'=>'LotusBundle:MaterielFamille', 'choice_label'=>'title','preferred_choices' => array(null)))
            ->add('list', SubmitType::class,array('label' => 'Filtrer','attr'=> array('class' => 'btn btn-default')))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LotusBundle\Entity\Materiel'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lotusbundle_materielfilter';
    }
}