<?php

namespace LotusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LotusBundle\Entity\Image;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Comur\ImageBundle\Form\Type\CroppableImageType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException ;
use Symfony\Component\HttpFoundation\Request;

class ImageController extends Controller
{
    public function addAction(Request $request)
    {
        $image = new Image();
        $formbuilder = $this->get('form.factory')->createBuilder(FormType::class, $image);
        $formbuilder
            ->add('image', CroppableImageType::class, 
                array(
                    'uploadConfig' => array(
                        'uploadRoute' => 'comur_api_upload',        //optional
                        'uploadUrl' => $image->getUploadRootDir(),       // required - see explanation below (you can also put just a dir path)
                        'webDir' => 'web/images/uploads',              // required - see explanation below (you can also put just a dir path)
                        'fileExt' => '*.jpg;*.gif;*.png;*.jpeg',    //optional
                        'libraryDir' => null,                       //optional
                        'libraryRoute' => 'comur_api_image_library', //optional
                        'showLibrary' => true,                      //optional
                        'saveOriginal' => 'originalImage',          //optional
                        'generateFilename' => true          //optional
                    ),
                    'cropConfig' => array(
                        'minWidth' => 800,
                        'minHeight' => 600,
                        'aspectRatio' => true,              //optional
                        'cropRoute' => 'comur_api_crop',    //optional
                        'forceResize' => false,             //optional
                        'thumbs' => array(                  //optional
                            array(
                                'maxWidth' => 200,
                                'maxHeight' => 200,
                                'useAsFieldImage' => true  //optional
                            )
                        )
                    )
                )
            )
            ->add('alt', TextType::class)
            ->add('save', SubmitType::class, array('attr'=> array('class' => 'btn btn-primary')));
        
        $form = $formbuilder->getForm();
        
        if($request->isMethod('POST') && $form->handleRequest($request)->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice','Image bien enregistrée');
            return $this->redirectToRoute( 'lotus_image_list');
           // return $this->redirectToRoute( 'lotus_image_edit', array('id'=>$image->getId()));
        }
       
        
        // return new Response("ok");
        return $this->render('LotusBundle:Image:add.html.twig', array('form'=>$form->createView()));
    }
    public function editAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $image = $em->getRepository('LotusBundle:Image')->find($id); 
        if(null === $image){
            $request->getSession()->getFlashBag()->add('notice',"Image n°$id non retrouvé");
            throw new NotFoundHttpException("Image $id non retrouvée en bdd");
        }
        
        $form = $this->get('form.factory')->createBuilder(FormType::class, $image);
        $form->add('image', CroppableImageType::class, array(
            'uploadConfig' => array(
                'uploadRoute' => 'comur_api_upload',        //optional
                'uploadUrl' => $image->getUploadRootDir(),       // required - see explanation below (you can also put just a dir path)
                'webDir' => $image->getUploadDir(),              // required - see explanation below (you can also put just a dir path)
                'fileExt' => '*.jpg;*.gif;*.png;*.jpeg',    //optional
                'libraryDir' => null,                       //optional
                'libraryRoute' => 'comur_api_image_library', //optional
                'showLibrary' => true,                      //optional
                'saveOriginal' => 'originalImage',          //optional
                'generateFilename' => true          //optional
            ),
            'cropConfig' => array(
                'minWidth' => 588,
                'minHeight' => 300,
                'aspectRatio' => true,              //optional
                'cropRoute' => 'comur_api_crop',    //optional
                'forceResize' => false,             //optional
                'thumbs' => array(                  //optional
                    array(
                        'maxWidth' => 180,
                        'maxHeight' => 400,
                        'useAsFieldImage' => true  //optional
                    )
                )
            )
        ));
        $form->getForm();
        
        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->persist($image);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice','Image bien enregistrée');
            return $this->redirectToRoute( 'lotus_image_edit', array('id'=>$image->getId()));
        }
        
        return $this->render('LotusBundle:Image:edit.html.twig', array('form'=>$form->createView(),'image'=>$image));
    }
   
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
       
        $listImages = $em->getRepository('LotusBundle:Image')->findAll();
        if(null ===$listImages){
            throw new NotFoundHttpException("Liste des imagess inacessible");
        }
       
        return $this->render('LotusBundle:Image:list.html.twig',array(
            'listImages'=>$listImages
        ));
    }
}