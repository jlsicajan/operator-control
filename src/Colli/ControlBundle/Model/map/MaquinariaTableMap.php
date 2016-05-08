<?php

namespace Colli\ControlBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'maquinaria' table.
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
class MaquinariaTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Colli.ControlBundle.Model.map.MaquinariaTableMap';

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
        $this->setName('maquinaria');
        $this->setPhpName('Maquinaria');
        $this->setClassname('Colli\\ControlBundle\\Model\\Maquinaria');
        $this->setPackage('src.Colli.ControlBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('descripcion', 'Descripcion', 'VARCHAR', true, 50, null);
        $this->getColumn('descripcion', false)->setPrimaryString(true);
        $this->addColumn('numero', 'Numero', 'INTEGER', true, 11, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('ControlBodega', 'Colli\\ControlBundle\\Model\\ControlBodega', RelationMap::ONE_TO_MANY, array('id' => 'maquinaria_id', ), null, null, 'ControlBodegas');
        $this->addRelation('Control', 'Colli\\ControlBundle\\Model\\Control', RelationMap::ONE_TO_MANY, array('id' => 'maquinaria_id', ), null, null, 'Controls');
    } // buildRelations()

} // MaquinariaTableMap
