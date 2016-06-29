<?php

namespace Colli\ControlBundle\Model;

use Colli\ControlBundle\Model\om\BaseSectorPeer;

class SectorPeer extends BaseSectorPeer {

  public static function getListado($id, $nombre, $ancho, $largo, $canton_id) {
    $sectores = SectorQuery::create()
            ->_if($id != null)
            ->filterById($id)
            ->_endif()
            ->_if($nombre != null)
            ->filterByNombre($nombre)
            ->_endif()
            ->_if($ancho != null)
            ->filterByAncho($ancho)
            ->_endif()
            ->_if($largo != null)
            ->filterByLargo($largo)
            ->_endif()
            ->_if($canton_id != null)
            ->filterByCantonId($canton_id)
            ->_endif()
            ->find();
    return $sectores;
  }

  public static function getUno($id) {
    $sector = SectorQuery::create()
            ->filterById($id)
            ->findOne();
    return $sector;
  }

  public static function delete($id) {
    $sector = SectorQuery::create()->findOneById($id);
    $sector->delete();
  }

}
