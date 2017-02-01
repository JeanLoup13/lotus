<?php
// adc/src/LotusBundle/Form/MaterielAddType

namespace LotusBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class MaterielAddType extends AbstractType
{    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    }
    
    public function getParent()
    {
        return MaterielType::class;
    }
}
