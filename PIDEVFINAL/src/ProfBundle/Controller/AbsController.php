<?php


namespace ProfBundle\Controller;


use ProfBundle\Entity\Prof;
use ProfBundle\Entity\Abs;
use ProfBundle\Form\AbsType;
use ProfBundle\Form\ProfType;
use GestionBundle\Entity\Student;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class AbsController extends Controller
{

    public function AfficherAbsAction(Request $request)
    {
            $em = $this->getDoctrine()->getManager();

            $abs = $em->getRepository(Abs::class)->findAll();


        return $this->render('@Prof/prof/absafficher.html.twig', array('abs' => $abs
            ));

    }

    public function AjouterAbsAction(Request $request)
    {
        $abs = new Abs();

        $form = $this->createFormBuilder($abs)
            ->add('matiere', ChoiceType::class,array(
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
                )
            )
            ->add('classe')
            ->add('date')
            ->add('hdep'
                , ChoiceType::class,array(
                    'choices'=>array(
                        '8'=>'8',
                        '9'=>'9',
                        '10'=>'10',
                        '11'=>'11',
                        '12'=>'12',
                        '13'=>'13',
                        '14'=>'14',
                        '15'=>'15',
                        '16'=>'16',
                        '17'=>'17',
                        '18'=>'18',
                    )
                ))
            ->add('hfin', ChoiceType::class,array(
                'choices'=>array(
                    '8'=>'8',
                    '9'=>'9',
                    '10'=>'10',
                    '11'=>'11',
                    '12'=>'12',
                    '13'=>'13',
                    '14'=>'14',
                    '15'=>'15',
                    '16'=>'16',
                    '17'=>'17',
                    '18'=>'18',
                )
            ))
            ->add('Add', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($request->isMethod('post') && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();
            $this->addFlash('ajouterans','l\'absence est ajouté avec succssé !' );
             

        }


        return $this->render('@Prof/prof/ajoutabs.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function ajouterAction(Request $request)
    {
        $abs = new Abs();
       $abs->setMatiere($request->get("matiere"));
       $abs->setClasse($request->get("classe"));
       $abs->setHdep($request->get("hdep"));
       $abs->setHfin($request->get("hfin"));
            $em = $this->getDoctrine()->getManager();
            $em->persist($abs);
            $em->flush();

            return new JsonResponse("ok");

    }


    public function ModifierAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $find=$this->getDoctrine()->getRepository(Abs::class)->find($id);
        $form = $this->createForm(AbsType::class,$find);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em->persist($find);
            $em->flush();
            $this->addFlash('modifabs','la modification est effectuée avec succssé' );
            return $this->redirectToRoute('absaff');

        }
        return $this->render('@Prof/prof/absmoddif.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function ModifierAbsAction(Request $request)
    {
        $ab = $this->getDoctrine()->getRepository("ProfBundle:Abs")->find($request->get("id"));

        $ab->setMatiere($request->get("matiere"));
        $ab->setClasse($request->get("classe"));
        $ab->setHfin($request->get("hfin"));
        $ab->setHdep($request->get("hdep"));
        $em = $this->getDoctrine()->getManager();
        $em->persist($ab);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($ab);
        return new JsonResponse($formatted);
    }

    public function SuppAbsAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $find=$this->getDoctrine()->getRepository(Abs::class)->find($request->get("id"));
        $em->remove($find);
        $em->flush();
        return new JsonResponse("ok");
    }


    public function SuppAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $find=$this->getDoctrine()->getRepository(Abs::class)->find($request->get("id"));
        $em->remove($find);
        $em->flush();
        $this->addFlash('suppabs','l\'absence est supprimé avec succssé !' );
        return $this->redirectToRoute('absaff');
    }

    public function JoinAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $find=$this->getDoctrine()->getRepository(Abs::class)->find($id);
        $query=$em->createQuery(
          '
          SELECT a.matiere,
          a.classe,
          a.date,
          a.hdep,
          a.hfin,
          e.name
          FROM ProfBundle\Entity\Abs a
          LEFT JOIN GestionBundle\Entity\Student e WITH a.id=e.abs
          WHERE
          a.id = :id
          '
          )->setParameter('id',$id);
          $resultat=$query->execute();

          return $this->render('@Prof/prof/affabs.html.twig', array('find' => $resultat
              ));
    }

    public function allAction()
    {
        $student = $this->getDoctrine()->getManager()
            ->getRepository('ProfBundle:Abs')
            ->findAll();
        foreach ($student as $key => $blog){
            $datas[$key]['id'] = $blog->getId();
            $datas[$key]['matiere'] = $blog->getMatiere();
            $datas[$key]['classe'] = $blog->getClasse();
            $datas[$key]['date'] = $blog->getDate();
            $datas[$key]['hdep'] = $blog->getHdep();
            $datas[$key]['hfin'] = $blog->getHfin();


        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($datas);
        return new JsonResponse($formatted);
    }

}
