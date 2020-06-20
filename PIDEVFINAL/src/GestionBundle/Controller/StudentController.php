<?php

namespace GestionBundle\Controller;

use GestionBundle\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use GestionBundle\Form\StudentType;

class StudentController extends Controller
{
    public function DisplayAction()
    {
        $em = $this->getDoctrine()->getManager();

        $student = $em->getRepository(Student::class)->findAll();
        return $this->render('@Gestion/Student/display.html.twig', array('students' => $student
        ));
    }

    public function createAction(Request $request)
    {   $student = new Student();
        $student->setDateofbirth(new \DateTime('now'));
        $student->setAbs(0);
        $form = $this->createFormBuilder($student)
            ->add('class')
            ->add('mail')
            ->add('sex')
            ->add('name')
            ->add('login')
            ->add('password')
            ->add('adress')
            ->add('dateofbirth', BirthdayType::class, [
                'placeholder' => [
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                ]
            ])
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
            return $this->redirectToRoute('displaystudent');
        }


        return $this->render('@Gestion/Student/create.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function updateAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $find=$this->getDoctrine()->getRepository(Student::class)->find($id);
        $form = $this->createForm(StudentType::class,$find);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em->persist($find);
            $em->flush();
            return $this->redirectToRoute('displaystudent');
        }
        return $this->render('@Gestion/Student/create.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $find=$this->getDoctrine()->getRepository(Student::class)->find($id);
        $em->remove($find);
        $em->flush();
        return $this->redirectToRoute('displaystudent');
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

    public function findAction()
    {

        $em = $this->getDoctrine()->getManager();

        $student = $em->getRepository(Student::class)->find(6);
        return $this->render('@Prof/prof/homes.html.twig', array('students' => $student
        ));
    }
}
