<?php

namespace GestionBundle\Controller;

use Esprit\ApiBundle\Entity\Parent2;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ParentMController extends Controller
{
    public function allAction()
    {
        $parent= $this->getDoctrine()->getManager()
            ->getRepository('GestionBundle:Parent2')
            ->findAll();
        foreach ($parent as $key => $blog){
            $datas[$key]['id'] = $blog->getId();
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
        $parent = $this->getDoctrine()->getManager()
            ->getRepository('GestionBundle:Parent2')
            ->findBy(
                ['id' => $id]);
        foreach ($parent as $key => $blog){
            $datas[$key]['id'] = $blog->getId();
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
        $parent = new \GestionBundle\Entity\Parent2();
        $parent->setStudentid(3);
        $parent->setName($request->get('name'));
        $parent->setlogin($request->get('login'));
        $parent->setpassword($request->get('password'));
        $em->persist($parent);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($parent);
        return new JsonResponse($formatted);
    }
    public function removeSelectedAction(Request $request)
    {
        $id=$request->get('id');
        $em = $this->getDoctrine()->getManager();
        $parent = $em->getRepository("GestionBundle:Parent2")->find($id);
        $em->Remove($parent);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($parent);
        return new JsonResponse($formatted);
    }

    public function updateAction(Request $request,$id)
    {
        $std = $this->getDoctrine()->getRepository("GestionBundle:Parent2")->find($id);
        $std->setName($request->get("name"));
        $std->setLogin($request->get("login"));
        $std->setPassword($request->get("password"));
        $em = $this->getDoctrine()->getManager();
        $em->persist($std);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($std);
        return new JsonResponse($formatted);

    }

    public function updateSelectedAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $find = $this->getDoctrine()->getRepository("\"GestionBundle:ParentM")->find($id);
      //  $find->setDateRec(new \DateTime());
        $find->setMessage($request->get('message'));
        $em->persist($find);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($find);
        return new JsonResponse($formatted);
    }
}
