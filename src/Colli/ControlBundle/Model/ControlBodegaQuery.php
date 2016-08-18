<?php

namespace Colli\ControlBundle\Model;

use Colli\ControlBundle\Model\om\BaseControlBodegaQuery;

class ControlBodegaQuery extends BaseControlBodegaQuery {

  public static function write($bodega_id, $fecha_retiro, $maquinaria_id, $fecha_ingreso, $canton_id, $sector_id) {
    $c_bodega = new ControlBodega();
    $c_bodega->setBodegaId($bodega_id);
    $c_bodega->setFechaRetiro($fecha_retiro);
    $c_bodega->setMaquinariaId($maquinaria_id);
    $c_bodega->setFechaIngreso($fecha_ingreso);
    $c_bodega->setCantonId($canton_id);
    $c_bodega->setSectorId($sector_id);
    $c_bodega->save();
  }

  public static function edit($id, $bodega_id, $fecha_retiro, $maquinaria_id, $fecha_ingreso, $canton_id, $sector_id) {
    $c_bodega = ControlBodegaQuery::create()
            ->findOneById($id);
    $c_bodega->setBodegaId($bodega_id);
    $c_bodega->setFechaRetiro($fecha_retiro);
    $c_bodega->setMaquinariaId($maquinaria_id);
    $c_bodega->setFechaIngreso($fecha_ingreso);
    $c_bodega->setCantonId($canton_id);
    $c_bodega->setSectorId($sector_id);
    $c_bodega->save();
  }

}
