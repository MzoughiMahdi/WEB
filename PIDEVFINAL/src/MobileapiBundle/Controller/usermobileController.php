<?php

namespace MobileapiBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
class usermobileController extends Controller
{

    public function AllUsersAction()
    {


        $users = $this->getDoctrine()->getManager()->getRepository("UserBundle:User")->findAll();
        $serializer = new Serializer( [new ObjectNormalizer()]);
        $formated = $serializer->normalize($users);
        return new JsonResponse($formated);
    }



  
   

    















}
