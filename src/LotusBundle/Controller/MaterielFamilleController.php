<?php

namespace LotusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use LotusBundle\Entity\MaterielFamille;
use LotusBundle\Form\MaterielFamilleType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException ;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

class MaterielFamilleController extends Controller
{
    public function addAction(Request $request)
    {
        $materielfamille = new MaterielFamille();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(MaterielFamilleType::class,$materielfamille);
        if($request->isMethod('POST') && $form->handleRequest($request)->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($materielfamille);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice','Famille de Matériel bien enregistrée');
            return $this->redirectToRoute('lotus_materielfamille_edit', array('id'=>$materielfamille->getId()));
        }
        return $this->render('LotusBundle:MaterielFamille:add.html.twig', array('form'=>$form->createView()));
    }
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $materielfamille = $em->getRepository('LotusBundle:MaterielFamille')->find($id);        
        if(null === $materielfamille){
            $request->getSession()->getFlashBag()->add('notice',"Famille de Matériel n°$id non retrouvé");
            throw new NotFoundHttpException("Famille de Matériel $id non retrouvée en bdd");
        }
        $form = $this->createForm(MaterielFamilleType::class,$materielfamille);
        $form->add('duplicate', SubmitType::class, array('label' => 'Dupliquer','attr'=> array('class' => 'btn btn-default')));
        
        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            if($form->get('duplicate')->isClicked()) {
                $new_materielfamille = clone $materielfamille;
                unset($materielfamille);
                $em->persist($new_materielfamille);
                $new_materielfamille->setPartNumber(NULL);
                $em->flush(); 
                $request->getSession()->getFlashBag()->add('notice','Famille de Matériel dupliquée');
                return $this->redirectToRoute( 'lotus_materielfamille_edit', array('id'=>$new_materielfamille->getId()));
            }
            else {
                $em->persist($materielfamille);
                $em->flush(); 
                $request->getSession()->getFlashBag()->add('notice','Modification de la Famille de Matériel bien enregistrée');
                return $this->redirectToRoute( 'lotus_materielfamille_edit', array('id'=>$materielfamille->getId()));
            }
        }
        return $this->render('LotusBundle:MaterielFamille:edit.html.twig', array('form'=>$form->createView(),'materielfamille'=>$materielfamille));

    }
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();        
        $repo = $em->getRepository('LotusBundle:MaterielFamille');
        $listMaterielNodes = $repo->getRootNodes();
        if(null ===$listMaterielNodes){
            throw new NotFoundHttpException("Liste des Noeuds de Familles de Matériel inacessible");
        }
        return $this->render('LotusBundle:MaterielFamille:list.html.twig',array('listMaterielNodes'=>$listMaterielNodes));
        //$listMaterielFamilles = $em->getRepository('LotusBundle:MaterielFamille')->findAll();
        //$ex = $repo->findOneByTitle('Bâtiment');
        //return new Response("ok");
    }
    
}