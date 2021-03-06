<?php

namespace Colli\ControlBundle\Model;

use Colli\ControlBundle\Model\om\BaseCantonQuery;

class CantonQuery extends BaseCantonQuery {

  public static function write($descripcion) {
    $canton = new Canton();
    $canton->setDescripcion($descripcion);
    $canton->save();
  }
  
  public static function edit($id, $descripcion){
    $canton = CantonQuery::create()
            ->findOneById($id);
    $canton->setDescripcion($descripcion);
    $canton->save();
  }

}
