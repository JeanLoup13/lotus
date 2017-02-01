<?php
// adc/src/LotusBundle/Form/MaterielType

namespace LotusBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MaterielFamilleType extends AbstractType
{
    private $doctrine;
    /** @var \Doctrine\ORM\EntityManager */
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parent', EntityType::class,array('class'=>'LotusBundle:MaterielFamille', 'choice_label'=>'Title'))
            ->add('title', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Enregister','attr'=> array('class' => 'btn btn-primary pull-right')))
            ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LotusBundle\Entity\MaterielFamille'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lotusbundle_materielfamille';
    }


}
