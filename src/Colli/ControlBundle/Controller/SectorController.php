<?php

namespace Colli\ControlBundle\Controller;

use Colli\ControlBundle\Form\Type\sectorType;
use Colli\ControlBundle\Model\CantonQuery;
use Colli\ControlBundle\Model\SectorPeer;
use Colli\ControlBundle\Model\SectorQuery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SectorController extends Controller {

  public function sectorAction(Request $request) {
    $form = $this->createForm(new sectorType());
    if ($request->isMethod("POST")) {
      $form->handleRequest($request);
      if ($form->isValid()) {
        $valores = $form->getData();
        SectorQuery::write($valores['descripcion'], $valores['ancho'], $valores['unidad_ancho'], 
                $valores['unidad_largo'], $valores['largo'], $valores['canton']->getId());
        return $this->redirect($this->generateUrl('colli_control_sectores'));
      } else {
        $this->addFlash('Error', $form->getErrorsAsString());
      }
    }
    $sectores = SectorPeer::getListado(NULL, NULL, NULL, NULL, NULL);
    $context = array('sectores' => $sectores, 'form' => $form->createView());
    return $this->render('ColliControlBundle:General:sector.html.twig', $context);
  }

  public function editSectorAction($pk) {
    $consulta = SectorPeer::getUno($pk);
    $cantones = CantonQuery::create()
            ->find();
    $context = array('datos' => $consulta, 'cantones' => $cantones);
    return $this->render('ColliControlBundle:General/Edit:sector.html.twig', $context);
  }

  public function changeAction(Request $request, $id) {
    $cambios = $request->request->all();
    SectorQuery::edit($id, $cambios['descripcion'], $cambios['ancho'], 
            $cambios['unidad_ancho'], $cambios['unidad_largo'], $cambios['largo'], $cambios['canton']);
    return $this->redirect($this->generateUrl('colli_control_sectores'));
  }

  public function eliminarAction($id) {
    $sector = SectorPeer::delete($id);
    return $this->redirect($this->generateUrl('colli_control_sectores'));
  }

  public function crearPdfAction() {
    $sectores = SectorPeer::getListado(NULL, NULL, NULL, NULL, NULL);
    $context = array('sectores' => $sectores);
    $html = $this->renderView('ColliControlBundle:General/Reporte:sector.html.twig', $context);
    $fname = 'Sectores_' . date("Ymd-His") . ".pdf";
    $pdf = $this->get('white_october.tcpdf')->create();
    $pdf->SetAuthor('Fabian Sicajan');
    $pdf->SetTitle('Listado de sectores');
    $pdf->SetSubject('Sectores');
    $pdf->SetKeywords('Sectores');
    $pdf->setHeaderData('', 0, 'Sectores', 'Listado de sectores');
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
