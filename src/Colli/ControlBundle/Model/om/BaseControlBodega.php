<?php

namespace Colli\ControlBundle\Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \DateTime;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelDateTime;
use \PropelException;
use \PropelPDO;
use Colli\ControlBundle\Model\Bodega;
use Colli\ControlBundle\Model\BodegaQuery;
use Colli\ControlBundle\Model\Canton;
use Colli\ControlBundle\Model\CantonQuery;
use Colli\ControlBundle\Model\ControlBodega;
use Colli\ControlBundle\Model\ControlBodegaPeer;
use Colli\ControlBundle\Model\ControlBodegaQuery;
use Colli\ControlBundle\Model\Maquinaria;
use Colli\ControlBundle\Model\MaquinariaQuery;
use Colli\ControlBundle\Model\Sector;
use Colli\ControlBundle\Model\SectorQuery;

abstract class BaseControlBodega extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Colli\\ControlBundle\\Model\\ControlBodegaPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        ControlBodegaPeer
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
     * The value for the bodega_id field.
     * @var        int
     */
    protected $bodega_id;

    /**
     * The value for the fecha_retiro field.
     * @var        string
     */
    protected $fecha_retiro;

    /**
     * The value for the maquinaria_id field.
     * @var        int
     */
    protected $maquinaria_id;

    /**
     * The value for the fecha_ingreso field.
     * @var        string
     */
    protected $fecha_ingreso;

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
     * Get the [bodega_id] column value.
     *
     * @return int
     */
    public function getBodegaId()
    {

        return $this->bodega_id;
    }

    /**
     * Get the [optionally formatted] temporal [fecha_retiro] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaRetiro($format = null)
    {
        if ($this->fecha_retiro === null) {
            return null;
        }

        if ($this->fecha_retiro === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->fecha_retiro);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->fecha_retiro, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [maquinaria_id] column value.
     *
     * @return int
     */
    public function getMaquinariaId()
    {

        return $this->maquinaria_id;
    }

    /**
     * Get the [optionally formatted] temporal [fecha_ingreso] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaIngreso($format = null)
    {
        if ($this->fecha_ingreso === null) {
            return null;
        }

        if ($this->fecha_ingreso === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->fecha_ingreso);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->fecha_ingreso, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

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
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return ControlBodega The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = ControlBodegaPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [bodega_id] column.
     *
     * @param  int $v new value
     * @return ControlBodega The current object (for fluent API support)
     */
    public function setBodegaId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->bodega_id !== $v) {
            $this->bodega_id = $v;
            $this->modifiedColumns[] = ControlBodegaPeer::BODEGA_ID;
        }

        if ($this->aBodega !== null && $this->aBodega->getId() !== $v) {
            $this->aBodega = null;
        }


        return $this;
    } // setBodegaId()

    /**
     * Sets the value of [fecha_retiro] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return ControlBodega The current object (for fluent API support)
     */
    public function setFechaRetiro($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_retiro !== null || $dt !== null) {
            $currentDateAsString = ($this->fecha_retiro !== null && $tmpDt = new DateTime($this->fecha_retiro)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->fecha_retiro = $newDateAsString;
                $this->modifiedColumns[] = ControlBodegaPeer::FECHA_RETIRO;
            }
        } // if either are not null


        return $this;
    } // setFechaRetiro()

    /**
     * Set the value of [maquinaria_id] column.
     *
     * @param  int $v new value
     * @return ControlBodega The current object (for fluent API support)
     */
    public function setMaquinariaId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->maquinaria_id !== $v) {
            $this->maquinaria_id = $v;
            $this->modifiedColumns[] = ControlBodegaPeer::MAQUINARIA_ID;
        }

        if ($this->aMaquinaria !== null && $this->aMaquinaria->getId() !== $v) {
            $this->aMaquinaria = null;
        }


        return $this;
    } // setMaquinariaId()

    /**
     * Sets the value of [fecha_ingreso] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return ControlBodega The current object (for fluent API support)
     */
    public function setFechaIngreso($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_ingreso !== null || $dt !== null) {
            $currentDateAsString = ($this->fecha_ingreso !== null && $tmpDt = new DateTime($this->fecha_ingreso)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->fecha_ingreso = $newDateAsString;
                $this->modifiedColumns[] = ControlBodegaPeer::FECHA_INGRESO;
            }
        } // if either are not null


        return $this;
    } // setFechaIngreso()

    /**
     * Set the value of [canton_id] column.
     *
     * @param  int $v new value
     * @return ControlBodega The current object (for fluent API support)
     */
    public function setCantonId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->canton_id !== $v) {
            $this->canton_id = $v;
            $this->modifiedColumns[] = ControlBodegaPeer::CANTON_ID;
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
     * @return ControlBodega The current object (for fluent API support)
     */
    public function setSectorId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->sector_id !== $v) {
            $this->sector_id = $v;
            $this->modifiedColumns[] = ControlBodegaPeer::SECTOR_ID;
        }

        if ($this->aSector !== null && $this->aSector->getId() !== $v) {
            $this->aSector = null;
        }


        return $this;
    } // setSectorId()

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
            $this->bodega_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->fecha_retiro = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->maquinaria_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->fecha_ingreso = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->canton_id = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->sector_id = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 7; // 7 = ControlBodegaPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating ControlBodega object", $e);
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

        if ($this->aBodega !== null && $this->bodega_id !== $this->aBodega->getId()) {
            $this->aBodega = null;
        }
        if ($this->aMaquinaria !== null && $this->maquinaria_id !== $this->aMaquinaria->getId()) {
            $this->aMaquinaria = null;
        }
        if ($this->aCanton !== null && $this->canton_id !== $this->aCanton->getId()) {
            $this->aCanton = null;
        }
        if ($this->aSector !== null && $this->sector_id !== $this->aSector->getId()) {
            $this->aSector = null;
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
            $con = Propel::getConnection(ControlBodegaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = ControlBodegaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
            $con = Propel::getConnection(ControlBodegaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ControlBodegaQuery::create()
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
            $con = Propel::getConnection(ControlBodegaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                ControlBodegaPeer::addInstanceToPool($this);
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

        $this->modifiedColumns[] = ControlBodegaPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ControlBodegaPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ControlBodegaPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(ControlBodegaPeer::BODEGA_ID)) {
            $modifiedColumns[':p' . $index++]  = '`bodega_id`';
        }
        if ($this->isColumnModified(ControlBodegaPeer::FECHA_RETIRO)) {
            $modifiedColumns[':p' . $index++]  = '`fecha_retiro`';
        }
        if ($this->isColumnModified(ControlBodegaPeer::MAQUINARIA_ID)) {
            $modifiedColumns[':p' . $index++]  = '`maquinaria_id`';
        }
        if ($this->isColumnModified(ControlBodegaPeer::FECHA_INGRESO)) {
            $modifiedColumns[':p' . $index++]  = '`fecha_ingreso`';
        }
        if ($this->isColumnModified(ControlBodegaPeer::CANTON_ID)) {
            $modifiedColumns[':p' . $index++]  = '`canton_id`';
        }
        if ($this->isColumnModified(ControlBodegaPeer::SECTOR_ID)) {
            $modifiedColumns[':p' . $index++]  = '`sector_id`';
        }

        $sql = sprintf(
            'INSERT INTO `control_bodega` (%s) VALUES (%s)',
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
                    case '`bodega_id`':
                        $stmt->bindValue($identifier, $this->bodega_id, PDO::PARAM_INT);
                        break;
                    case '`fecha_retiro`':
                        $stmt->bindValue($identifier, $this->fecha_retiro, PDO::PARAM_STR);
                        break;
                    case '`maquinaria_id`':
                        $stmt->bindValue($identifier, $this->maquinaria_id, PDO::PARAM_INT);
                        break;
                    case '`fecha_ingreso`':
                        $stmt->bindValue($identifier, $this->fecha_ingreso, PDO::PARAM_STR);
                        break;
                    case '`canton_id`':
                        $stmt->bindValue($identifier, $this->canton_id, PDO::PARAM_INT);
                        break;
                    case '`sector_id`':
                        $stmt->bindValue($identifier, $this->sector_id, PDO::PARAM_INT);
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


            if (($retval = ControlBodegaPeer::doValidate($this, $columns)) !== true) {
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
        $pos = ControlBodegaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getBodegaId();
                break;
            case 2:
                return $this->getFechaRetiro();
                break;
            case 3:
                return $this->getMaquinariaId();
                break;
            case 4:
                return $this->getFechaIngreso();
                break;
            case 5:
                return $this->getCantonId();
                break;
            case 6:
                return $this->getSectorId();
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
        if (isset($alreadyDumpedObjects['ControlBodega'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['ControlBodega'][$this->getPrimaryKey()] = true;
        $keys = ControlBodegaPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getBodegaId(),
            $keys[2] => $this->getFechaRetiro(),
            $keys[3] => $this->getMaquinariaId(),
            $keys[4] => $this->getFechaIngreso(),
            $keys[5] => $this->getCantonId(),
            $keys[6] => $this->getSectorId(),
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
        $pos = ControlBodegaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setBodegaId($value);
                break;
            case 2:
                $this->setFechaRetiro($value);
                break;
            case 3:
                $this->setMaquinariaId($value);
                break;
            case 4:
                $this->setFechaIngreso($value);
                break;
            case 5:
                $this->setCantonId($value);
                break;
            case 6:
                $this->setSectorId($value);
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
        $keys = ControlBodegaPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setBodegaId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setFechaRetiro($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setMaquinariaId($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setFechaIngreso($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setCantonId($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setSectorId($arr[$keys[6]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ControlBodegaPeer::DATABASE_NAME);

        if ($this->isColumnModified(ControlBodegaPeer::ID)) $criteria->add(ControlBodegaPeer::ID, $this->id);
        if ($this->isColumnModified(ControlBodegaPeer::BODEGA_ID)) $criteria->add(ControlBodegaPeer::BODEGA_ID, $this->bodega_id);
        if ($this->isColumnModified(ControlBodegaPeer::FECHA_RETIRO)) $criteria->add(ControlBodegaPeer::FECHA_RETIRO, $this->fecha_retiro);
        if ($this->isColumnModified(ControlBodegaPeer::MAQUINARIA_ID)) $criteria->add(ControlBodegaPeer::MAQUINARIA_ID, $this->maquinaria_id);
        if ($this->isColumnModified(ControlBodegaPeer::FECHA_INGRESO)) $criteria->add(ControlBodegaPeer::FECHA_INGRESO, $this->fecha_ingreso);
        if ($this->isColumnModified(ControlBodegaPeer::CANTON_ID)) $criteria->add(ControlBodegaPeer::CANTON_ID, $this->canton_id);
        if ($this->isColumnModified(ControlBodegaPeer::SECTOR_ID)) $criteria->add(ControlBodegaPeer::SECTOR_ID, $this->sector_id);

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
        $criteria = new Criteria(ControlBodegaPeer::DATABASE_NAME);
        $criteria->add(ControlBodegaPeer::ID, $this->id);

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
     * @param object $copyObj An object of ControlBodega (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setBodegaId($this->getBodegaId());
        $copyObj->setFechaRetiro($this->getFechaRetiro());
        $copyObj->setMaquinariaId($this->getMaquinariaId());
        $copyObj->setFechaIngreso($this->getFechaIngreso());
        $copyObj->setCantonId($this->getCantonId());
        $copyObj->setSectorId($this->getSectorId());

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
     * @return ControlBodega Clone of current object.
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
     * @return ControlBodegaPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new ControlBodegaPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Canton object.
     *
     * @param                  Canton $v
     * @return ControlBodega The current object (for fluent API support)
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
            $v->addControlBodega($this);
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
                $this->aCanton->addControlBodegas($this);
             */
        }

        return $this->aCanton;
    }

    /**
     * Declares an association between this object and a Sector object.
     *
     * @param                  Sector $v
     * @return ControlBodega The current object (for fluent API support)
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
            $v->addControlBodega($this);
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
                $this->aSector->addControlBodegas($this);
             */
        }

        return $this->aSector;
    }

    /**
     * Declares an association between this object and a Maquinaria object.
     *
     * @param                  Maquinaria $v
     * @return ControlBodega The current object (for fluent API support)
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
            $v->addControlBodega($this);
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
        if ($this->aMaquinaria === null && ($this->maquinaria_id !== null) && $doQuery) {
            $this->aMaquinaria = MaquinariaQuery::create()->findPk($this->maquinaria_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aMaquinaria->addControlBodegas($this);
             */
        }

        return $this->aMaquinaria;
    }

    /**
     * Declares an association between this object and a Bodega object.
     *
     * @param                  Bodega $v
     * @return ControlBodega The current object (for fluent API support)
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
            $v->addControlBodega($this);
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
        if ($this->aBodega === null && ($this->bodega_id !== null) && $doQuery) {
            $this->aBodega = BodegaQuery::create()->findPk($this->bodega_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBodega->addControlBodegas($this);
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
        $this->bodega_id = null;
        $this->fecha_retiro = null;
        $this->maquinaria_id = null;
        $this->fecha_ingreso = null;
        $this->canton_id = null;
        $this->sector_id = null;
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
        return (string) $this->exportTo(ControlBodegaPeer::DEFAULT_STRING_FORMAT);
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
