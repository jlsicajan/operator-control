<?php

namespace Colli\ControlBundle\Controller;

use Colli\ControlBundle\Form\Type\cantonType;
use Colli\ControlBundle\Model\CantonPeer;
use Colli\ControlBundle\Model\CantonQuery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CantonController extends Controller {

  public function indexAction() {
    return $this->render('ColliControlBundle:General:index.html.twig');
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
    return $this->render('ColliControlBundle:General:canton.html.twig', $context);
  }

  public function editCantonAction($pk) {
    $consulta = CantonPeer::getUno($pk);
    $context = array('datos' => $consulta);
    return $this->render('ColliControlBundle:General/Edit:canton.html.twig', $context);
  }

  public function changeAction(Request $request, $pk) {
    $descripcion = $request->request->all();
    $registro = CantonQuery::edit($pk, $descripcion['edit']['proceso']);
    return $this->redirect($this->generateUrl('colli_control_canton'));
  }

  public function eliminarAction($id) {
    $canton = CantonPeer::delete($id);
    return $this->redirect($this->generateUrl('colli_control_canton'));
  }

  public function crearPdfAction() {
    $cantones = CantonPeer::getListado(null);
    $context = array('cantones' => $cantones);
    $html = $this->renderView('ColliControlBundle:General/Reporte:canton.html.twig', $context);
    $fname = 'Cantones_' . date("Ymd-His") . ".pdf";
    $pdf = $this->get('white_october.tcpdf')->create();
    $pdf->SetAuthor('Fabian Sicajan');
    $pdf->SetTitle('Listado de cantones');
    $pdf->SetSubject('Cantones');
    $pdf->SetKeywords('Cantones');
    $pdf->setHeaderData('', 0, 'Cantones', 'Listado de cantones');
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
