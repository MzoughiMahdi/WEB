<?php

namespace GestionBundle\Controller;

use Esprit\GestionBundle\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class StudentMController extends Controller
{
    public function allAction()
    {
        $student = $this->getDoctrine()->getManager()
            ->getRepository('GestionBundle:Student')
            ->findAll();
        foreach ($student as $key => $blog){
            $datas[$key]['id'] = $blog->getId();
            $datas[$key]['dateofbirth'] = $blog->getDateofbirth()->format('Y-m-d');
            $datas[$key]['class'] = $blog->getClass();
            $datas[$key]['adress'] = $blog->getAdress();
            $datas[$key]['mail'] = $blog->getMail();
            $datas[$key]['sex'] = $blog->getSex();
            $datas[$key]['name'] = $blog->getName();
            $datas[$key]['login'] = $blog->getLogin();
            $datas[$key]['password'] = $blog->getPassword();

        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($datas);
        return new JsonResponse($formatted);
    }

    public function findAction($id)
    {
        $student = $this->getDoctrine()->getManager()
            ->getRepository('GestionBundle:Student')
            ->findBy(
                ['id' => $id]);
        foreach ($student as $key => $blog){
            $datas[$key]['id'] = $blog->getId();
            $datas[$key]['dateofbirth'] = $blog->getDateofbirth()->format('Y-m-d');
            $datas[$key]['class'] = $blog->getClass();
            $datas[$key]['adress'] = $blog->getAdress();
            $datas[$key]['mail'] = $blog->getMail();
            $datas[$key]['sex'] = $blog->getSex();
            $datas[$key]['name'] = $blog->getName();
            $datas[$key]['login'] = $blog->getLogin();
            $datas[$key]['password'] = $blog->getPassword();

        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($datas);
        return new JsonResponse($formatted);
    }

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Student = new \GestionBundle\Entity\Student();
       // $Student->setIdStudent($request->get('idStudent'));
        $Student->setDateofbirth(new \DateTime());
        $Student->setClass($request->get('classe'));
        $Student->setAdress($request->get('adress'));
        $Student->setMail($request->get('mail'));
        $Student->setSex($request->get('sex'));
        $Student->setName($request->get('name'));
        $Student->setLogin($request->get('login'));
        $Student->setPassword($request->get('password'));

        $em->persist($Student);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Student);
        return new JsonResponse($formatted);
    }
    public function updateSelectedAction(Request $request)
    {
        $id = $request->get('id');
        $find = $this->getDoctrine()->getManager()->getRepository("GestionBundle:Student")->find($id);
        //  $find->setDateRec(new \DateTime());
        $em = $this->getDoctrine()->getManager();
        $find->setMessage($request->get('Name'));
        $em->persist($find);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($find);
        return new JsonResponse($formatted);
    }

    public function ModifierStdAction(Request $request)
    {
        $std = $this->getDoctrine()->getRepository("GestionBundle:Student")->find($request->get("id"));
        $std->setLogin($request->get("login"));
        $std->setPassword($request->get("password"));
        $em = $this->getDoctrine()->getManager();
        $em->persist($std);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($std);
        return new JsonResponse($formatted);

    }

    public function removeSelectedAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $parent = $em->getRepository("GestionBundle:Student")->find($id);
        $em->Remove($parent);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($parent);
        return new JsonResponse($formatted);
    }
}
