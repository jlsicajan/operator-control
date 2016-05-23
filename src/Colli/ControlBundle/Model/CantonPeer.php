<?php

namespace Colli\ControlBundle\Model;

use Colli\ControlBundle\Model\om\BaseCantonPeer;

class CantonPeer extends BaseCantonPeer {

  public static function getListado($id) {
    $cantones = CantonQuery::create()
            ->_if($id != null)
            ->filterById($id)
            ->_endif()
            ->find();
    return $cantones;
  }

  public static function getUno($id) {
    $cantones = CantonQuery::create()
            ->filterById($id)
            ->findOne();
    return $cantones;
  }

  public static function delete($id) {
    $canton = CantonQuery::create()->findOneById($id);
    $canton->delete();
  }

}
