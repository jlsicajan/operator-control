<?php

namespace Colli\ControlBundle\Model;

use Colli\ControlBundle\Model\om\BaseMaquinariaPeer;

class MaquinariaPeer extends BaseMaquinariaPeer {

  public static function getListado($id) {
    $maquinarias = MaquinariaQuery::create()
            ->_if($id != null)
            ->filterById($id)
            ->_endif()
            ->find();
    return $maquinarias;
  }

  public static function getUno($id) {
    $maquinarias = MaquinariaQuery::create()
            ->filterById($id)
            ->findOne();
    return $maquinarias;
  }

  public static function delete($id) {
    $maquinaria = MaquinariaQuery::create()->findOneById($id);
    $maquinaria->delete();
  }

}
