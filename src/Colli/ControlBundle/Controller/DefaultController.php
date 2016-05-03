<?php

namespace Colli\ControlBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

  public function indexAction() {
    return $this->render('ColliControlBundle:Default:index.html.twig');
  }

  public function cantonAction(){
    return $this->render('ColliControlBundle:Default:canton.html.twig');
  }

  public function sectorAction(){
    return $this->render('ColliControlBundle:Default:sector.html.twig');
  }
}
