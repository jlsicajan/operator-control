<?php

namespace Colli\ControlBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

  public function indexAction() {
    return $this->render('ColliControlBundle:Default:index.html.twig');
  }

}
