<?php

namespace Colli\ControlBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'control' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.src.Colli.ControlBundle.Model.map
 */
class ControlTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Colli.ControlBundle.Model.map.ControlTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('control');
        $this->setPhpName('Control');
        $this->setClassname('Colli\\ControlBundle\\Model\\Control');
        $this->setPackage('src.Colli.ControlBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('canton_id', 'CantonId', 'INTEGER', 'canton', 'id', true, 11, null);
        $this->addForeignKey('sector_id', 'SectorId', 'INTEGER', 'sector', 'id', true, 11, null);
        $this->addColumn('cantidad_camionadas_sector', 'CantidadCamionadasSector', 'VARCHAR', true, 50, null);
        $this->addColumn('precio_diesel_sector', 'PrecioDieselSector', 'VARCHAR', true, 50, null);
        $this->addColumn('galones_diesel_sector', 'GalonesDieselSector', 'VARCHAR', true, 50, null);
        $this->addColumn('dias_cantidad_sector', 'DiasCantidadSector', 'VARCHAR', true, 50, null);
        $this->addColumn('horas_diarias_sector', 'HorasDiariasSector', 'VARCHAR', true, 50, null);
        $this->addColumn('horas_total_sector', 'HorasTotalSector', 'VARCHAR', false, 50, null);
        $this->addColumn('grosor_balasto_sector', 'GrosorBalastoSector', 'VARCHAR', false, 50, null);
        $this->addColumn('repacarion_sector', 'RepacarionSector', 'VARCHAR', false, 50, null);
        $this->addForeignKey('maquinaria_id', 'MaquinariaId', 'VARCHAR', 'maquinaria', 'id', false, 50, null);
        $this->addForeignKey('bodega_id', 'BodegaId', 'VARCHAR', 'bodega', 'id', false, 50, null);
        $this->addColumn('observaciones', 'Observaciones', 'VARCHAR', false, 50, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Canton', 'Colli\\ControlBundle\\Model\\Canton', RelationMap::MANY_TO_ONE, array('canton_id' => 'id', ), null, null);
        $this->addRelation('Sector', 'Colli\\ControlBundle\\Model\\Sector', RelationMap::MANY_TO_ONE, array('sector_id' => 'id', ), null, null);
        $this->addRelation('Maquinaria', 'Colli\\ControlBundle\\Model\\Maquinaria', RelationMap::MANY_TO_ONE, array('maquinaria_id' => 'id', ), null, null);
        $this->addRelation('Bodega', 'Colli\\ControlBundle\\Model\\Bodega', RelationMap::MANY_TO_ONE, array('bodega_id' => 'id', ), null, null);
    } // buildRelations()

} // ControlTableMap
