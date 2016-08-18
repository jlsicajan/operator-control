<?php

namespace Colli\ControlBundle\Model;

use Colli\ControlBundle\Model\om\BaseTrabajadorQuery;

class TrabajadorQuery extends BaseTrabajadorQuery {

  public static function write($descripcion) {
    $trabajador = new Trabajador();
    $trabajador->setNombre($descripcion);
    $trabajador->save();
  }

  public static function edit($id, $descripcion) {
    $trabajador = TrabajadorQuery::create()
            ->findOneById($id);
    $trabajador->setNombre($descripcion);
    $trabajador->save();
  }

}
