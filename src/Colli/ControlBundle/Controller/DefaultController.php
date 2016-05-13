<?php

namespace Colli\ControlBundle\Controller;

use Colli\ControlBundle\Form\Type\cantonType;
use Colli\ControlBundle\Model\CantonPeer;
use Colli\ControlBundle\Model\CantonQuery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

  public function indexAction() {
    return $this->render('ColliControlBundle:Default:index.html.twig');
  }

  public function cantonAction(Request $request) {
    $form = $this->createForm(new cantonType());
    if ($request->isMethod("POST")) {
      $form->handleRequest($request);
      if ($form->isValid()) {
        $valores = $form->getData();
        CantonQuery::write($valores['descripcion']);
        $cantones = CantonPeer::getListado(null);
        return $this->redirect($this->generateUrl('colli_control_canton'));
      } else {
        $this->addFlash('Error', $form->getErrorsAsString());
      }
    }
    $cantones = CantonPeer::getListado(null);
    $context = array('cantones' => $cantones, 'form' => $form->createView());
    return $this->render('ColliControlBundle:Default:canton.html.twig', $context);
  }

  public function sectorAction() {
    return $this->render('ColliControlBundle:Default:sector.html.twig');
  }

}
