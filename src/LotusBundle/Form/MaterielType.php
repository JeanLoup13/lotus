<?php
// adc/src/LotusBundle/Form/MaterielType

namespace LotusBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MaterielType extends AbstractType
{
    private $doctrine;
    /** @var \Doctrine\ORM\EntityManager */
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('codeEan', TextType::class)
            ->add('codeFournisseur', TextType::class)
            ->add('marque', EntityType::class,array('class'=>'LotusBundle:Marque', 'choice_label'=>'libelle','preferred_choices' => array(null)))
            ->add('materielFamille', EntityType::class,array('class'=>'LotusBundle:MaterielFamille', 'choice_label'=>'libelle','preferred_choices' => array(null)))
            ->add('consommable', CheckboxType::class, array('label'=> 'Consommable','required' => false))
            ->add('outil', CheckboxType::class, array('label'=> 'Outil','required' => false))
            ->add('libelle', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Enregister','attr'=> array('class' => 'btn btn-primary pull-right')))
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
        return 'lotusbundle_materiel';
    }


}
