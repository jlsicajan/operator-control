<?php

namespace Colli\ControlBundle\Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelException;
use \PropelPDO;
use Colli\ControlBundle\Model\Bodega;
use Colli\ControlBundle\Model\BodegaQuery;
use Colli\ControlBundle\Model\Canton;
use Colli\ControlBundle\Model\CantonQuery;
use Colli\ControlBundle\Model\Control;
use Colli\ControlBundle\Model\ControlPeer;
use Colli\ControlBundle\Model\ControlQuery;
use Colli\ControlBundle\Model\Maquinaria;
use Colli\ControlBundle\Model\MaquinariaQuery;
use Colli\ControlBundle\Model\Sector;
use Colli\ControlBundle\Model\SectorQuery;

abstract class BaseControl extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Colli\\ControlBundle\\Model\\ControlPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        ControlPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the canton_id field.
     * @var        int
     */
    protected $canton_id;

    /**
     * The value for the sector_id field.
     * @var        int
     */
    protected $sector_id;

    /**
     * The value for the cantidad_camionadas_sector field.
     * @var        string
     */
    protected $cantidad_camionadas_sector;

    /**
     * The value for the precio_diesel_sector field.
     * @var        string
     */
    protected $precio_diesel_sector;

    /**
     * The value for the galones_diesel_sector field.
     * @var        string
     */
    protected $galones_diesel_sector;

    /**
     * The value for the dias_cantidad_sector field.
     * @var        string
     */
    protected $dias_cantidad_sector;

    /**
     * The value for the horas_diarias_sector field.
     * @var        string
     */
    protected $horas_diarias_sector;

    /**
     * The value for the horas_total_sector field.
     * @var        string
     */
    protected $horas_total_sector;

    /**
     * The value for the grosor_balasto_sector field.
     * @var        string
     */
    protected $grosor_balasto_sector;

    /**
     * The value for the repacarion_sector field.
     * @var        string
     */
    protected $repacarion_sector;

    /**
     * The value for the maquinaria_id field.
     * @var        string
     */
    protected $maquinaria_id;

    /**
     * The value for the bodega_id field.
     * @var        string
     */
    protected $bodega_id;

    /**
     * The value for the observaciones field.
     * @var        string
     */
    protected $observaciones;

    /**
     * @var        Canton
     */
    protected $aCanton;

    /**
     * @var        Sector
     */
    protected $aSector;

    /**
     * @var        Maquinaria
     */
    protected $aMaquinaria;

    /**
     * @var        Bodega
     */
    protected $aBodega;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * Get the [canton_id] column value.
     *
     * @return int
     */
    public function getCantonId()
    {

        return $this->canton_id;
    }

    /**
     * Get the [sector_id] column value.
     *
     * @return int
     */
    public function getSectorId()
    {

        return $this->sector_id;
    }

    /**
     * Get the [cantidad_camionadas_sector] column value.
     *
     * @return string
     */
    public function getCantidadCamionadasSector()
    {

        return $this->cantidad_camionadas_sector;
    }

    /**
     * Get the [precio_diesel_sector] column value.
     *
     * @return string
     */
    public function getPrecioDieselSector()
    {

        return $this->precio_diesel_sector;
    }

    /**
     * Get the [galones_diesel_sector] column value.
     *
     * @return string
     */
    public function getGalonesDieselSector()
    {

        return $this->galones_diesel_sector;
    }

    /**
     * Get the [dias_cantidad_sector] column value.
     *
     * @return string
     */
    public function getDiasCantidadSector()
    {

        return $this->dias_cantidad_sector;
    }

    /**
     * Get the [horas_diarias_sector] column value.
     *
     * @return string
     */
    public function getHorasDiariasSector()
    {

        return $this->horas_diarias_sector;
    }

    /**
     * Get the [horas_total_sector] column value.
     *
     * @return string
     */
    public function getHorasTotalSector()
    {

        return $this->horas_total_sector;
    }

    /**
     * Get the [grosor_balasto_sector] column value.
     *
     * @return string
     */
    public function getGrosorBalastoSector()
    {

        return $this->grosor_balasto_sector;
    }

    /**
     * Get the [repacarion_sector] column value.
     *
     * @return string
     */
    public function getRepacarionSector()
    {

        return $this->repacarion_sector;
    }

    /**
     * Get the [maquinaria_id] column value.
     *
     * @return string
     */
    public function getMaquinariaId()
    {

        return $this->maquinaria_id;
    }

    /**
     * Get the [bodega_id] column value.
     *
     * @return string
     */
    public function getBodegaId()
    {

        return $this->bodega_id;
    }

    /**
     * Get the [observaciones] column value.
     *
     * @return string
     */
    public function getObservaciones()
    {

        return $this->observaciones;
    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return Control The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = ControlPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [canton_id] column.
     *
     * @param  int $v new value
     * @return Control The current object (for fluent API support)
     */
    public function setCantonId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->canton_id !== $v) {
            $this->canton_id = $v;
            $this->modifiedColumns[] = ControlPeer::CANTON_ID;
        }

        if ($this->aCanton !== null && $this->aCanton->getId() !== $v) {
            $this->aCanton = null;
        }


        return $this;
    } // setCantonId()

    /**
     * Set the value of [sector_id] column.
     *
     * @param  int $v new value
     * @return Control The current object (for fluent API support)
     */
    public function setSectorId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->sector_id !== $v) {
            $this->sector_id = $v;
            $this->modifiedColumns[] = ControlPeer::SECTOR_ID;
        }

        if ($this->aSector !== null && $this->aSector->getId() !== $v) {
            $this->aSector = null;
        }


        return $this;
    } // setSectorId()

    /**
     * Set the value of [cantidad_camionadas_sector] column.
     *
     * @param  string $v new value
     * @return Control The current object (for fluent API support)
     */
    public function setCantidadCamionadasSector($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cantidad_camionadas_sector !== $v) {
            $this->cantidad_camionadas_sector = $v;
            $this->modifiedColumns[] = ControlPeer::CANTIDAD_CAMIONADAS_SECTOR;
        }


        return $this;
    } // setCantidadCamionadasSector()

    /**
     * Set the value of [precio_diesel_sector] column.
     *
     * @param  string $v new value
     * @return Control The current object (for fluent API support)
     */
    public function setPrecioDieselSector($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->precio_diesel_sector !== $v) {
            $this->precio_diesel_sector = $v;
            $this->modifiedColumns[] = ControlPeer::PRECIO_DIESEL_SECTOR;
        }


        return $this;
    } // setPrecioDieselSector()

    /**
     * Set the value of [galones_diesel_sector] column.
     *
     * @param  string $v new value
     * @return Control The current object (for fluent API support)
     */
    public function setGalonesDieselSector($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->galones_diesel_sector !== $v) {
            $this->galones_diesel_sector = $v;
            $this->modifiedColumns[] = ControlPeer::GALONES_DIESEL_SECTOR;
        }


        return $this;
    } // setGalonesDieselSector()

    /**
     * Set the value of [dias_cantidad_sector] column.
     *
     * @param  string $v new value
     * @return Control The current object (for fluent API support)
     */
    public function setDiasCantidadSector($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dias_cantidad_sector !== $v) {
            $this->dias_cantidad_sector = $v;
            $this->modifiedColumns[] = ControlPeer::DIAS_CANTIDAD_SECTOR;
        }


        return $this;
    } // setDiasCantidadSector()

    /**
     * Set the value of [horas_diarias_sector] column.
     *
     * @param  string $v new value
     * @return Control The current object (for fluent API support)
     */
    public function setHorasDiariasSector($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->horas_diarias_sector !== $v) {
            $this->horas_diarias_sector = $v;
            $this->modifiedColumns[] = ControlPeer::HORAS_DIARIAS_SECTOR;
        }


        return $this;
    } // setHorasDiariasSector()

    /**
     * Set the value of [horas_total_sector] column.
     *
     * @param  string $v new value
     * @return Control The current object (for fluent API support)
     */
    public function setHorasTotalSector($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->horas_total_sector !== $v) {
            $this->horas_total_sector = $v;
            $this->modifiedColumns[] = ControlPeer::HORAS_TOTAL_SECTOR;
        }


        return $this;
    } // setHorasTotalSector()

    /**
     * Set the value of [grosor_balasto_sector] column.
     *
     * @param  string $v new value
     * @return Control The current object (for fluent API support)
     */
    public function setGrosorBalastoSector($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->grosor_balasto_sector !== $v) {
            $this->grosor_balasto_sector = $v;
            $this->modifiedColumns[] = ControlPeer::GROSOR_BALASTO_SECTOR;
        }


        return $this;
    } // setGrosorBalastoSector()

    /**
     * Set the value of [repacarion_sector] column.
     *
     * @param  string $v new value
     * @return Control The current object (for fluent API support)
     */
    public function setRepacarionSector($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->repacarion_sector !== $v) {
            $this->repacarion_sector = $v;
            $this->modifiedColumns[] = ControlPeer::REPACARION_SECTOR;
        }


        return $this;
    } // setRepacarionSector()

    /**
     * Set the value of [maquinaria_id] column.
     *
     * @param  string $v new value
     * @return Control The current object (for fluent API support)
     */
    public function setMaquinariaId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->maquinaria_id !== $v) {
            $this->maquinaria_id = $v;
            $this->modifiedColumns[] = ControlPeer::MAQUINARIA_ID;
        }

        if ($this->aMaquinaria !== null && $this->aMaquinaria->getId() !== $v) {
            $this->aMaquinaria = null;
        }


        return $this;
    } // setMaquinariaId()

    /**
     * Set the value of [bodega_id] column.
     *
     * @param  string $v new value
     * @return Control The current object (for fluent API support)
     */
    public function setBodegaId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->bodega_id !== $v) {
            $this->bodega_id = $v;
            $this->modifiedColumns[] = ControlPeer::BODEGA_ID;
        }

        if ($this->aBodega !== null && $this->aBodega->getId() !== $v) {
            $this->aBodega = null;
        }


        return $this;
    } // setBodegaId()

    /**
     * Set the value of [observaciones] column.
     *
     * @param  string $v new value
     * @return Control The current object (for fluent API support)
     */
    public function setObservaciones($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->observaciones !== $v) {
            $this->observaciones = $v;
            $this->modifiedColumns[] = ControlPeer::OBSERVACIONES;
        }


        return $this;
    } // setObservaciones()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->canton_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->sector_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->cantidad_camionadas_sector = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->precio_diesel_sector = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->galones_diesel_sector = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->dias_cantidad_sector = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->horas_diarias_sector = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->horas_total_sector = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->grosor_balasto_sector = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->repacarion_sector = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->maquinaria_id = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->bodega_id = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->observaciones = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 14; // 14 = ControlPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Control object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

        if ($this->aCanton !== null && $this->canton_id !== $this->aCanton->getId()) {
            $this->aCanton = null;
        }
        if ($this->aSector !== null && $this->sector_id !== $this->aSector->getId()) {
            $this->aSector = null;
        }
        if ($this->aMaquinaria !== null && $this->maquinaria_id !== $this->aMaquinaria->getId()) {
            $this->aMaquinaria = null;
        }
        if ($this->aBodega !== null && $this->bodega_id !== $this->aBodega->getId()) {
            $this->aBodega = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(ControlPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = ControlPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCanton = null;
            $this->aSector = null;
            $this->aMaquinaria = null;
            $this->aBodega = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(ControlPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ControlQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(ControlPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                ControlPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aCanton !== null) {
                if ($this->aCanton->isModified() || $this->aCanton->isNew()) {
                    $affectedRows += $this->aCanton->save($con);
                }
                $this->setCanton($this->aCanton);
            }

            if ($this->aSector !== null) {
                if ($this->aSector->isModified() || $this->aSector->isNew()) {
                    $affectedRows += $this->aSector->save($con);
                }
                $this->setSector($this->aSector);
            }

            if ($this->aMaquinaria !== null) {
                if ($this->aMaquinaria->isModified() || $this->aMaquinaria->isNew()) {
                    $affectedRows += $this->aMaquinaria->save($con);
                }
                $this->setMaquinaria($this->aMaquinaria);
            }

            if ($this->aBodega !== null) {
                if ($this->aBodega->isModified() || $this->aBodega->isNew()) {
                    $affectedRows += $this->aBodega->save($con);
                }
                $this->setBodega($this->aBodega);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = ControlPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ControlPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ControlPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(ControlPeer::CANTON_ID)) {
            $modifiedColumns[':p' . $index++]  = '`canton_id`';
        }
        if ($this->isColumnModified(ControlPeer::SECTOR_ID)) {
            $modifiedColumns[':p' . $index++]  = '`sector_id`';
        }
        if ($this->isColumnModified(ControlPeer::CANTIDAD_CAMIONADAS_SECTOR)) {
            $modifiedColumns[':p' . $index++]  = '`cantidad_camionadas_sector`';
        }
        if ($this->isColumnModified(ControlPeer::PRECIO_DIESEL_SECTOR)) {
            $modifiedColumns[':p' . $index++]  = '`precio_diesel_sector`';
        }
        if ($this->isColumnModified(ControlPeer::GALONES_DIESEL_SECTOR)) {
            $modifiedColumns[':p' . $index++]  = '`galones_diesel_sector`';
        }
        if ($this->isColumnModified(ControlPeer::DIAS_CANTIDAD_SECTOR)) {
            $modifiedColumns[':p' . $index++]  = '`dias_cantidad_sector`';
        }
        if ($this->isColumnModified(ControlPeer::HORAS_DIARIAS_SECTOR)) {
            $modifiedColumns[':p' . $index++]  = '`horas_diarias_sector`';
        }
        if ($this->isColumnModified(ControlPeer::HORAS_TOTAL_SECTOR)) {
            $modifiedColumns[':p' . $index++]  = '`horas_total_sector`';
        }
        if ($this->isColumnModified(ControlPeer::GROSOR_BALASTO_SECTOR)) {
            $modifiedColumns[':p' . $index++]  = '`grosor_balasto_sector`';
        }
        if ($this->isColumnModified(ControlPeer::REPACARION_SECTOR)) {
            $modifiedColumns[':p' . $index++]  = '`repacarion_sector`';
        }
        if ($this->isColumnModified(ControlPeer::MAQUINARIA_ID)) {
            $modifiedColumns[':p' . $index++]  = '`maquinaria_id`';
        }
        if ($this->isColumnModified(ControlPeer::BODEGA_ID)) {
            $modifiedColumns[':p' . $index++]  = '`bodega_id`';
        }
        if ($this->isColumnModified(ControlPeer::OBSERVACIONES)) {
            $modifiedColumns[':p' . $index++]  = '`observaciones`';
        }

        $sql = sprintf(
            'INSERT INTO `control` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`canton_id`':
                        $stmt->bindValue($identifier, $this->canton_id, PDO::PARAM_INT);
                        break;
                    case '`sector_id`':
                        $stmt->bindValue($identifier, $this->sector_id, PDO::PARAM_INT);
                        break;
                    case '`cantidad_camionadas_sector`':
                        $stmt->bindValue($identifier, $this->cantidad_camionadas_sector, PDO::PARAM_STR);
                        break;
                    case '`precio_diesel_sector`':
                        $stmt->bindValue($identifier, $this->precio_diesel_sector, PDO::PARAM_STR);
                        break;
                    case '`galones_diesel_sector`':
                        $stmt->bindValue($identifier, $this->galones_diesel_sector, PDO::PARAM_STR);
                        break;
                    case '`dias_cantidad_sector`':
                        $stmt->bindValue($identifier, $this->dias_cantidad_sector, PDO::PARAM_STR);
                        break;
                    case '`horas_diarias_sector`':
                        $stmt->bindValue($identifier, $this->horas_diarias_sector, PDO::PARAM_STR);
                        break;
                    case '`horas_total_sector`':
                        $stmt->bindValue($identifier, $this->horas_total_sector, PDO::PARAM_STR);
                        break;
                    case '`grosor_balasto_sector`':
                        $stmt->bindValue($identifier, $this->grosor_balasto_sector, PDO::PARAM_STR);
                        break;
                    case '`repacarion_sector`':
                        $stmt->bindValue($identifier, $this->repacarion_sector, PDO::PARAM_STR);
                        break;
                    case '`maquinaria_id`':
                        $stmt->bindValue($identifier, $this->maquinaria_id, PDO::PARAM_STR);
                        break;
                    case '`bodega_id`':
                        $stmt->bindValue($identifier, $this->bodega_id, PDO::PARAM_STR);
                        break;
                    case '`observaciones`':
                        $stmt->bindValue($identifier, $this->observaciones, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggregated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objects otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            // We call the validate method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aCanton !== null) {
                if (!$this->aCanton->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aCanton->getValidationFailures());
                }
            }

            if ($this->aSector !== null) {
                if (!$this->aSector->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aSector->getValidationFailures());
                }
            }

            if ($this->aMaquinaria !== null) {
                if (!$this->aMaquinaria->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aMaquinaria->getValidationFailures());
                }
            }

            if ($this->aBodega !== null) {
                if (!$this->aBodega->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aBodega->getValidationFailures());
                }
            }


            if (($retval = ControlPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }



            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = ControlPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getCantonId();
                break;
            case 2:
                return $this->getSectorId();
                break;
            case 3:
                return $this->getCantidadCamionadasSector();
                break;
            case 4:
                return $this->getPrecioDieselSector();
                break;
            case 5:
                return $this->getGalonesDieselSector();
                break;
            case 6:
                return $this->getDiasCantidadSector();
                break;
            case 7:
                return $this->getHorasDiariasSector();
                break;
            case 8:
                return $this->getHorasTotalSector();
                break;
            case 9:
                return $this->getGrosorBalastoSector();
                break;
            case 10:
                return $this->getRepacarionSector();
                break;
            case 11:
                return $this->getMaquinariaId();
                break;
            case 12:
                return $this->getBodegaId();
                break;
            case 13:
                return $this->getObservaciones();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Control'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Control'][$this->getPrimaryKey()] = true;
        $keys = ControlPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getCantonId(),
            $keys[2] => $this->getSectorId(),
            $keys[3] => $this->getCantidadCamionadasSector(),
            $keys[4] => $this->getPrecioDieselSector(),
            $keys[5] => $this->getGalonesDieselSector(),
            $keys[6] => $this->getDiasCantidadSector(),
            $keys[7] => $this->getHorasDiariasSector(),
            $keys[8] => $this->getHorasTotalSector(),
            $keys[9] => $this->getGrosorBalastoSector(),
            $keys[10] => $this->getRepacarionSector(),
            $keys[11] => $this->getMaquinariaId(),
            $keys[12] => $this->getBodegaId(),
            $keys[13] => $this->getObservaciones(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCanton) {
                $result['Canton'] = $this->aCanton->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSector) {
                $result['Sector'] = $this->aSector->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aMaquinaria) {
                $result['Maquinaria'] = $this->aMaquinaria->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aBodega) {
                $result['Bodega'] = $this->aBodega->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = ControlPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setCantonId($value);
                break;
            case 2:
                $this->setSectorId($value);
                break;
            case 3:
                $this->setCantidadCamionadasSector($value);
                break;
            case 4:
                $this->setPrecioDieselSector($value);
                break;
            case 5:
                $this->setGalonesDieselSector($value);
                break;
            case 6:
                $this->setDiasCantidadSector($value);
                break;
            case 7:
                $this->setHorasDiariasSector($value);
                break;
            case 8:
                $this->setHorasTotalSector($value);
                break;
            case 9:
                $this->setGrosorBalastoSector($value);
                break;
            case 10:
                $this->setRepacarionSector($value);
                break;
            case 11:
                $this->setMaquinariaId($value);
                break;
            case 12:
                $this->setBodegaId($value);
                break;
            case 13:
                $this->setObservaciones($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = ControlPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setCantonId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setSectorId($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setCantidadCamionadasSector($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setPrecioDieselSector($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setGalonesDieselSector($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setDiasCantidadSector($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setHorasDiariasSector($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setHorasTotalSector($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setGrosorBalastoSector($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setRepacarionSector($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setMaquinariaId($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setBodegaId($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setObservaciones($arr[$keys[13]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ControlPeer::DATABASE_NAME);

        if ($this->isColumnModified(ControlPeer::ID)) $criteria->add(ControlPeer::ID, $this->id);
        if ($this->isColumnModified(ControlPeer::CANTON_ID)) $criteria->add(ControlPeer::CANTON_ID, $this->canton_id);
        if ($this->isColumnModified(ControlPeer::SECTOR_ID)) $criteria->add(ControlPeer::SECTOR_ID, $this->sector_id);
        if ($this->isColumnModified(ControlPeer::CANTIDAD_CAMIONADAS_SECTOR)) $criteria->add(ControlPeer::CANTIDAD_CAMIONADAS_SECTOR, $this->cantidad_camionadas_sector);
        if ($this->isColumnModified(ControlPeer::PRECIO_DIESEL_SECTOR)) $criteria->add(ControlPeer::PRECIO_DIESEL_SECTOR, $this->precio_diesel_sector);
        if ($this->isColumnModified(ControlPeer::GALONES_DIESEL_SECTOR)) $criteria->add(ControlPeer::GALONES_DIESEL_SECTOR, $this->galones_diesel_sector);
        if ($this->isColumnModified(ControlPeer::DIAS_CANTIDAD_SECTOR)) $criteria->add(ControlPeer::DIAS_CANTIDAD_SECTOR, $this->dias_cantidad_sector);
        if ($this->isColumnModified(ControlPeer::HORAS_DIARIAS_SECTOR)) $criteria->add(ControlPeer::HORAS_DIARIAS_SECTOR, $this->horas_diarias_sector);
        if ($this->isColumnModified(ControlPeer::HORAS_TOTAL_SECTOR)) $criteria->add(ControlPeer::HORAS_TOTAL_SECTOR, $this->horas_total_sector);
        if ($this->isColumnModified(ControlPeer::GROSOR_BALASTO_SECTOR)) $criteria->add(ControlPeer::GROSOR_BALASTO_SECTOR, $this->grosor_balasto_sector);
        if ($this->isColumnModified(ControlPeer::REPACARION_SECTOR)) $criteria->add(ControlPeer::REPACARION_SECTOR, $this->repacarion_sector);
        if ($this->isColumnModified(ControlPeer::MAQUINARIA_ID)) $criteria->add(ControlPeer::MAQUINARIA_ID, $this->maquinaria_id);
        if ($this->isColumnModified(ControlPeer::BODEGA_ID)) $criteria->add(ControlPeer::BODEGA_ID, $this->bodega_id);
        if ($this->isColumnModified(ControlPeer::OBSERVACIONES)) $criteria->add(ControlPeer::OBSERVACIONES, $this->observaciones);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(ControlPeer::DATABASE_NAME);
        $criteria->add(ControlPeer::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Control (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCantonId($this->getCantonId());
        $copyObj->setSectorId($this->getSectorId());
        $copyObj->setCantidadCamionadasSector($this->getCantidadCamionadasSector());
        $copyObj->setPrecioDieselSector($this->getPrecioDieselSector());
        $copyObj->setGalonesDieselSector($this->getGalonesDieselSector());
        $copyObj->setDiasCantidadSector($this->getDiasCantidadSector());
        $copyObj->setHorasDiariasSector($this->getHorasDiariasSector());
        $copyObj->setHorasTotalSector($this->getHorasTotalSector());
        $copyObj->setGrosorBalastoSector($this->getGrosorBalastoSector());
        $copyObj->setRepacarionSector($this->getRepacarionSector());
        $copyObj->setMaquinariaId($this->getMaquinariaId());
        $copyObj->setBodegaId($this->getBodegaId());
        $copyObj->setObservaciones($this->getObservaciones());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Control Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return ControlPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new ControlPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Canton object.
     *
     * @param                  Canton $v
     * @return Control The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCanton(Canton $v = null)
    {
        if ($v === null) {
            $this->setCantonId(NULL);
        } else {
            $this->setCantonId($v->getId());
        }

        $this->aCanton = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Canton object, it will not be re-added.
        if ($v !== null) {
            $v->addControl($this);
        }


        return $this;
    }


    /**
     * Get the associated Canton object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Canton The associated Canton object.
     * @throws PropelException
     */
    public function getCanton(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aCanton === null && ($this->canton_id !== null) && $doQuery) {
            $this->aCanton = CantonQuery::create()->findPk($this->canton_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCanton->addControls($this);
             */
        }

        return $this->aCanton;
    }

    /**
     * Declares an association between this object and a Sector object.
     *
     * @param                  Sector $v
     * @return Control The current object (for fluent API support)
     * @throws PropelException
     */
    public function setSector(Sector $v = null)
    {
        if ($v === null) {
            $this->setSectorId(NULL);
        } else {
            $this->setSectorId($v->getId());
        }

        $this->aSector = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Sector object, it will not be re-added.
        if ($v !== null) {
            $v->addControl($this);
        }


        return $this;
    }


    /**
     * Get the associated Sector object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Sector The associated Sector object.
     * @throws PropelException
     */
    public function getSector(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aSector === null && ($this->sector_id !== null) && $doQuery) {
            $this->aSector = SectorQuery::create()->findPk($this->sector_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSector->addControls($this);
             */
        }

        return $this->aSector;
    }

    /**
     * Declares an association between this object and a Maquinaria object.
     *
     * @param                  Maquinaria $v
     * @return Control The current object (for fluent API support)
     * @throws PropelException
     */
    public function setMaquinaria(Maquinaria $v = null)
    {
        if ($v === null) {
            $this->setMaquinariaId(NULL);
        } else {
            $this->setMaquinariaId($v->getId());
        }

        $this->aMaquinaria = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Maquinaria object, it will not be re-added.
        if ($v !== null) {
            $v->addControl($this);
        }


        return $this;
    }


    /**
     * Get the associated Maquinaria object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Maquinaria The associated Maquinaria object.
     * @throws PropelException
     */
    public function getMaquinaria(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aMaquinaria === null && (($this->maquinaria_id !== "" && $this->maquinaria_id !== null)) && $doQuery) {
            $this->aMaquinaria = MaquinariaQuery::create()->findPk($this->maquinaria_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aMaquinaria->addControls($this);
             */
        }

        return $this->aMaquinaria;
    }

    /**
     * Declares an association between this object and a Bodega object.
     *
     * @param                  Bodega $v
     * @return Control The current object (for fluent API support)
     * @throws PropelException
     */
    public function setBodega(Bodega $v = null)
    {
        if ($v === null) {
            $this->setBodegaId(NULL);
        } else {
            $this->setBodegaId($v->getId());
        }

        $this->aBodega = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Bodega object, it will not be re-added.
        if ($v !== null) {
            $v->addControl($this);
        }


        return $this;
    }


    /**
     * Get the associated Bodega object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Bodega The associated Bodega object.
     * @throws PropelException
     */
    public function getBodega(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aBodega === null && (($this->bodega_id !== "" && $this->bodega_id !== null)) && $doQuery) {
            $this->aBodega = BodegaQuery::create()->findPk($this->bodega_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBodega->addControls($this);
             */
        }

        return $this->aBodega;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->canton_id = null;
        $this->sector_id = null;
        $this->cantidad_camionadas_sector = null;
        $this->precio_diesel_sector = null;
        $this->galones_diesel_sector = null;
        $this->dias_cantidad_sector = null;
        $this->horas_diarias_sector = null;
        $this->horas_total_sector = null;
        $this->grosor_balasto_sector = null;
        $this->repacarion_sector = null;
        $this->maquinaria_id = null;
        $this->bodega_id = null;
        $this->observaciones = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->aCanton instanceof Persistent) {
              $this->aCanton->clearAllReferences($deep);
            }
            if ($this->aSector instanceof Persistent) {
              $this->aSector->clearAllReferences($deep);
            }
            if ($this->aMaquinaria instanceof Persistent) {
              $this->aMaquinaria->clearAllReferences($deep);
            }
            if ($this->aBodega instanceof Persistent) {
              $this->aBodega->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        $this->aCanton = null;
        $this->aSector = null;
        $this->aMaquinaria = null;
        $this->aBodega = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ControlPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
