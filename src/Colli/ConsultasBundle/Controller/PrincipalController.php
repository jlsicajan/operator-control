<?php

namespace Colli\ConsultasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PrincipalController extends Controller
{
    public function indexAction()
    {
        return $this->render('ConsultasBundle:Principal:index.html.twig');
    }
}
