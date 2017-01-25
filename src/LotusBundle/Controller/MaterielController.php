<?php

namespace LotusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use LotusBundle\Entity\Materiel;
use LotusBundle\Form\MaterielType;
use LotusBundle\Form\FilterMaterielType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException ;
use Symfony\Component\HttpFoundation\Request;

class MaterielController extends Controller
{
    public function addAction(Request $request)
    {
        $materiel = new Materiel();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(MaterielType::class,$materiel);
        if($request->isMethod('POST') && $form->handleRequest($request)->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($materiel);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice','Matériel bien enregistré');
            return $this->redirectToRoute('lotus_materiel_edit', array('id'=>$materiel->getId()));
        }
        return $this->render('LotusBundle:Materiel:add.html.twig', array('form'=>$form->createView()));
    }
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $materiel = $em->getRepository('LotusBundle:Materiel')->find($id);        
        if(null === $materiel){
            $request->getSession()->getFlashBag()->add('notice',"Matériel n°$id non retrouvé");
            throw new NotFoundHttpException("Matériel $id non retrouvée en bdd");
        }
        $form = $this->createForm(MaterielType::class,$materiel);
        $form
            ->add('duplicate', SubmitType::class, array('label' => 'Dupliquer','attr'=> array('class' => 'btn btn-success')));
        
        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            if($form->get('duplicate')->isClicked()) {
                $new_materiel = clone $materiel;
                unset($materiel);
                $em->persist($new_materiel);
                $new_materiel->setPartNumber(NULL);
                $em->flush(); 
                $request->getSession()->getFlashBag()->add('notice','Matériel dupliquée');
                return $this->redirectToRoute( 'lotus_materiel_edit', array('id'=>$new_materiel->getId()));
            }
            else {
                $materiel->getLastDatePayment();
                $em->persist($materiel);
                $em->flush(); 
                $request->getSession()->getFlashBag()->add('notice','Modification du Matériel bien enregistrée');
                return $this->redirectToRoute( 'lotus_materiel_edit', array('id'=>$materiel->getId()));
            }
            
        }
        return $this->render('LotusBundle:Materiel:edit.html.twig', array('form'=>$form->createView(),'materiel'=>$materiel));

    }
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(FilterMaterielType::class);
        $form
            ->add('marque', EntityType::class,array('class'=>'LotusBundle:Marque', 'choice_label'=>'libelle','preferred_choices' => array(null)))
            ->add('materielFamille', EntityType::class,array('class'=>'LotusBundle:MaterielFamille', 'choice_label'=>'libelle','preferred_choices' => array(null)))
            ->add('list', SubmitType::class,array('label' => 'Filtrer','attr'=> array('class' => 'btn btn-default')))
        ;
        // Listing des Matériels
        if($request->isMethod('POST')){
            //$form->handleRequest($request);
            $data = $request->request->get('lotusbundle_materiel');
            //$listMateriels =  $em ->getRepository('LotusBundle:Materiel')->findBy(array('client'=>$data['client']),array('dateEdit'=>'desc','partnumber'=>'desc'));
            $listMateriels = $em->getRepository('LotusBundle:Materiel')->getByMarqueAndFamille($data['materielFamille'], $data['marque']);
        }
        else {
            $listMateriels = $em->getRepository('LotusBundle:Materiel')->findAll();
        }
        if(null ===$listMateriels){
            throw new NotFoundHttpException("Liste des Matériels inacessible");
        }
       
        return $this->render('LotusBundle:Materiel:list.html.twig',array(
            'listMateriels'=>$listMateriels,
            'form'=>$form->createView()
        ));
    }
    
}