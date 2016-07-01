<?php

namespace Colli\ControlBundle\Controller;

use Colli\ControlBundle\Form\Type\maquinariaType;
use Colli\ControlBundle\Model\MaquinariaPeer;
use Colli\ControlBundle\Model\MaquinariaQuery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MaquinariaController extends Controller {

  public function maquinariaAction(Request $request) {
    $form = $this->createForm(new maquinariaType());
    if ($request->isMethod("POST")) {
      $form->handleRequest($request);
      if ($form->isValid()) {
        $valores = $form->getData();
        MaquinariaQuery::write($valores['descripcion'], $valores['numero']);
        return $this->redirect($this->generateUrl('colli_control_maquinaria'));
      } else {
        $this->addFlash('Error', $form->getErrorsAsString());
      }
    }
    $maquinarias = MaquinariaPeer::getListado(null);
    $context = array('maquinarias' => $maquinarias, 'form' => $form->createView());
    return $this->render('ColliControlBundle:General:maquinaria.html.twig', $context);
  }

  public function editMaquinariaAction($pk) {
    $consulta = MaquinariaPeer::getUno($pk);
    $context = array('datos' => $consulta);
    return $this->render('ColliControlBundle:General/Edit:maquinaria.html.twig', $context);
  }

  public function changeAction(Request $request, $id) {
    $descripcion = $request->request->all();
    $registro = MaquinariaQuery::edit($id, $descripcion['descripcion'], $descripcion['numero']);
    return $this->redirect($this->generateUrl('colli_control_maquinaria'));
  }

  public function eliminarAction($id) {
    $maquinaria = MaquinariaPeer::delete($id);
    return $this->redirect($this->generateUrl('colli_control_maquinaria'));
  }

  public function crearPdfAction() {
    $maquinarias = MaquinariaPeer::getListado(null);
    $context = array('maquinarias' => $maquinarias);
    $html = $this->renderView('ColliControlBundle:General/Reporte:maquinaria.html.twig', $context);
    $fname = 'Maquinarias_' . date("Ymd-His") . ".pdf";
    $pdf = $this->get('white_october.tcpdf')->create();
    $pdf->SetAuthor('Fabian Sicajan');
    $pdf->SetTitle('Listado de maquinaria');
    $pdf->SetSubject('Maquinaria');
    $pdf->SetKeywords('Maquinaria');
    $pdf->setHeaderData('', 0, 'Maquinaria', 'Listado de maquinaria');
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
