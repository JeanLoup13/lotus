<?php

namespace LotusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use LotusBundle\Entity\Materiel;
use LotusBundle\Form\MaterielAddType;
use LotusBundle\Form\MaterielEditType;
use LotusBundle\Form\MaterielFilterType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException ;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MaterielController extends Controller
{
    public function addAction(Request $request)
    {
        $materiel = new Materiel();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(MaterielAddType::class,$materiel);
        //$form->add('materielFamille', EntityType::class,array('class'=>'LotusBundle:MaterielFamille', 'choice_label'=>'title'));
        $form->add('materielFamille', ChoiceType::class, (array('choices' => $em->getRepository('LotusBundle:MaterielFamille')->getFormChoices())));
        $em->getRepository('LotusBundle:MaterielFamille')->getFormChoices();
        if($request->isMethod('POST') && $form->handleRequest($request)->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($materiel);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice','Matériel bien enregistré');
            return $this->redirectToRoute('lotus_materiel_edit', array('id'=>$materiel->getId()));
        }
        //return new Response("ok");
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
        $form = $this->createForm(MaterielEditType::class,$materiel);
        $form->add('materielFamille', ChoiceType::class, (array('choices' => $em->getRepository('LotusBundle:MaterielFamille')->getFormChoices())));
        
        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            if($form->get('duplicate')->isClicked()) {
                $new_materiel = clone $materiel;
                $em->detach($materiel);
                $em->persist($new_materiel);
                $new_materiel->setCodeEan(NULL);
                $now = new \DateTime();
                $new_materiel->setCreatedAt($now);
                $em->flush(); 
                $request->getSession()->getFlashBag()->add('notice','Matériel dupliquée');
                return $this->redirectToRoute( 'lotus_materiel_edit', array('id'=>$new_materiel->getId()));
            }
            else { 
                
                try {
                    $em->persist($materiel); 
                    $em->flush();  
                    $request->getSession()->getFlashBag()->add('notice','Modification du Matériel bien enregistrée');
                 } catch (Exception $e) {
                     $request->getSession()->getFlashBag()->add('flash_key',"Add not done: " . $e->getMessage());
                 }
                return $this->redirectToRoute( 'lotus_materiel_edit', array('id'=>$materiel->getId()));
            }
            
        }
        return $this->render('LotusBundle:Materiel:edit.html.twig', array('form'=>$form->createView(),'materiel'=>$materiel));

    }
    public function listAction(Request $request)
    {
        
        $em = $this->getDoctrine()->getManager();
        $MaterielFamilleRepo = $em->getRepository('LotusBundle:MaterielFamille');
        if($MaterielFamilleRepo->verify() == true) echo 'Arbre est valide' ;
        else  echo 'Arbre pas valide' ;
        // can return TRUE if tree is valid, or array of errors found on tree
        //$MaterielFamilleRepo->recover();
        //$em->flush();
        $form = $this->createForm(MaterielFilterType::class);
        $form->handleRequest($request);
        // Listing des Matériels
        if($form->isSubmitted() && $form->isValid()) {
            
            $data = $form->getData();
            var_dump($data);
            //$listMateriels =  $em ->getRepository('LotusBundle:Materiel')->findBy(array('client'=>$data['client']),array('dateEdit'=>'desc','partnumber'=>'desc'));
            $listMateriels = $em->getRepository('LotusBundle:Materiel')->getByMarqueAndFamille($data['marque'],$data['materielFamille'],0);
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