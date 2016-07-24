<?php

namespace Colli\ControlBundle\Model;

use Colli\ControlBundle\Model\om\BaseEquipoPeer;

class EquipoPeer extends BaseEquipoPeer {

  public static function getListado($id) {
    $equipo = EquipoQuery::create()
            ->_if($id != null)
            ->filterById($id)
            ->_endif()
            ->find();
    return $equipo;
  }

  public static function getUno($id) {
    $equipo = EquipoQuery::create()
            ->filterById($id)
            ->findOne();
    return $equipo;
  }

  public static function delete($id) {
    $equipo = EquipoQuery::create()->findOneById($id);
    $equipo->delete();
  }

}
