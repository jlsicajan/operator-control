<?php

namespace Colli\ControlBundle\Controller;

use Colli\ControlBundle\Form\Type\trabajadoresControlType;
use Colli\ControlBundle\Model\TrabajadorControlPeer;
use Colli\ControlBundle\Model\TrabajadorControlQuery;
use Colli\ControlBundle\Model\TrabajadorPeer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TrabajadoresControlController extends Controller {

  public function indexAction(Request $request) {
    $form = $this->createForm(new trabajadoresControlType());
    if ($request->isMethod("POST")) {
      $form->handleRequest($request);
      if ($form->isValid()) {
        $valores = $form->getData();
        $time = strtotime($valores['fecha']);
        $newformat = date('d-m-Y', $time);
        TrabajadorControlQuery::write($newformat, $valores['trabajador']->getId(), $valores['trabajo_realizado']);
        return $this->redirect($this->generateUrl('colli_control_trabajadores_control'));
      } else {
        $this->addFlash('Error', $form->getErrorsAsString());
      }
    }
    $trabajadores = TrabajadorControlPeer::getListado();
    $context = array('trabajadores_control' => $trabajadores, 'form' => $form->createView());
    return $this->render('ColliControlBundle:General:trabajadores_control.html.twig', $context);
  }

  public function editTrabajadorAction($id) {
    $consulta = TrabajadorControlPeer::getUno($id);
    $trabajadores = TrabajadorPeer::getListado();
    $context = array('datos' => $consulta, 'trabajadores' => $trabajadores);
    return $this->render('ColliControlBundle:General/Edit:trabajador_control.html.twig', $context);
  }

  public function changeAction(Request $request, $id) {
    $descripcion = $request->request->all();
    $time = strtotime($descripcion['fecha']);
    $newformat = date('d-m-Y', $time);
    $registro = TrabajadorControlQuery::edit($id, $newformat, $descripcion['id_trabajador'], $descripcion['tarea']);
    return $this->redirect($this->generateUrl('colli_control_trabajadores_control'));
  }

  public function eliminarAction($id) {
    $trabajador = TrabajadorControlPeer::delete($id);
    return $this->redirect($this->generateUrl('colli_control_trabajadores_control'));
  }

  public function crearPdfAction() {
    $trabajadores = TrabajadorPeer::getListado(null);
    $context = array('trabajadores' => $trabajadores);
    $html = $this->renderView('ColliControlBundle:General/Reporte:trabajadores.html.twig', $context);
    $fname = 'Trabajadores_' . date("Ymd-His") . ".pdf";
    $pdf = $this->get('white_october.tcpdf')->create();
    $pdf->SetAuthor('Fabian Sicajan');
    $pdf->SetTitle('Trabajadores');
    $pdf->SetSubject('Trabajadores');
    $pdf->SetKeywords('Trabajadores');
    $pdf->setHeaderData('', 0, 'Trabajadores', 'Trabajadores');
    $pdf->setHeaderMargin(4);
    $pdf->setTopMargin(18);
    $pdf->AddPage('L');
    $pdf->setFont('Freesans', 'N', 8);
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->lastPage();
    $response = new Response($pdf->Output($fname, 'D'));
    $response->headers->set('Content-Type', 'application/pdf');
    return $response;
  }

}
