<?php

namespace Colli\ControlBundle\Model;

use Colli\ControlBundle\Model\om\BaseEquipoQuery;

class EquipoQuery extends BaseEquipoQuery {

  public static function write($descripcion) {
    $equipo = new Equipo();
    $equipo->setDescripcion($descripcion);
    $equipo->save();
  }

  public static function edit($id, $descripcion) {
    $equipo = EquipoQuery::create()
            ->findOneById($id);
    $equipo->setDescripcion($descripcion);
    $equipo->save();
  }

}
