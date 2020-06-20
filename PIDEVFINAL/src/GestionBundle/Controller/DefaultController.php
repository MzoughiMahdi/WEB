<?php

namespace GestionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Gestion/Default/index.html.twig');
    }
    public function gestionAction()
    {
        return $this->render('@Gestion/Default/gestion.html.twig');
    }
   # public function loginAction()
    #{
     #   return $this->render('@Gestion/Default/login.html.twig');
   # }
    public function EtudientAction()
    {
        return $this->render('@Gestion/Default/Etudient.html.twig');
    }
    public function ParentAction()
    {
        return $this->render('@Gestion/Default/Parent.html.twig');
    }
    public function InscriptionAction()
    {
        return $this->render('@Gestion/Default/Inscription.html.twig');
    }
}
