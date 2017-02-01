<?php
// adc/src/LotusBundle/Form/MaterielEditType

namespace LotusBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class MaterielEditType extends AbstractType
{
    private $doctrine;
    /** @var \Doctrine\ORM\EntityManager */
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$builder->remove('duplicate'); 
        $builder->add('duplicate', SubmitType::class, array('attr'=> array('class' => 'btn btn-default')));

    }
    
    public function getParent()
    {
        return MaterielType::class;
    }
}
