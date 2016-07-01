<?php

namespace Colli\ControlBundle\Model;

use Colli\ControlBundle\Model\om\BaseBodegaPeer;

class BodegaPeer extends BaseBodegaPeer {

  public static function getListado($id) {
    $bodega = BodegaQuery::create()
            ->_if($id != null)
            ->filterById($id)
            ->_endif()
            ->find();
    return $bodega;
  }

  public static function getUno($id) {
    $bodega = BodegaQuery::create()
            ->filterById($id)
            ->findOne();
    return $bodega;
  }

  public static function delete($id) {
    $bodega = BodegaQuery::create()->findOneById($id);
    $bodega->delete();
  }

}
