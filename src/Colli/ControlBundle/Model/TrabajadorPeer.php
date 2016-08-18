<?php

namespace Colli\ControlBundle\Model;

use Colli\ControlBundle\Model\om\BaseTrabajadorPeer;

class TrabajadorPeer extends BaseTrabajadorPeer {

  public static function getListado() {
    $trabajadores = TrabajadorQuery::create()
            ->find();
    return $trabajadores;
  }

  public static function getUno($id) {
    $trabajadores = TrabajadorQuery::create()
            ->filterById($id)
            ->findOne();
    return $trabajadores;
  }

  public static function delete($id) {
    $trabajadores = TrabajadorQuery::create()->findOneById($id);
    $trabajadores->delete();
  }

}
