<?php
// adc/src/LotusBundle/Form/MaterielFamilleEditType

namespace LotusBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class MaterielFamilleEditType extends AbstractType
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
    

}
