<?php

namespace Colli\ControlBundle\Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Colli\ControlBundle\Model\Bodega;
use Colli\ControlBundle\Model\BodegaPeer;
use Colli\ControlBundle\Model\BodegaQuery;
use Colli\ControlBundle\Model\Control;
use Colli\ControlBundle\Model\ControlBodega;
use Colli\ControlBundle\Model\ControlBodegaQuery;
use Colli\ControlBundle\Model\ControlQuery;

abstract class BaseBodega extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Colli\\ControlBundle\\Model\\BodegaPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        BodegaPeer
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
     * The value for the descripcion field.
     * @var        string
     */
    protected $descripcion;

    /**
     * The value for the cantidad field.
     * @var        int
     */
    protected $cantidad;

    /**
     * The value for the precio field.
     * @var        int
     */
    protected $precio;

    /**
     * @var        PropelObjectCollection|ControlBodega[] Collection to store aggregation of ControlBodega objects.
     */
    protected $collControlBodegas;
    protected $collControlBodegasPartial;

    /**
     * @var        PropelObjectCollection|Control[] Collection to store aggregation of Control objects.
     */
    protected $collControls;
    protected $collControlsPartial;

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
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $controlBodegasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $controlsScheduledForDeletion = null;

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
     * Get the [descripcion] column value.
     *
     * @return string
     */
    public function getDescripcion()
    {

        return $this->descripcion;
    }

    /**
     * Get the [cantidad] column value.
     *
     * @return int
     */
    public function getCantidad()
    {

        return $this->cantidad;
    }

    /**
     * Get the [precio] column value.
     *
     * @return int
     */
    public function getPrecio()
    {

        return $this->precio;
    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return Bodega The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = BodegaPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [descripcion] column.
     *
     * @param  string $v new value
     * @return Bodega The current object (for fluent API support)
     */
    public function setDescripcion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->descripcion !== $v) {
            $this->descripcion = $v;
            $this->modifiedColumns[] = BodegaPeer::DESCRIPCION;
        }


        return $this;
    } // setDescripcion()

    /**
     * Set the value of [cantidad] column.
     *
     * @param  int $v new value
     * @return Bodega The current object (for fluent API support)
     */
    public function setCantidad($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->cantidad !== $v) {
            $this->cantidad = $v;
            $this->modifiedColumns[] = BodegaPeer::CANTIDAD;
        }


        return $this;
    } // setCantidad()

    /**
     * Set the value of [precio] column.
     *
     * @param  int $v new value
     * @return Bodega The current object (for fluent API support)
     */
    public function setPrecio($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->precio !== $v) {
            $this->precio = $v;
            $this->modifiedColumns[] = BodegaPeer::PRECIO;
        }


        return $this;
    } // setPrecio()

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
            $this->descripcion = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->cantidad = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->precio = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 4; // 4 = BodegaPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Bodega object", $e);
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
            $con = Propel::getConnection(BodegaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = BodegaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collControlBodegas = null;

            $this->collControls = null;

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
            $con = Propel::getConnection(BodegaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = BodegaQuery::create()
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
            $con = Propel::getConnection(BodegaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                BodegaPeer::addInstanceToPool($this);
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

            if ($this->controlBodegasScheduledForDeletion !== null) {
                if (!$this->controlBodegasScheduledForDeletion->isEmpty()) {
                    foreach ($this->controlBodegasScheduledForDeletion as $controlBodega) {
                        // need to save related object because we set the relation to null
                        $controlBodega->save($con);
                    }
                    $this->controlBodegasScheduledForDeletion = null;
                }
            }

            if ($this->collControlBodegas !== null) {
                foreach ($this->collControlBodegas as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->controlsScheduledForDeletion !== null) {
                if (!$this->controlsScheduledForDeletion->isEmpty()) {
                    foreach ($this->controlsScheduledForDeletion as $control) {
                        // need to save related object because we set the relation to null
                        $control->save($con);
                    }
                    $this->controlsScheduledForDeletion = null;
                }
            }

            if ($this->collControls !== null) {
                foreach ($this->collControls as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

        $this->modifiedColumns[] = BodegaPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BodegaPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BodegaPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(BodegaPeer::DESCRIPCION)) {
            $modifiedColumns[':p' . $index++]  = '`descripcion`';
        }
        if ($this->isColumnModified(BodegaPeer::CANTIDAD)) {
            $modifiedColumns[':p' . $index++]  = '`cantidad`';
        }
        if ($this->isColumnModified(BodegaPeer::PRECIO)) {
            $modifiedColumns[':p' . $index++]  = '`precio`';
        }

        $sql = sprintf(
            'INSERT INTO `bodega` (%s) VALUES (%s)',
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
                    case '`descripcion`':
                        $stmt->bindValue($identifier, $this->descripcion, PDO::PARAM_STR);
                        break;
                    case '`cantidad`':
                        $stmt->bindValue($identifier, $this->cantidad, PDO::PARAM_INT);
                        break;
                    case '`precio`':
                        $stmt->bindValue($identifier, $this->precio, PDO::PARAM_INT);
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


            if (($retval = BodegaPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collControlBodegas !== null) {
                    foreach ($this->collControlBodegas as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collControls !== null) {
                    foreach ($this->collControls as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
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
        $pos = BodegaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getDescripcion();
                break;
            case 2:
                return $this->getCantidad();
                break;
            case 3:
                return $this->getPrecio();
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
        if (isset($alreadyDumpedObjects['Bodega'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Bodega'][$this->getPrimaryKey()] = true;
        $keys = BodegaPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getDescripcion(),
            $keys[2] => $this->getCantidad(),
            $keys[3] => $this->getPrecio(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collControlBodegas) {
                $result['ControlBodegas'] = $this->collControlBodegas->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collControls) {
                $result['Controls'] = $this->collControls->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = BodegaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setDescripcion($value);
                break;
            case 2:
                $this->setCantidad($value);
                break;
            case 3:
                $this->setPrecio($value);
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
        $keys = BodegaPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setDescripcion($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setCantidad($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setPrecio($arr[$keys[3]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(BodegaPeer::DATABASE_NAME);

        if ($this->isColumnModified(BodegaPeer::ID)) $criteria->add(BodegaPeer::ID, $this->id);
        if ($this->isColumnModified(BodegaPeer::DESCRIPCION)) $criteria->add(BodegaPeer::DESCRIPCION, $this->descripcion);
        if ($this->isColumnModified(BodegaPeer::CANTIDAD)) $criteria->add(BodegaPeer::CANTIDAD, $this->cantidad);
        if ($this->isColumnModified(BodegaPeer::PRECIO)) $criteria->add(BodegaPeer::PRECIO, $this->precio);

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
        $criteria = new Criteria(BodegaPeer::DATABASE_NAME);
        $criteria->add(BodegaPeer::ID, $this->id);

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
     * @param object $copyObj An object of Bodega (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setDescripcion($this->getDescripcion());
        $copyObj->setCantidad($this->getCantidad());
        $copyObj->setPrecio($this->getPrecio());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getControlBodegas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addControlBodega($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getControls() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addControl($relObj->copy($deepCopy));
                }
            }

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
     * @return Bodega Clone of current object.
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
     * @return BodegaPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new BodegaPeer();
        }

        return self::$peer;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('ControlBodega' == $relationName) {
            $this->initControlBodegas();
        }
        if ('Control' == $relationName) {
            $this->initControls();
        }
    }

    /**
     * Clears out the collControlBodegas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Bodega The current object (for fluent API support)
     * @see        addControlBodegas()
     */
    public function clearControlBodegas()
    {
        $this->collControlBodegas = null; // important to set this to null since that means it is uninitialized
        $this->collControlBodegasPartial = null;

        return $this;
    }

    /**
     * reset is the collControlBodegas collection loaded partially
     *
     * @return void
     */
    public function resetPartialControlBodegas($v = true)
    {
        $this->collControlBodegasPartial = $v;
    }

    /**
     * Initializes the collControlBodegas collection.
     *
     * By default this just sets the collControlBodegas collection to an empty array (like clearcollControlBodegas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initControlBodegas($overrideExisting = true)
    {
        if (null !== $this->collControlBodegas && !$overrideExisting) {
            return;
        }
        $this->collControlBodegas = new PropelObjectCollection();
        $this->collControlBodegas->setModel('ControlBodega');
    }

    /**
     * Gets an array of ControlBodega objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Bodega is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ControlBodega[] List of ControlBodega objects
     * @throws PropelException
     */
    public function getControlBodegas($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collControlBodegasPartial && !$this->isNew();
        if (null === $this->collControlBodegas || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collControlBodegas) {
                // return empty collection
                $this->initControlBodegas();
            } else {
                $collControlBodegas = ControlBodegaQuery::create(null, $criteria)
                    ->filterByBodega($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collControlBodegasPartial && count($collControlBodegas)) {
                      $this->initControlBodegas(false);

                      foreach ($collControlBodegas as $obj) {
                        if (false == $this->collControlBodegas->contains($obj)) {
                          $this->collControlBodegas->append($obj);
                        }
                      }

                      $this->collControlBodegasPartial = true;
                    }

                    $collControlBodegas->getInternalIterator()->rewind();

                    return $collControlBodegas;
                }

                if ($partial && $this->collControlBodegas) {
                    foreach ($this->collControlBodegas as $obj) {
                        if ($obj->isNew()) {
                            $collControlBodegas[] = $obj;
                        }
                    }
                }

                $this->collControlBodegas = $collControlBodegas;
                $this->collControlBodegasPartial = false;
            }
        }

        return $this->collControlBodegas;
    }

    /**
     * Sets a collection of ControlBodega objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $controlBodegas A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Bodega The current object (for fluent API support)
     */
    public function setControlBodegas(PropelCollection $controlBodegas, PropelPDO $con = null)
    {
        $controlBodegasToDelete = $this->getControlBodegas(new Criteria(), $con)->diff($controlBodegas);


        $this->controlBodegasScheduledForDeletion = $controlBodegasToDelete;

        foreach ($controlBodegasToDelete as $controlBodegaRemoved) {
            $controlBodegaRemoved->setBodega(null);
        }

        $this->collControlBodegas = null;
        foreach ($controlBodegas as $controlBodega) {
            $this->addControlBodega($controlBodega);
        }

        $this->collControlBodegas = $controlBodegas;
        $this->collControlBodegasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ControlBodega objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ControlBodega objects.
     * @throws PropelException
     */
    public function countControlBodegas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collControlBodegasPartial && !$this->isNew();
        if (null === $this->collControlBodegas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collControlBodegas) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getControlBodegas());
            }
            $query = ControlBodegaQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBodega($this)
                ->count($con);
        }

        return count($this->collControlBodegas);
    }

    /**
     * Method called to associate a ControlBodega object to this object
     * through the ControlBodega foreign key attribute.
     *
     * @param    ControlBodega $l ControlBodega
     * @return Bodega The current object (for fluent API support)
     */
    public function addControlBodega(ControlBodega $l)
    {
        if ($this->collControlBodegas === null) {
            $this->initControlBodegas();
            $this->collControlBodegasPartial = true;
        }

        if (!in_array($l, $this->collControlBodegas->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddControlBodega($l);

            if ($this->controlBodegasScheduledForDeletion and $this->controlBodegasScheduledForDeletion->contains($l)) {
                $this->controlBodegasScheduledForDeletion->remove($this->controlBodegasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	ControlBodega $controlBodega The controlBodega object to add.
     */
    protected function doAddControlBodega($controlBodega)
    {
        $this->collControlBodegas[]= $controlBodega;
        $controlBodega->setBodega($this);
    }

    /**
     * @param	ControlBodega $controlBodega The controlBodega object to remove.
     * @return Bodega The current object (for fluent API support)
     */
    public function removeControlBodega($controlBodega)
    {
        if ($this->getControlBodegas()->contains($controlBodega)) {
            $this->collControlBodegas->remove($this->collControlBodegas->search($controlBodega));
            if (null === $this->controlBodegasScheduledForDeletion) {
                $this->controlBodegasScheduledForDeletion = clone $this->collControlBodegas;
                $this->controlBodegasScheduledForDeletion->clear();
            }
            $this->controlBodegasScheduledForDeletion[]= $controlBodega;
            $controlBodega->setBodega(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Bodega is new, it will return
     * an empty collection; or if this Bodega has previously
     * been saved, it will retrieve related ControlBodegas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Bodega.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ControlBodega[] List of ControlBodega objects
     */
    public function getControlBodegasJoinCanton($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ControlBodegaQuery::create(null, $criteria);
        $query->joinWith('Canton', $join_behavior);

        return $this->getControlBodegas($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Bodega is new, it will return
     * an empty collection; or if this Bodega has previously
     * been saved, it will retrieve related ControlBodegas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Bodega.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ControlBodega[] List of ControlBodega objects
     */
    public function getControlBodegasJoinSector($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ControlBodegaQuery::create(null, $criteria);
        $query->joinWith('Sector', $join_behavior);

        return $this->getControlBodegas($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Bodega is new, it will return
     * an empty collection; or if this Bodega has previously
     * been saved, it will retrieve related ControlBodegas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Bodega.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ControlBodega[] List of ControlBodega objects
     */
    public function getControlBodegasJoinMaquinaria($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ControlBodegaQuery::create(null, $criteria);
        $query->joinWith('Maquinaria', $join_behavior);

        return $this->getControlBodegas($query, $con);
    }

    /**
     * Clears out the collControls collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Bodega The current object (for fluent API support)
     * @see        addControls()
     */
    public function clearControls()
    {
        $this->collControls = null; // important to set this to null since that means it is uninitialized
        $this->collControlsPartial = null;

        return $this;
    }

    /**
     * reset is the collControls collection loaded partially
     *
     * @return void
     */
    public function resetPartialControls($v = true)
    {
        $this->collControlsPartial = $v;
    }

    /**
     * Initializes the collControls collection.
     *
     * By default this just sets the collControls collection to an empty array (like clearcollControls());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initControls($overrideExisting = true)
    {
        if (null !== $this->collControls && !$overrideExisting) {
            return;
        }
        $this->collControls = new PropelObjectCollection();
        $this->collControls->setModel('Control');
    }

    /**
     * Gets an array of Control objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Bodega is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Control[] List of Control objects
     * @throws PropelException
     */
    public function getControls($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collControlsPartial && !$this->isNew();
        if (null === $this->collControls || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collControls) {
                // return empty collection
                $this->initControls();
            } else {
                $collControls = ControlQuery::create(null, $criteria)
                    ->filterByBodega($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collControlsPartial && count($collControls)) {
                      $this->initControls(false);

                      foreach ($collControls as $obj) {
                        if (false == $this->collControls->contains($obj)) {
                          $this->collControls->append($obj);
                        }
                      }

                      $this->collControlsPartial = true;
                    }

                    $collControls->getInternalIterator()->rewind();

                    return $collControls;
                }

                if ($partial && $this->collControls) {
                    foreach ($this->collControls as $obj) {
                        if ($obj->isNew()) {
                            $collControls[] = $obj;
                        }
                    }
                }

                $this->collControls = $collControls;
                $this->collControlsPartial = false;
            }
        }

        return $this->collControls;
    }

    /**
     * Sets a collection of Control objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $controls A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Bodega The current object (for fluent API support)
     */
    public function setControls(PropelCollection $controls, PropelPDO $con = null)
    {
        $controlsToDelete = $this->getControls(new Criteria(), $con)->diff($controls);


        $this->controlsScheduledForDeletion = $controlsToDelete;

        foreach ($controlsToDelete as $controlRemoved) {
            $controlRemoved->setBodega(null);
        }

        $this->collControls = null;
        foreach ($controls as $control) {
            $this->addControl($control);
        }

        $this->collControls = $controls;
        $this->collControlsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Control objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Control objects.
     * @throws PropelException
     */
    public function countControls(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collControlsPartial && !$this->isNew();
        if (null === $this->collControls || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collControls) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getControls());
            }
            $query = ControlQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBodega($this)
                ->count($con);
        }

        return count($this->collControls);
    }

    /**
     * Method called to associate a Control object to this object
     * through the Control foreign key attribute.
     *
     * @param    Control $l Control
     * @return Bodega The current object (for fluent API support)
     */
    public function addControl(Control $l)
    {
        if ($this->collControls === null) {
            $this->initControls();
            $this->collControlsPartial = true;
        }

        if (!in_array($l, $this->collControls->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddControl($l);

            if ($this->controlsScheduledForDeletion and $this->controlsScheduledForDeletion->contains($l)) {
                $this->controlsScheduledForDeletion->remove($this->controlsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	Control $control The control object to add.
     */
    protected function doAddControl($control)
    {
        $this->collControls[]= $control;
        $control->setBodega($this);
    }

    /**
     * @param	Control $control The control object to remove.
     * @return Bodega The current object (for fluent API support)
     */
    public function removeControl($control)
    {
        if ($this->getControls()->contains($control)) {
            $this->collControls->remove($this->collControls->search($control));
            if (null === $this->controlsScheduledForDeletion) {
                $this->controlsScheduledForDeletion = clone $this->collControls;
                $this->controlsScheduledForDeletion->clear();
            }
            $this->controlsScheduledForDeletion[]= $control;
            $control->setBodega(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Bodega is new, it will return
     * an empty collection; or if this Bodega has previously
     * been saved, it will retrieve related Controls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Bodega.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Control[] List of Control objects
     */
    public function getControlsJoinCanton($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ControlQuery::create(null, $criteria);
        $query->joinWith('Canton', $join_behavior);

        return $this->getControls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Bodega is new, it will return
     * an empty collection; or if this Bodega has previously
     * been saved, it will retrieve related Controls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Bodega.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Control[] List of Control objects
     */
    public function getControlsJoinSector($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ControlQuery::create(null, $criteria);
        $query->joinWith('Sector', $join_behavior);

        return $this->getControls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Bodega is new, it will return
     * an empty collection; or if this Bodega has previously
     * been saved, it will retrieve related Controls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Bodega.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Control[] List of Control objects
     */
    public function getControlsJoinMaquinaria($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ControlQuery::create(null, $criteria);
        $query->joinWith('Maquinaria', $join_behavior);

        return $this->getControls($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->descripcion = null;
        $this->cantidad = null;
        $this->precio = null;
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
            if ($this->collControlBodegas) {
                foreach ($this->collControlBodegas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collControls) {
                foreach ($this->collControls as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collControlBodegas instanceof PropelCollection) {
            $this->collControlBodegas->clearIterator();
        }
        $this->collControlBodegas = null;
        if ($this->collControls instanceof PropelCollection) {
            $this->collControls->clearIterator();
        }
        $this->collControls = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string The value of the 'descripcion' column
     */
    public function __toString()
    {
        return (string) $this->getDescripcion();
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
