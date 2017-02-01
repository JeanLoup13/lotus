<?php
// src/LotusBundle/Controller/ZoneSecteurController.php

namespace LotusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LotusBundle\Entity\ZoneSecteur;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException ;
use Symfony\Component\HttpFoundation\Request;

class ZoneSecteurController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
       
        $listZoneSecteurs = $em->getRepository('LotusBundle:ZoneSecteur')->findAll();
        if(null ===$listZoneSecteurs){
            throw new NotFoundHttpException("Liste des Secteurs inacessible");
        }
       
        return $this->render('LotusBundle:ZoneSecteur:list.html.twig',array(
            'listZoneSecteurs'=>$listZoneSecteurs
        ));
    }
    
}