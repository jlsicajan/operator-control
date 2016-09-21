<?php

namespace Colli\ControlBundle\Model;

use Colli\ControlBundle\Model\om\BaseControlPeer;

class ControlPeer extends BaseControlPeer {

  public static function getListado($id) {
    $control = ControlQuery::create()
            ->_if($id != null)
            ->filterById($id)
            ->_endif()
            ->find();
    return $control;
  }

  public static function getUno($id) {
    $control = ControlQuery::create()
            ->filterById($id)
            ->findOne();
    return $control;
  }

  public static function delete($id) {
    $control = ControlQuery::create()->findOneById($id);
    $control->delete();
  }

}
