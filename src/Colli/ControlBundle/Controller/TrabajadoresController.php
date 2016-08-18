<?php

namespace Colli\ControlBundle\Controller;

use Colli\ControlBundle\Form\Type\trabajadoresType;
use Colli\ControlBundle\Model\TrabajadorPeer;
use Colli\ControlBundle\Model\TrabajadorQuery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
    $bodega = BodegaPeer::getListado(null);
    $context = array('bodega' => $bodega);
    $html = $this->renderView('ColliControlBundle:General/Reporte:bodega.html.twig', $context);
    $fname = 'Bodega_' . date("Ymd-His") . ".pdf";
    $pdf = $this->get('white_october.tcpdf')->create();
    $pdf->SetAuthor('Fabian Sicajan');
    $pdf->SetTitle('Bodega');
    $pdf->SetSubject('Bodega');
    $pdf->SetKeywords('Bodega');
    $pdf->setHeaderData('', 0, 'Bodega', 'Bodega');
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
