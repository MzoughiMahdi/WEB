<?php


namespace AppBundle\Controller;
use ProfBundle\Entity\Prof;
use ProfBundle\Entity\Abs;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{

    public function RedirectAction()
    {
        $authChecker=$this->container->get('security.authorization_checker');
        if ($authChecker->isGranted('ROLE_ADMIN')){
            return $this->render('@Prof/prof/homep.html.twig');
        }
        elseif ($authChecker->isGranted('ROLE_PROF'))
        {
            return $this->render('@Prof/prof/homea.html.twig');
        }
        elseif ($authChecker->isGranted('ROLE_STUDIENT'))
        {
            return $this->render('@Prof/prof/homes.html.twig');
        }
        elseif ($authChecker->isGranted('ROLE_PARENT'))
        {
            return $this->render('@Prof/prof/homeparent.html.twig');
        }
        else{
            return $this->render('@FOSUser/layout.html.twig');
        }



    }

}
