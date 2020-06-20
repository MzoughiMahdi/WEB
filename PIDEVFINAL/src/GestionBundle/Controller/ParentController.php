<?php

namespace GestionBundle\Controller;

use GestionBundle\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GestionBundle\Entity\Parent2;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use GestionBundle\Form\ParentType;

class ParentController extends Controller
{
    public function DisplayAction()
    {
        $em = $this->getDoctrine()->getManager();

        $parent = $em->getRepository(Parent2::class)->findAll();
        return $this->render('@Gestion/Parent/display.html.twig', array('parents' => $parent
        ));
    }

    public function createAction(Request $request)
    {  $parent = new Parent2();
        $parent->setStudentid(null);

        $form = $this->createFormBuilder($parent)
            ->add('name')
            ->add('login')
            ->add('password')
//            ->add('Titre', 'text')
//            ->add('Texte', 'textarea')
            ->add('Add',SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if($request->isMethod('post') && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();
            return $this->redirectToRoute('displayparent');
        }

        return $this->render('@Gestion/Parent/create.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function updateAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $find=$this->getDoctrine()->getRepository(Parent2::class)->find($id);
        $form = $this->createForm(ParentType::class,$find);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em->persist($find);
            $em->flush();
            return $this->redirectToRoute('displayparent');
        }
        return $this->render('@Gestion/Parent/create.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $find=$this->getDoctrine()->getRepository(Parent2::class)->find($id);
        $em->remove($find);
        $em->flush();
        return $this->redirectToRoute('displayparent');
    }
/**
 * Creates a new coli entity.
 *
 */
//    public function newAction(Request $request)
//    {
//        $service = new Service();
//        $form = $this->createForm('TaxiCoBundle\Form\ServiceType', $service);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($service);
//            $em->flush();
//
//            return $this->redirectToRoute('colis_show', array('idC' => $colis->getIdc()));
//        }
//
//        return $this->render('colis/new.html.twig', array(
//            'coli' => $colis,
//            'form' => $form->createView(),
//        ));
//    }









    public function findpAction()
    {

        $em = $this->getDoctrine()->getManager();

        $find = $em->getRepository(Parent2::class)->find(6);

        return $this->render('@Prof/prof/homeparent.html.twig', array(
            'form'=>$find
        ));
    }
}
