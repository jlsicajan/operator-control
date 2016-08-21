<?php

namespace Colli\ControlBundle\Model;

use Colli\ControlBundle\Model\om\BaseTrabajadorControlPeer;

class TrabajadorControlPeer extends BaseTrabajadorControlPeer {

  public static function getListado() {
    $trabajadores = TrabajadorControlQuery::create()
            ->find();
    return $trabajadores;
  }

  public static function getUno($id) {
    $trabajadores = TrabajadorControlQuery::create()
            ->filterById($id)
            ->findOne();
    return $trabajadores;
  }

  public static function delete($id) {
    $trabajadores = TrabajadorControlQuery::create()->findOneById($id);
    $trabajadores->delete();
  }

}
