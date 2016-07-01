<?php

namespace Colli\ControlBundle\Model;

use Colli\ControlBundle\Model\om\BaseBodegaQuery;

class BodegaQuery extends BaseBodegaQuery {

  public static function write($descripcion, $cantidad, $precio) {
    $bodega = new Bodega();
    $bodega->setDescripcion($descripcion);
    $bodega->setCantidad($cantidad);
    $bodega->setPrecio($precio);
    $bodega->save();
  }

  public static function edit($id, $descripcion, $cantidad, $precio) {
    $bodega = BodegaQuery::create()
            ->findOneById($id);
    $bodega->setDescripcion($descripcion);
    $bodega->setCantidad($cantidad);
    $bodega->setPrecio($precio);
    $bodega->save();
  }

}
