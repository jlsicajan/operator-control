<?php

namespace Colli\ControlBundle\Controller;

use Colli\ControlBundle\Form\Type\equipoType;
use Colli\ControlBundle\Model\EquipoPeer;
use Colli\ControlBundle\Model\EquipoQuery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EquipoController extends Controller {

  public function equipoAction(Request $request) {
    $form = $this->createForm(new equipoType());
    if ($request->isMethod("POST")) {
      $form->handleRequest($request);
      if ($form->isValid()) {
        $valores = $form->getData();
        EquipoQuery::write($valores['descripcion']);
        return $this->redirect($this->generateUrl('colli_control_equipo'));
      } else {
        $this->addFlash('Error', $form->getErrorsAsString());
      }
    }
    $equipo = EquipoPeer::getListado(null);
    $context = array('equipos' => $equipo, 'form' => $form->createView());
    return $this->render('ColliControlBundle:General:equipo.html.twig', $context);
  }

  public function editBodegaAction($pk) {
    $consulta = EquipoPeer::getUno($pk);
    $context = array('datos' => $consulta);
    return $this->render('ColliControlBundle:General/Edit:equipo.html.twig', $context);
  }

  public function changeAction(Request $request, $id) {
    $descripcion = $request->request->all();
    $registro = EquipoQuery::edit($id, $descripcion['descripcion']);
    return $this->redirect($this->generateUrl('colli_control_equipo'));
  }

  public function eliminarAction($id) {
    $equipo = EquipoPeer::delete($id);
    return $this->redirect($this->generateUrl('colli_control_equipo'));
  }

}
