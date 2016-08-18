<?php

namespace Colli\ControlBundle\Model;

use Colli\ControlBundle\Model\om\BaseBodegaQuery;

class BodegaQuery extends BaseBodegaQuery {

  public static function write($equipo_id, $maquinaria_id, $cantidad, $precio, $estado) {
    $bodega = new Bodega();
    $bodega->setEquipoId($equipo_id);
    $bodega->setMaquinariaId($maquinaria_id);
    $bodega->setCantidad($cantidad);
    $bodega->setPrecio($precio);
    $bodega->setEstado($estado);
    $bodega->save();
  }

  public static function edit($id, $equipo_id, $maquinaria_id, $cantidad, $precio, $estado) {
    $bodega = BodegaQuery::create()
            ->findOneById($id);
    $bodega->setEquipoId($equipo_id);
    $bodega->setMaquinariaId($maquinaria_id);
    $bodega->setCantidad($cantidad);
    $bodega->setPrecio($precio);
    $bodega->setEstado($estado);
    $bodega->save();
  }

}
