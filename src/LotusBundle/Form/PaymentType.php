<?php

namespace Kocliko\ComptaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
//use Symfony\Component\Form\Extension\Core\Type\TextType;

class PaymentType extends AbstractType
{
    private $doctrine;
    /** @var \Doctrine\ORM\EntityManager */
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('invoice', EntityType::class, array(
                'class' => 'KoclikoComptaBundle:Invoice',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('i')
                        ->where()
                        ->orderBy('i.partnumber', 'ASC');
                },
                'choice_label' => 'partnumber',
            ))
            ->add('client',EntityType::class,array('class'=>'KoclikoComptaBundle:Client','choice_label'=>'name'))
            //->add('invoice',EntityType::class,array('class'=>'KoclikoComptaBundle:Invoice','choice_label'=>'partnumber'))
            ->add('date', DateType::class)
            ->add('amount', MoneyType::class)
            ->add('paymentmode', EntityType::class,array('class'=>'KoclikoComptaBundle:PaymentMode', 'choice_label'=>'name','preferred_choices' => array(null)))
            ->add('account', EntityType::class,array('class'=>'KoclikoComptaBundle:Account', 'choice_label'=>'name','preferred_choices' => array(null)))
            ->add('save', SubmitType::class, array('label' => 'Enregister ce paiement','attr'=> array('class' => 'btn btn-primary pull-right')));

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kocliko\ComptaBundle\Entity\Payment'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'kocliko_comptabundle_payment';
    }


}
