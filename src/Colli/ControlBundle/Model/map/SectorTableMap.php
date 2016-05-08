<?php

namespace Colli\ControlBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'sector' table.
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
class SectorTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Colli.ControlBundle.Model.map.SectorTableMap';

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
        $this->setName('sector');
        $this->setPhpName('Sector');
        $this->setClassname('Colli\\ControlBundle\\Model\\Sector');
        $this->setPackage('src.Colli.ControlBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('descripcion', 'Descripcion', 'VARCHAR', true, 50, null);
        $this->addColumn('ancho', 'Ancho', 'INTEGER', true, 11, null);
        $this->addColumn('largo', 'Largo', 'INTEGER', true, 11, null);
        $this->addColumn('unidad_medida', 'UnidadMedida', 'VARCHAR', true, 50, null);
        $this->addForeignKey('canton_id', 'CantonId', 'INTEGER', 'canton', 'id', true, 11, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Canton', 'Colli\\ControlBundle\\Model\\Canton', RelationMap::MANY_TO_ONE, array('canton_id' => 'id', ), null, null);
        $this->addRelation('ControlBodega', 'Colli\\ControlBundle\\Model\\ControlBodega', RelationMap::ONE_TO_MANY, array('id' => 'sector_id', ), null, null, 'ControlBodegas');
        $this->addRelation('Control', 'Colli\\ControlBundle\\Model\\Control', RelationMap::ONE_TO_MANY, array('id' => 'sector_id', ), null, null, 'Controls');
    } // buildRelations()

} // SectorTableMap
