<?php

namespace Colli\ControlBundle\Model;

use Colli\ControlBundle\Model\om\BaseCantonQuery;

class CantonQuery extends BaseCantonQuery {

  public static function write($descripcion) {
    $canton = new Canton();
    $canton->setDescripcion($descripcion);
    $canton->save();
  }

}
