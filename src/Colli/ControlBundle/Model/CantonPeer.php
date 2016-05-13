<?php

namespace Colli\ControlBundle\Model;

use Colli\ControlBundle\Model\om\BaseCantonPeer;

class CantonPeer extends BaseCantonPeer {

  public static function getListado($id) {
    $cantones = CantonQuery::create()
//            ->filterById($id)
            ->find();
    return $cantones;
  }

}
