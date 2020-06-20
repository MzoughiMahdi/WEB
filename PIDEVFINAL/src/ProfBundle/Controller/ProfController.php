<?php

namespace ProfBundle\Controller;


use ProfBundle\Form\ProfType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ProfBundle\Entity\Prof;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class ProfController extends Controller
{
    public function AfficherAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $prof = $em->getRepository(Prof::class)->findAll();
        /**
         * @var $paginator Knp\Component\Pager\Paginator
         */
        $paginator=$this->get('knp_paginator');
        $result=$paginator->paginate(
            $prof,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',5)
        );
        return $this->render('@Prof/prof/prof.html.twig', array('profs' => $result
        ));

    }


    public function AjouterAction(Request $request)
    {
        $prof = new Prof();


        $form = $this->createFormBuilder($prof)
            ->add('nom')
            ->add('prenom')
            ->add('tel')
            ->add('email')
            ->add('adresse')
            ->add('specialite', ChoiceType::class,array(
                'choices'=>array(
                    'Francais'=>'Francais',
                    'Anglais'=>'Anglais',
                    'Arabe'=>'Arabe',
                    'Mathématiques'=>'Mathématiques',
                    'Histoire géographie'=>'Histoire géographie',
                    'Sciences de la vie et de la terre'=>'Sciences de la vie et de la terre',
                    'Sciences physiques'=>'Sciences physiques',
                    'Technologie'=>'Technologie',
                    'Musique'=>'Musique',
                )
            ))
            ->add('Add', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($request->isMethod('post') && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();
            $this->addFlash('success','l\'enseignant est ajouté avec succssé !' );
            return $this->redirectToRoute('afficher');

        }


        return $this->render('@Prof/prof/ajouter.html.twig', array(
            'form'=>$form->createView()
        ));
    }


    public function ModifierAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $find=$this->getDoctrine()->getRepository(Prof::class)->find($id);
        //$find=$em->getRepository(Prof::class)->find($id); Correcte
        $form = $this->createForm(ProfType::class,$find);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em->persist($find);
            $em->flush();
           //echo $id=$id+20;
            $this->addFlash('modif','la modification est effectuée avec succssé' );
            return $this->redirectToRoute('afficher');

        }
        return $this->render('@Prof/prof/modifer.html.twig', array(
            'form'=>$form->createView()
        ));
    }



    public function SuppAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $find=$this->getDoctrine()->getRepository(Prof::class)->find($id);
        $em->remove($find);
        $em->flush();
        $this->addFlash('supp','l\'enseignant est supprimé avec succssé !' );
        return $this->redirectToRoute('afficher');

    }



//Integration Mobile
    public function AjoutAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $prof = new Prof();
        $prof->setNom($request->get('n')) ;
        $prof->setPrenom($request->get('p'));
        $prof->setTel($request->get('t'));
        $prof->setEmail($request->get('e')) ;
        $prof->setAdresse($request->get('a'));
        $prof->setSpecialite($request->get('s'));
        $em->persist($prof);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($prof);
        return new JsonResponse($formatted);
    }

    public function updatAction($id,Request $request,Prof $prof)
    {
        $prof->setNom($request->get('n')) ;
        $prof->setPrenom($request->get('p'));
        $prof->setTel($request->get('t'));
        $prof->setEmail($request->get('e')) ;
        $prof->setAdresse($request->get('a'));
        $prof->setSpecialite($request->get('s'));
        $this->getDoctrine()->getManager()->flush();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers);
        $formatted = $serializer->normalize($prof);
        return new JsonResponse($formatted);


    }

    public function deletAction($id,Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $Prof = $em->getRepository('ProfBundle:Prof')->find($id);
        $em->remove($Prof);
        $em->flush();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers);
        $formatted = $serializer->normalize($Prof);
        return new JsonResponse($formatted);

    }

    public function allAction()
    {
        $student = $this->getDoctrine()->getManager()
            ->getRepository('ProfBundle:Prof')
            ->findAll();
        foreach ($student as $key => $blog){
            $datas[$key]['id'] = $blog->getId();
            $datas[$key]['nom'] = $blog->getNom();
            $datas[$key]['prenom'] = $blog->getPrenom();
            $datas[$key]['tel'] = $blog->getTel();
            $datas[$key]['email'] = $blog->getEMail();
            $datas[$key]['adresse'] = $blog->getAdresse();
            $datas[$key]['specialite'] = $blog->getSpecialite();


        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($datas);
        return new JsonResponse($formatted);
    }



}
