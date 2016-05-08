<?php

namespace Colli\ControlBundle\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Colli\ControlBundle\Model\BodegaPeer;
use Colli\ControlBundle\Model\CantonPeer;
use Colli\ControlBundle\Model\Control;
use Colli\ControlBundle\Model\ControlPeer;
use Colli\ControlBundle\Model\MaquinariaPeer;
use Colli\ControlBundle\Model\SectorPeer;
use Colli\ControlBundle\Model\map\ControlTableMap;

abstract class BaseControlPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'default';

    /** the table name for this class */
    const TABLE_NAME = 'control';

    /** the related Propel class for this table */
    const OM_CLASS = 'Colli\\ControlBundle\\Model\\Control';

    /** the related TableMap class for this table */
    const TM_CLASS = 'Colli\\ControlBundle\\Model\\map\\ControlTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 14;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 14;

    /** the column name for the id field */
    const ID = 'control.id';

    /** the column name for the canton_id field */
    const CANTON_ID = 'control.canton_id';

    /** the column name for the sector_id field */
    const SECTOR_ID = 'control.sector_id';

    /** the column name for the cantidad_camionadas_sector field */
    const CANTIDAD_CAMIONADAS_SECTOR = 'control.cantidad_camionadas_sector';

    /** the column name for the precio_diesel_sector field */
    const PRECIO_DIESEL_SECTOR = 'control.precio_diesel_sector';

    /** the column name for the galones_diesel_sector field */
    const GALONES_DIESEL_SECTOR = 'control.galones_diesel_sector';

    /** the column name for the dias_cantidad_sector field */
    const DIAS_CANTIDAD_SECTOR = 'control.dias_cantidad_sector';

    /** the column name for the horas_diarias_sector field */
    const HORAS_DIARIAS_SECTOR = 'control.horas_diarias_sector';

    /** the column name for the horas_total_sector field */
    const HORAS_TOTAL_SECTOR = 'control.horas_total_sector';

    /** the column name for the grosor_balasto_sector field */
    const GROSOR_BALASTO_SECTOR = 'control.grosor_balasto_sector';

    /** the column name for the repacarion_sector field */
    const REPACARION_SECTOR = 'control.repacarion_sector';

    /** the column name for the maquinaria_id field */
    const MAQUINARIA_ID = 'control.maquinaria_id';

    /** the column name for the bodega_id field */
    const BODEGA_ID = 'control.bodega_id';

    /** the column name for the observaciones field */
    const OBSERVACIONES = 'control.observaciones';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identity map to hold any loaded instances of Control objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array Control[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. ControlPeer::$fieldNames[ControlPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'CantonId', 'SectorId', 'CantidadCamionadasSector', 'PrecioDieselSector', 'GalonesDieselSector', 'DiasCantidadSector', 'HorasDiariasSector', 'HorasTotalSector', 'GrosorBalastoSector', 'RepacarionSector', 'MaquinariaId', 'BodegaId', 'Observaciones', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'cantonId', 'sectorId', 'cantidadCamionadasSector', 'precioDieselSector', 'galonesDieselSector', 'diasCantidadSector', 'horasDiariasSector', 'horasTotalSector', 'grosorBalastoSector', 'repacarionSector', 'maquinariaId', 'bodegaId', 'observaciones', ),
        BasePeer::TYPE_COLNAME => array (ControlPeer::ID, ControlPeer::CANTON_ID, ControlPeer::SECTOR_ID, ControlPeer::CANTIDAD_CAMIONADAS_SECTOR, ControlPeer::PRECIO_DIESEL_SECTOR, ControlPeer::GALONES_DIESEL_SECTOR, ControlPeer::DIAS_CANTIDAD_SECTOR, ControlPeer::HORAS_DIARIAS_SECTOR, ControlPeer::HORAS_TOTAL_SECTOR, ControlPeer::GROSOR_BALASTO_SECTOR, ControlPeer::REPACARION_SECTOR, ControlPeer::MAQUINARIA_ID, ControlPeer::BODEGA_ID, ControlPeer::OBSERVACIONES, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'CANTON_ID', 'SECTOR_ID', 'CANTIDAD_CAMIONADAS_SECTOR', 'PRECIO_DIESEL_SECTOR', 'GALONES_DIESEL_SECTOR', 'DIAS_CANTIDAD_SECTOR', 'HORAS_DIARIAS_SECTOR', 'HORAS_TOTAL_SECTOR', 'GROSOR_BALASTO_SECTOR', 'REPACARION_SECTOR', 'MAQUINARIA_ID', 'BODEGA_ID', 'OBSERVACIONES', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'canton_id', 'sector_id', 'cantidad_camionadas_sector', 'precio_diesel_sector', 'galones_diesel_sector', 'dias_cantidad_sector', 'horas_diarias_sector', 'horas_total_sector', 'grosor_balasto_sector', 'repacarion_sector', 'maquinaria_id', 'bodega_id', 'observaciones', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. ControlPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CantonId' => 1, 'SectorId' => 2, 'CantidadCamionadasSector' => 3, 'PrecioDieselSector' => 4, 'GalonesDieselSector' => 5, 'DiasCantidadSector' => 6, 'HorasDiariasSector' => 7, 'HorasTotalSector' => 8, 'GrosorBalastoSector' => 9, 'RepacarionSector' => 10, 'MaquinariaId' => 11, 'BodegaId' => 12, 'Observaciones' => 13, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'cantonId' => 1, 'sectorId' => 2, 'cantidadCamionadasSector' => 3, 'precioDieselSector' => 4, 'galonesDieselSector' => 5, 'diasCantidadSector' => 6, 'horasDiariasSector' => 7, 'horasTotalSector' => 8, 'grosorBalastoSector' => 9, 'repacarionSector' => 10, 'maquinariaId' => 11, 'bodegaId' => 12, 'observaciones' => 13, ),
        BasePeer::TYPE_COLNAME => array (ControlPeer::ID => 0, ControlPeer::CANTON_ID => 1, ControlPeer::SECTOR_ID => 2, ControlPeer::CANTIDAD_CAMIONADAS_SECTOR => 3, ControlPeer::PRECIO_DIESEL_SECTOR => 4, ControlPeer::GALONES_DIESEL_SECTOR => 5, ControlPeer::DIAS_CANTIDAD_SECTOR => 6, ControlPeer::HORAS_DIARIAS_SECTOR => 7, ControlPeer::HORAS_TOTAL_SECTOR => 8, ControlPeer::GROSOR_BALASTO_SECTOR => 9, ControlPeer::REPACARION_SECTOR => 10, ControlPeer::MAQUINARIA_ID => 11, ControlPeer::BODEGA_ID => 12, ControlPeer::OBSERVACIONES => 13, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'CANTON_ID' => 1, 'SECTOR_ID' => 2, 'CANTIDAD_CAMIONADAS_SECTOR' => 3, 'PRECIO_DIESEL_SECTOR' => 4, 'GALONES_DIESEL_SECTOR' => 5, 'DIAS_CANTIDAD_SECTOR' => 6, 'HORAS_DIARIAS_SECTOR' => 7, 'HORAS_TOTAL_SECTOR' => 8, 'GROSOR_BALASTO_SECTOR' => 9, 'REPACARION_SECTOR' => 10, 'MAQUINARIA_ID' => 11, 'BODEGA_ID' => 12, 'OBSERVACIONES' => 13, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'canton_id' => 1, 'sector_id' => 2, 'cantidad_camionadas_sector' => 3, 'precio_diesel_sector' => 4, 'galones_diesel_sector' => 5, 'dias_cantidad_sector' => 6, 'horas_diarias_sector' => 7, 'horas_total_sector' => 8, 'grosor_balasto_sector' => 9, 'repacarion_sector' => 10, 'maquinaria_id' => 11, 'bodega_id' => 12, 'observaciones' => 13, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
    );

    /**
     * Translates a fieldname to another type
     *
     * @param      string $name field name
     * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @param      string $toType   One of the class type constants
     * @return string          translated name of the field.
     * @throws PropelException - if the specified name could not be found in the fieldname mappings.
     */
    public static function translateFieldName($name, $fromType, $toType)
    {
        $toNames = ControlPeer::getFieldNames($toType);
        $key = isset(ControlPeer::$fieldKeys[$fromType][$name]) ? ControlPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(ControlPeer::$fieldKeys[$fromType], true));
        }

        return $toNames[$key];
    }

    /**
     * Returns an array of field names.
     *
     * @param      string $type The type of fieldnames to return:
     *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @return array           A list of field names
     * @throws PropelException - if the type is not valid.
     */
    public static function getFieldNames($type = BasePeer::TYPE_PHPNAME)
    {
        if (!array_key_exists($type, ControlPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return ControlPeer::$fieldNames[$type];
    }

    /**
     * Convenience method which changes table.column to alias.column.
     *
     * Using this method you can maintain SQL abstraction while using column aliases.
     * <code>
     *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
     *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
     * </code>
     * @param      string $alias The alias for the current table.
     * @param      string $column The column name for current table. (i.e. ControlPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(ControlPeer::TABLE_NAME.'.', $alias.'.', $column);
    }

    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param      Criteria $criteria object containing the columns to add.
     * @param      string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(ControlPeer::ID);
            $criteria->addSelectColumn(ControlPeer::CANTON_ID);
            $criteria->addSelectColumn(ControlPeer::SECTOR_ID);
            $criteria->addSelectColumn(ControlPeer::CANTIDAD_CAMIONADAS_SECTOR);
            $criteria->addSelectColumn(ControlPeer::PRECIO_DIESEL_SECTOR);
            $criteria->addSelectColumn(ControlPeer::GALONES_DIESEL_SECTOR);
            $criteria->addSelectColumn(ControlPeer::DIAS_CANTIDAD_SECTOR);
            $criteria->addSelectColumn(ControlPeer::HORAS_DIARIAS_SECTOR);
            $criteria->addSelectColumn(ControlPeer::HORAS_TOTAL_SECTOR);
            $criteria->addSelectColumn(ControlPeer::GROSOR_BALASTO_SECTOR);
            $criteria->addSelectColumn(ControlPeer::REPACARION_SECTOR);
            $criteria->addSelectColumn(ControlPeer::MAQUINARIA_ID);
            $criteria->addSelectColumn(ControlPeer::BODEGA_ID);
            $criteria->addSelectColumn(ControlPeer::OBSERVACIONES);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.canton_id');
            $criteria->addSelectColumn($alias . '.sector_id');
            $criteria->addSelectColumn($alias . '.cantidad_camionadas_sector');
            $criteria->addSelectColumn($alias . '.precio_diesel_sector');
            $criteria->addSelectColumn($alias . '.galones_diesel_sector');
            $criteria->addSelectColumn($alias . '.dias_cantidad_sector');
            $criteria->addSelectColumn($alias . '.horas_diarias_sector');
            $criteria->addSelectColumn($alias . '.horas_total_sector');
            $criteria->addSelectColumn($alias . '.grosor_balasto_sector');
            $criteria->addSelectColumn($alias . '.repacarion_sector');
            $criteria->addSelectColumn($alias . '.maquinaria_id');
            $criteria->addSelectColumn($alias . '.bodega_id');
            $criteria->addSelectColumn($alias . '.observaciones');
        }
    }

    /**
     * Returns the number of rows matching criteria.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @return int Number of matching rows.
     */
    public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
    {
        // we may modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ControlPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ControlPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(ControlPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(ControlPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // BasePeer returns a PDOStatement
        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }
    /**
     * Selects one object from the DB.
     *
     * @param      Criteria $criteria object used to create the SELECT statement.
     * @param      PropelPDO $con
     * @return Control
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = ControlPeer::doSelect($critcopy, $con);
        if ($objects) {
            return $objects[0];
        }

        return null;
    }
    /**
     * Selects several row from the DB.
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con
     * @return array           Array of selected Objects
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelect(Criteria $criteria, PropelPDO $con = null)
    {
        return ControlPeer::populateObjects(ControlPeer::doSelectStmt($criteria, $con));
    }
    /**
     * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
     *
     * Use this method directly if you want to work with an executed statement directly (for example
     * to perform your own object hydration).
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con The connection to use
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return PDOStatement The executed PDOStatement object.
     * @see        BasePeer::doSelect()
     */
    public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ControlPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            ControlPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(ControlPeer::DATABASE_NAME);

        // BasePeer returns a PDOStatement
        return BasePeer::doSelect($criteria, $con);
    }
    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doSelect*()
     * methods in your stub classes -- you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by doSelect*()
     * and retrieveByPK*() calls.
     *
     * @param Control $obj A Control object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            ControlPeer::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param      mixed $value A Control object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof Control) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Control object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(ControlPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return Control Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(ControlPeer::$instances[$key])) {
                return ControlPeer::$instances[$key];
            }
        }

        return null; // just to be explicit
    }

    /**
     * Clear the instance pool.
     *
     * @return void
     */
    public static function clearInstancePool($and_clear_all_references = false)
    {
      if ($and_clear_all_references) {
        foreach (ControlPeer::$instances as $instance) {
          $instance->clearAllReferences(true);
        }
      }
        ControlPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to control
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return string A string version of PK or null if the components of primary key in result array are all null.
     */
    public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
    {
        // If the PK cannot be derived from the row, return null.
        if ($row[$startcol] === null) {
            return null;
        }

        return (string) $row[$startcol];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $startcol = 0)
    {

        return (int) $row[$startcol];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function populateObjects(PDOStatement $stmt)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = ControlPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = ControlPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = ControlPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ControlPeer::addInstanceToPool($obj, $key);
            } // if key exists
        }
        $stmt->closeCursor();

        return $results;
    }
    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return array (Control object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = ControlPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = ControlPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + ControlPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ControlPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            ControlPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related Canton table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinCanton(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ControlPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ControlPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ControlPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ControlPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ControlPeer::CANTON_ID, CantonPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related Sector table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinSector(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ControlPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ControlPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ControlPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ControlPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ControlPeer::SECTOR_ID, SectorPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related Maquinaria table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinMaquinaria(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ControlPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ControlPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ControlPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ControlPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ControlPeer::MAQUINARIA_ID, MaquinariaPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related Bodega table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinBodega(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ControlPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ControlPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ControlPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ControlPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ControlPeer::BODEGA_ID, BodegaPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Selects a collection of Control objects pre-filled with their Canton objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Control objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinCanton(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ControlPeer::DATABASE_NAME);
        }

        ControlPeer::addSelectColumns($criteria);
        $startcol = ControlPeer::NUM_HYDRATE_COLUMNS;
        CantonPeer::addSelectColumns($criteria);

        $criteria->addJoin(ControlPeer::CANTON_ID, CantonPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ControlPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ControlPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = ControlPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ControlPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = CantonPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = CantonPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = CantonPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    CantonPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (Control) to $obj2 (Canton)
                $obj2->addControl($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Control objects pre-filled with their Sector objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Control objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinSector(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ControlPeer::DATABASE_NAME);
        }

        ControlPeer::addSelectColumns($criteria);
        $startcol = ControlPeer::NUM_HYDRATE_COLUMNS;
        SectorPeer::addSelectColumns($criteria);

        $criteria->addJoin(ControlPeer::SECTOR_ID, SectorPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ControlPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ControlPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = ControlPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ControlPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = SectorPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = SectorPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = SectorPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    SectorPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (Control) to $obj2 (Sector)
                $obj2->addControl($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Control objects pre-filled with their Maquinaria objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Control objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinMaquinaria(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ControlPeer::DATABASE_NAME);
        }

        ControlPeer::addSelectColumns($criteria);
        $startcol = ControlPeer::NUM_HYDRATE_COLUMNS;
        MaquinariaPeer::addSelectColumns($criteria);

        $criteria->addJoin(ControlPeer::MAQUINARIA_ID, MaquinariaPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ControlPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ControlPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = ControlPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ControlPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = MaquinariaPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = MaquinariaPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = MaquinariaPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    MaquinariaPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (Control) to $obj2 (Maquinaria)
                $obj2->addControl($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Control objects pre-filled with their Bodega objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Control objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinBodega(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ControlPeer::DATABASE_NAME);
        }

        ControlPeer::addSelectColumns($criteria);
        $startcol = ControlPeer::NUM_HYDRATE_COLUMNS;
        BodegaPeer::addSelectColumns($criteria);

        $criteria->addJoin(ControlPeer::BODEGA_ID, BodegaPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ControlPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ControlPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = ControlPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ControlPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = BodegaPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = BodegaPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = BodegaPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    BodegaPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (Control) to $obj2 (Bodega)
                $obj2->addControl($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining all related tables
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ControlPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ControlPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ControlPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ControlPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ControlPeer::CANTON_ID, CantonPeer::ID, $join_behavior);

        $criteria->addJoin(ControlPeer::SECTOR_ID, SectorPeer::ID, $join_behavior);

        $criteria->addJoin(ControlPeer::MAQUINARIA_ID, MaquinariaPeer::ID, $join_behavior);

        $criteria->addJoin(ControlPeer::BODEGA_ID, BodegaPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }

    /**
     * Selects a collection of Control objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Control objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ControlPeer::DATABASE_NAME);
        }

        ControlPeer::addSelectColumns($criteria);
        $startcol2 = ControlPeer::NUM_HYDRATE_COLUMNS;

        CantonPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + CantonPeer::NUM_HYDRATE_COLUMNS;

        SectorPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + SectorPeer::NUM_HYDRATE_COLUMNS;

        MaquinariaPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + MaquinariaPeer::NUM_HYDRATE_COLUMNS;

        BodegaPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + BodegaPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ControlPeer::CANTON_ID, CantonPeer::ID, $join_behavior);

        $criteria->addJoin(ControlPeer::SECTOR_ID, SectorPeer::ID, $join_behavior);

        $criteria->addJoin(ControlPeer::MAQUINARIA_ID, MaquinariaPeer::ID, $join_behavior);

        $criteria->addJoin(ControlPeer::BODEGA_ID, BodegaPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ControlPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ControlPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ControlPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ControlPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined Canton rows

            $key2 = CantonPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = CantonPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = CantonPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    CantonPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (Control) to the collection in $obj2 (Canton)
                $obj2->addControl($obj1);
            } // if joined row not null

            // Add objects for joined Sector rows

            $key3 = SectorPeer::getPrimaryKeyHashFromRow($row, $startcol3);
            if ($key3 !== null) {
                $obj3 = SectorPeer::getInstanceFromPool($key3);
                if (!$obj3) {

                    $cls = SectorPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    SectorPeer::addInstanceToPool($obj3, $key3);
                } // if obj3 loaded

                // Add the $obj1 (Control) to the collection in $obj3 (Sector)
                $obj3->addControl($obj1);
            } // if joined row not null

            // Add objects for joined Maquinaria rows

            $key4 = MaquinariaPeer::getPrimaryKeyHashFromRow($row, $startcol4);
            if ($key4 !== null) {
                $obj4 = MaquinariaPeer::getInstanceFromPool($key4);
                if (!$obj4) {

                    $cls = MaquinariaPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    MaquinariaPeer::addInstanceToPool($obj4, $key4);
                } // if obj4 loaded

                // Add the $obj1 (Control) to the collection in $obj4 (Maquinaria)
                $obj4->addControl($obj1);
            } // if joined row not null

            // Add objects for joined Bodega rows

            $key5 = BodegaPeer::getPrimaryKeyHashFromRow($row, $startcol5);
            if ($key5 !== null) {
                $obj5 = BodegaPeer::getInstanceFromPool($key5);
                if (!$obj5) {

                    $cls = BodegaPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    BodegaPeer::addInstanceToPool($obj5, $key5);
                } // if obj5 loaded

                // Add the $obj1 (Control) to the collection in $obj5 (Bodega)
                $obj5->addControl($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining the related Canton table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptCanton(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ControlPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ControlPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(ControlPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ControlPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ControlPeer::SECTOR_ID, SectorPeer::ID, $join_behavior);

        $criteria->addJoin(ControlPeer::MAQUINARIA_ID, MaquinariaPeer::ID, $join_behavior);

        $criteria->addJoin(ControlPeer::BODEGA_ID, BodegaPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related Sector table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptSector(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ControlPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ControlPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(ControlPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ControlPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ControlPeer::CANTON_ID, CantonPeer::ID, $join_behavior);

        $criteria->addJoin(ControlPeer::MAQUINARIA_ID, MaquinariaPeer::ID, $join_behavior);

        $criteria->addJoin(ControlPeer::BODEGA_ID, BodegaPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related Maquinaria table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptMaquinaria(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ControlPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ControlPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(ControlPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ControlPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ControlPeer::CANTON_ID, CantonPeer::ID, $join_behavior);

        $criteria->addJoin(ControlPeer::SECTOR_ID, SectorPeer::ID, $join_behavior);

        $criteria->addJoin(ControlPeer::BODEGA_ID, BodegaPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related Bodega table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptBodega(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ControlPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ControlPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(ControlPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ControlPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ControlPeer::CANTON_ID, CantonPeer::ID, $join_behavior);

        $criteria->addJoin(ControlPeer::SECTOR_ID, SectorPeer::ID, $join_behavior);

        $criteria->addJoin(ControlPeer::MAQUINARIA_ID, MaquinariaPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Selects a collection of Control objects pre-filled with all related objects except Canton.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Control objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptCanton(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ControlPeer::DATABASE_NAME);
        }

        ControlPeer::addSelectColumns($criteria);
        $startcol2 = ControlPeer::NUM_HYDRATE_COLUMNS;

        SectorPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + SectorPeer::NUM_HYDRATE_COLUMNS;

        MaquinariaPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + MaquinariaPeer::NUM_HYDRATE_COLUMNS;

        BodegaPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + BodegaPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ControlPeer::SECTOR_ID, SectorPeer::ID, $join_behavior);

        $criteria->addJoin(ControlPeer::MAQUINARIA_ID, MaquinariaPeer::ID, $join_behavior);

        $criteria->addJoin(ControlPeer::BODEGA_ID, BodegaPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ControlPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ControlPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ControlPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ControlPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Sector rows

                $key2 = SectorPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = SectorPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = SectorPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    SectorPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Control) to the collection in $obj2 (Sector)
                $obj2->addControl($obj1);

            } // if joined row is not null

                // Add objects for joined Maquinaria rows

                $key3 = MaquinariaPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = MaquinariaPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = MaquinariaPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    MaquinariaPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (Control) to the collection in $obj3 (Maquinaria)
                $obj3->addControl($obj1);

            } // if joined row is not null

                // Add objects for joined Bodega rows

                $key4 = BodegaPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = BodegaPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = BodegaPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    BodegaPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (Control) to the collection in $obj4 (Bodega)
                $obj4->addControl($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Control objects pre-filled with all related objects except Sector.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Control objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptSector(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ControlPeer::DATABASE_NAME);
        }

        ControlPeer::addSelectColumns($criteria);
        $startcol2 = ControlPeer::NUM_HYDRATE_COLUMNS;

        CantonPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + CantonPeer::NUM_HYDRATE_COLUMNS;

        MaquinariaPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + MaquinariaPeer::NUM_HYDRATE_COLUMNS;

        BodegaPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + BodegaPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ControlPeer::CANTON_ID, CantonPeer::ID, $join_behavior);

        $criteria->addJoin(ControlPeer::MAQUINARIA_ID, MaquinariaPeer::ID, $join_behavior);

        $criteria->addJoin(ControlPeer::BODEGA_ID, BodegaPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ControlPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ControlPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ControlPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ControlPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Canton rows

                $key2 = CantonPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = CantonPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = CantonPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    CantonPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Control) to the collection in $obj2 (Canton)
                $obj2->addControl($obj1);

            } // if joined row is not null

                // Add objects for joined Maquinaria rows

                $key3 = MaquinariaPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = MaquinariaPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = MaquinariaPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    MaquinariaPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (Control) to the collection in $obj3 (Maquinaria)
                $obj3->addControl($obj1);

            } // if joined row is not null

                // Add objects for joined Bodega rows

                $key4 = BodegaPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = BodegaPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = BodegaPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    BodegaPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (Control) to the collection in $obj4 (Bodega)
                $obj4->addControl($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Control objects pre-filled with all related objects except Maquinaria.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Control objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptMaquinaria(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ControlPeer::DATABASE_NAME);
        }

        ControlPeer::addSelectColumns($criteria);
        $startcol2 = ControlPeer::NUM_HYDRATE_COLUMNS;

        CantonPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + CantonPeer::NUM_HYDRATE_COLUMNS;

        SectorPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + SectorPeer::NUM_HYDRATE_COLUMNS;

        BodegaPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + BodegaPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ControlPeer::CANTON_ID, CantonPeer::ID, $join_behavior);

        $criteria->addJoin(ControlPeer::SECTOR_ID, SectorPeer::ID, $join_behavior);

        $criteria->addJoin(ControlPeer::BODEGA_ID, BodegaPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ControlPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ControlPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ControlPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ControlPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Canton rows

                $key2 = CantonPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = CantonPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = CantonPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    CantonPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Control) to the collection in $obj2 (Canton)
                $obj2->addControl($obj1);

            } // if joined row is not null

                // Add objects for joined Sector rows

                $key3 = SectorPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = SectorPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = SectorPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    SectorPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (Control) to the collection in $obj3 (Sector)
                $obj3->addControl($obj1);

            } // if joined row is not null

                // Add objects for joined Bodega rows

                $key4 = BodegaPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = BodegaPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = BodegaPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    BodegaPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (Control) to the collection in $obj4 (Bodega)
                $obj4->addControl($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Control objects pre-filled with all related objects except Bodega.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Control objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptBodega(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ControlPeer::DATABASE_NAME);
        }

        ControlPeer::addSelectColumns($criteria);
        $startcol2 = ControlPeer::NUM_HYDRATE_COLUMNS;

        CantonPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + CantonPeer::NUM_HYDRATE_COLUMNS;

        SectorPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + SectorPeer::NUM_HYDRATE_COLUMNS;

        MaquinariaPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + MaquinariaPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ControlPeer::CANTON_ID, CantonPeer::ID, $join_behavior);

        $criteria->addJoin(ControlPeer::SECTOR_ID, SectorPeer::ID, $join_behavior);

        $criteria->addJoin(ControlPeer::MAQUINARIA_ID, MaquinariaPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ControlPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ControlPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ControlPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ControlPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Canton rows

                $key2 = CantonPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = CantonPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = CantonPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    CantonPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Control) to the collection in $obj2 (Canton)
                $obj2->addControl($obj1);

            } // if joined row is not null

                // Add objects for joined Sector rows

                $key3 = SectorPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = SectorPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = SectorPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    SectorPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (Control) to the collection in $obj3 (Sector)
                $obj3->addControl($obj1);

            } // if joined row is not null

                // Add objects for joined Maquinaria rows

                $key4 = MaquinariaPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = MaquinariaPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = MaquinariaPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    MaquinariaPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (Control) to the collection in $obj4 (Maquinaria)
                $obj4->addControl($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }

    /**
     * Returns the TableMap related to this peer.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getDatabaseMap(ControlPeer::DATABASE_NAME)->getTable(ControlPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseControlPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseControlPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new \Colli\ControlBundle\Model\map\ControlTableMap());
      }
    }

    /**
     * The class that the Peer will make instances of.
     *
     *
     * @return string ClassName
     */
    public static function getOMClass($row = 0, $colnum = 0)
    {
        return ControlPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a Control or Criteria object.
     *
     * @param      mixed $values Criteria or Control object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ControlPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from Control object
        }

        if ($criteria->containsKey(ControlPeer::ID) && $criteria->keyContainsValue(ControlPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ControlPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(ControlPeer::DATABASE_NAME);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = BasePeer::doInsert($criteria, $con);
            $con->commit();
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

    /**
     * Performs an UPDATE on the database, given a Control or Criteria object.
     *
     * @param      mixed $values Criteria or Control object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ControlPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(ControlPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(ControlPeer::ID);
            $value = $criteria->remove(ControlPeer::ID);
            if ($value) {
                $selectCriteria->add(ControlPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(ControlPeer::TABLE_NAME);
            }

        } else { // $values is Control object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(ControlPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the control table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ControlPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(ControlPeer::TABLE_NAME, $con, ControlPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ControlPeer::clearInstancePool();
            ControlPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a Control or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or Control object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param      PropelPDO $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *				if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, PropelPDO $con = null)
     {
        if ($con === null) {
            $con = Propel::getConnection(ControlPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            ControlPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof Control) { // it's a model object
            // invalidate the cache for this single object
            ControlPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ControlPeer::DATABASE_NAME);
            $criteria->add(ControlPeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                ControlPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(ControlPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            ControlPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given Control object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param Control $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(ControlPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(ControlPeer::TABLE_NAME);

            if (! is_array($cols)) {
                $cols = array($cols);
            }

            foreach ($cols as $colName) {
                if ($tableMap->hasColumn($colName)) {
                    $get = 'get' . $tableMap->getColumn($colName)->getPhpName();
                    $columns[$colName] = $obj->$get();
                }
            }
        } else {

        }

        return BasePeer::doValidate(ControlPeer::DATABASE_NAME, ControlPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return Control
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = ControlPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(ControlPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(ControlPeer::DATABASE_NAME);
        $criteria->add(ControlPeer::ID, $pk);

        $v = ControlPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return Control[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ControlPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(ControlPeer::DATABASE_NAME);
            $criteria->add(ControlPeer::ID, $pks, Criteria::IN);
            $objs = ControlPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseControlPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseControlPeer::buildTableMap();

