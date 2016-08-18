<?php

namespace Colli\ControlBundle\Model;

use Colli\ControlBundle\Model\om\BaseControlBodegaPeer;

class ControlBodegaPeer extends BaseControlBodegaPeer {

  public static function getListado($id) {
    $bodega = ControlBodegaQuery::create()
            ->_if($id != null)
            ->filterById($id)
            ->_endif()
            ->find();
    return $bodega;
  }

  public static function getUno($id) {
    $bodega = ControlBodegaQuery::create()
            ->filterById($id)
            ->findOne();
    return $bodega;
  }

  public static function delete($id) {
    $bodega = ControlBodegaQuery::create()->findOneById($id);
    $bodega->delete();
  }

}
