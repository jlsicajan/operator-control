<?php

namespace Colli\ControlBundle\Model;

use Colli\ControlBundle\Model\om\BaseMaquinariaQuery;

class MaquinariaQuery extends BaseMaquinariaQuery {

  public static function write($descripcion, $numero) {
    $maquinaria = new Maquinaria();
    $maquinaria->setDescripcion($descripcion);
    $maquinaria->setNumero($numero);
    $maquinaria->save();
  }

  public static function edit($id, $descripcion, $numero) {
    $maquinaria = MaquinariaQuery::create()
            ->findOneById($id);
    $maquinaria->setDescripcion($descripcion);
    $maquinaria->setNumero($numero);
    $maquinaria->save();
  }

}
