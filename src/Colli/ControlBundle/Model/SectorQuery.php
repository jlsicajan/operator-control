<?php

namespace Colli\ControlBundle\Model;

use Colli\ControlBundle\Model\om\BaseSectorQuery;

class SectorQuery extends BaseSectorQuery {

  public static function write($descripcion, $ancho, $unidad_ancho, $unidad_largo, $largo, $canton_id) {
    $sector = new Sector();
    $sector->setDescripcion($descripcion);
    $sector->setAncho($ancho);
    $sector->setMedidaAncho($unidad_ancho);
    $sector->setMedidaLargo($unidad_largo);
    $sector->setLargo($largo);
    $sector->setCantonId($canton_id);
    $sector->save();
  }

  public static function edit($id, $descripcion, $ancho, $unidad_ancho, $unidad_largo, $largo, $canton_id) {
    $sector = SectorQuery::create()
            ->findOneById($id);
    $sector->setDescripcion($descripcion);
    $sector->setAncho($ancho);
    $sector->setLargo($largo);
    $sector->setMedidaAncho($unidad_ancho);
    $sector->setMedidaLargo($unidad_largo);
    $sector->setCantonId($canton_id);
    $sector->save();
  }

}
