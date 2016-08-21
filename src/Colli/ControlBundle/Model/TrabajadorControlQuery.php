<?php

namespace Colli\ControlBundle\Model;

use Colli\ControlBundle\Model\om\BaseTrabajadorControlQuery;

class TrabajadorControlQuery extends BaseTrabajadorControlQuery {

  public static function write($fecha, $trabajador_id, $trabajo_realizado) {
    $trabajador = new TrabajadorControl();
    $trabajador->setFechaIngreso($fecha);
    $trabajador->setTrabajadorId($trabajador_id);
    $trabajador->setTarea($trabajo_realizado);
    $trabajador->save();
  }

  public static function edit($id, $fecha, $trabajador_id, $trabajo_realizado) {
    $trabajador = TrabajadorControlQuery::create()
            ->findOneById($id);
    $trabajador->setFechaIngreso($fecha);
    $trabajador->setTrabajadorId($trabajador_id);
    $trabajador->setTarea($trabajo_realizado);
    $trabajador->save();
  }

}
