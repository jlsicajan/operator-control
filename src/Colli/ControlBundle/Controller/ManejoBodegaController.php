<?php

namespace Colli\ControlBundle\Controller;

use Colli\ControlBundle\Form\Type\bodegaType;
use Colli\ControlBundle\Form\Type\manejoBodegaType;
use Colli\ControlBundle\Model\BodegaPeer;
use Colli\ControlBundle\Model\BodegaQuery;
use Colli\ControlBundle\Model\CantonQuery;
use Colli\ControlBundle\Model\ControlBodegaPeer;
use Colli\ControlBundle\Model\ControlBodegaQuery;
use Colli\ControlBundle\Model\MaquinariaQuery;
use Colli\ControlBundle\Model\SectorQuery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ManejoBodegaController extends Controller {

  public function bodegaAction(Request $request) {
    $form = $this->createForm(new manejoBodegaType());
    if ($request->isMethod("POST")) {
      $form->handleRequest($request);
      if ($form->isValid()) {
        $valores = $form->getData();
        ControlBodegaQuery::write($valores['bodega']->getId(), $valores['fecha_retiro'], $valores['maquinaria']->getId(), $valores['fecha_ingreso'], $valores['canton']->getId(), $valores['sector']->getId());
        return $this->redirect($this->generateUrl('colli_control_bodega_manejo'));
      } else {
        $this->addFlash('Error', $form->getErrorsAsString());
      }
    }
    $bodega = ControlBodegaPeer::getListado(null);
    $context = array('control_bodega' => $bodega, 'form' => $form->createView());
    return $this->render('ColliControlBundle:General:manejo_bodega.html.twig', $context);
  }

  public function editBodegaAction($pk) {
    $consulta = ControlBodegaPeer::getUno($pk);
    $cantones = CantonQuery::create()
            ->find();
    $sectores = SectorQuery::create()
            ->find();
    $maquinaria = MaquinariaQuery::create()
            ->find();
    $bodega = BodegaQuery::create()
            ->find();
    $context = array('datos' => $consulta, 'cantones' => $cantones, 'sectores' => $sectores, 'maquinarias' => $maquinaria, 'bodegas' => $bodega);
    return $this->render('ColliControlBundle:General/Edit:manejo_bodega.html.twig', $context);
  }

  public function changeAction(Request $request, $id) {
    $datos = $request->request->all();
    $registro = ControlBodegaQuery::edit($id, $datos['bodega'], $datos['fecha_retiro'], $datos['maquinaria'], $datos['fecha_ingreso'], $datos['canton'], $datos['sector']);
    return $this->redirect($this->generateUrl('colli_control_bodega_manejo'));
  }

  public function eliminarAction($id) {
    $bodega = ControlBodegaPeer::delete($id);
    return $this->redirect($this->generateUrl('colli_control_bodega_manejo'));
  }

  public function crearPdfAction() {
    $bodega = ControlBodegaPeer::getListado(null);
    $context = array('bodega' => $bodega);
    $html = $this->renderView('ColliControlBundle:General/Reporte:manejo_bodega.html.twig', $context);
    $fname = 'ControlBodega_' . date("Ymd-His") . ".pdf";
    $pdf = $this->get('white_october.tcpdf')->create();
    $pdf->SetAuthor('Fabian Sicajan');
    $pdf->SetTitle('Control de bodega');
    $pdf->SetSubject('Control de bodega');
    $pdf->SetKeywords('Control de bodega');
    $pdf->setHeaderData('', 0, 'Control bodega', 'Bodega');
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
