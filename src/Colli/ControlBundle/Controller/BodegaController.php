<?php

namespace Colli\ControlBundle\Controller;

use Colli\ControlBundle\Form\Type\bodegaType;
use Colli\ControlBundle\Model\BodegaPeer;
use Colli\ControlBundle\Model\BodegaQuery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BodegaController extends Controller {

  public function bodegaAction(Request $request) {
    $form = $this->createForm(new bodegaType());
    if ($request->isMethod("POST")) {
      $form->handleRequest($request);
      if ($form->isValid()) {
        $valores = $form->getData();
        if (isset($valores['maquinaria'])) {
          $maquinaria = $valores['maquinaria']->getId();
        } else {
          $maquinaria = null;
        }
        BodegaQuery::write($valores['equipo']->getId(), $maquinaria, $valores['cantidad'], $valores['precio'], $valores['estado']);
        return $this->redirect($this->generateUrl('colli_control_bodega'));
      } else {
        $this->addFlash('Error', $form->getErrorsAsString());
      }
    }
    $bodega = BodegaPeer::getListado(null);
    $context = array('bodega' => $bodega, 'form' => $form->createView());
    return $this->render('ColliControlBundle:General:bodega.html.twig', $context);
  }

  public function editBodegaAction($pk) {
    $consulta = BodegaPeer::getUno($pk);
    $context = array('datos' => $consulta);
    return $this->render('ColliControlBundle:General/Edit:bodega.html.twig', $context);
  }

  public function changeAction(Request $request, $id) {
    $descripcion = $request->request->all();
    $registro = BodegaQuery::edit($id, $descripcion['equipo']->getId(), $descripcion['maquinaria']->getId(), $descripcion['cantidad'], $descripcion['precio'], $descripcion['estado']);
    return $this->redirect($this->generateUrl('colli_control_bodega'));
  }

  public function eliminarAction($id) {
    $bodega = BodegaPeer::delete($id);
    return $this->redirect($this->generateUrl('colli_control_bodega'));
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
