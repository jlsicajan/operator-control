<?php

namespace Colli\ControlBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SectorController extends Controller {

  public function sectorAction() {
    return $this->render('ColliControlBundle:Default:sector.html.twig');
  }

}
