<?php

namespace Colli\ControlBundle\Controller;

use Colli\ControlBundle\Form\Type\trabajadoresType;
use Colli\ControlBundle\Model\TrabajadorPeer;
use Colli\ControlBundle\Model\TrabajadorQuery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TrabajadoresController extends Controller {

  public function indexAction(Request $request) {
    $form = $this->createForm(new trabajadoresType());
    if ($request->isMethod("POST")) {
      $form->handleRequest($request);
      if ($form->isValid()) {
        $valores = $form->getData();
        TrabajadorQuery::write($valores['nombre']);
        return $this->redirect($this->generateUrl('colli_control_trabajadores'));
      } else {
        $this->addFlash('Error', $form->getErrorsAsString());
      }
    }
    $trabajadores = TrabajadorPeer::getListado();
    $context = array('trabajadores' => $trabajadores, 'form' => $form->createView());
    return $this->render('ColliControlBundle:General:trabajadores.html.twig', $context);
  }

  public function editTrabajadorAction($pk) {
    $consulta = TrabajadorPeer::getUno($pk);
    $context = array('datos' => $consulta);
    return $this->render('ColliControlBundle:General/Edit:trabajador.html.twig', $context);
  }

  public function changeAction(Request $request, $id) {
    $descripcion = $request->request->all();
    $registro = TrabajadorQuery::edit($id, $descripcion['nombre']);
    return $this->redirect($this->generateUrl('colli_control_trabajadores'));
  }


  public function eliminarAction($id) {
    $trabajador = TrabajadorPeer::delete($id);
    return $this->redirect($this->generateUrl('colli_control_trabajadores'));
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
