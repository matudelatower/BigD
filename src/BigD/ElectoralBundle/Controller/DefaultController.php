<?php

namespace BigD\ElectoralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ElectoralBundle:Default:index.html.twig', array('name' => $name));
    }
}
