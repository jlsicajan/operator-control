<?php

namespace Colli\ControlBundle\Model\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Colli\ControlBundle\Model\Bodega;
use Colli\ControlBundle\Model\Canton;
use Colli\ControlBundle\Model\ControlBodega;
use Colli\ControlBundle\Model\ControlBodegaPeer;
use Colli\ControlBundle\Model\ControlBodegaQuery;
use Colli\ControlBundle\Model\Maquinaria;
use Colli\ControlBundle\Model\Sector;

/**
 * @method ControlBodegaQuery orderById($order = Criteria::ASC) Order by the id column
 * @method ControlBodegaQuery orderByBodegaId($order = Criteria::ASC) Order by the bodega_id column
 * @method ControlBodegaQuery orderByFechaRetiro($order = Criteria::ASC) Order by the fecha_retiro column
 * @method ControlBodegaQuery orderByMaquinariaId($order = Criteria::ASC) Order by the maquinaria_id column
 * @method ControlBodegaQuery orderByFechaIngreso($order = Criteria::ASC) Order by the fecha_ingreso column
 * @method ControlBodegaQuery orderByCantonId($order = Criteria::ASC) Order by the canton_id column
 * @method ControlBodegaQuery orderBySectorId($order = Criteria::ASC) Order by the sector_id column
 *
 * @method ControlBodegaQuery groupById() Group by the id column
 * @method ControlBodegaQuery groupByBodegaId() Group by the bodega_id column
 * @method ControlBodegaQuery groupByFechaRetiro() Group by the fecha_retiro column
 * @method ControlBodegaQuery groupByMaquinariaId() Group by the maquinaria_id column
 * @method ControlBodegaQuery groupByFechaIngreso() Group by the fecha_ingreso column
 * @method ControlBodegaQuery groupByCantonId() Group by the canton_id column
 * @method ControlBodegaQuery groupBySectorId() Group by the sector_id column
 *
 * @method ControlBodegaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ControlBodegaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ControlBodegaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ControlBodegaQuery leftJoinCanton($relationAlias = null) Adds a LEFT JOIN clause to the query using the Canton relation
 * @method ControlBodegaQuery rightJoinCanton($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Canton relation
 * @method ControlBodegaQuery innerJoinCanton($relationAlias = null) Adds a INNER JOIN clause to the query using the Canton relation
 *
 * @method ControlBodegaQuery leftJoinSector($relationAlias = null) Adds a LEFT JOIN clause to the query using the Sector relation
 * @method ControlBodegaQuery rightJoinSector($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Sector relation
 * @method ControlBodegaQuery innerJoinSector($relationAlias = null) Adds a INNER JOIN clause to the query using the Sector relation
 *
 * @method ControlBodegaQuery leftJoinMaquinaria($relationAlias = null) Adds a LEFT JOIN clause to the query using the Maquinaria relation
 * @method ControlBodegaQuery rightJoinMaquinaria($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Maquinaria relation
 * @method ControlBodegaQuery innerJoinMaquinaria($relationAlias = null) Adds a INNER JOIN clause to the query using the Maquinaria relation
 *
 * @method ControlBodegaQuery leftJoinBodega($relationAlias = null) Adds a LEFT JOIN clause to the query using the Bodega relation
 * @method ControlBodegaQuery rightJoinBodega($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Bodega relation
 * @method ControlBodegaQuery innerJoinBodega($relationAlias = null) Adds a INNER JOIN clause to the query using the Bodega relation
 *
 * @method ControlBodega findOne(PropelPDO $con = null) Return the first ControlBodega matching the query
 * @method ControlBodega findOneOrCreate(PropelPDO $con = null) Return the first ControlBodega matching the query, or a new ControlBodega object populated from the query conditions when no match is found
 *
 * @method ControlBodega findOneByBodegaId(int $bodega_id) Return the first ControlBodega filtered by the bodega_id column
 * @method ControlBodega findOneByFechaRetiro(string $fecha_retiro) Return the first ControlBodega filtered by the fecha_retiro column
 * @method ControlBodega findOneByMaquinariaId(int $maquinaria_id) Return the first ControlBodega filtered by the maquinaria_id column
 * @method ControlBodega findOneByFechaIngreso(string $fecha_ingreso) Return the first ControlBodega filtered by the fecha_ingreso column
 * @method ControlBodega findOneByCantonId(int $canton_id) Return the first ControlBodega filtered by the canton_id column
 * @method ControlBodega findOneBySectorId(int $sector_id) Return the first ControlBodega filtered by the sector_id column
 *
 * @method array findById(int $id) Return ControlBodega objects filtered by the id column
 * @method array findByBodegaId(int $bodega_id) Return ControlBodega objects filtered by the bodega_id column
 * @method array findByFechaRetiro(string $fecha_retiro) Return ControlBodega objects filtered by the fecha_retiro column
 * @method array findByMaquinariaId(int $maquinaria_id) Return ControlBodega objects filtered by the maquinaria_id column
 * @method array findByFechaIngreso(string $fecha_ingreso) Return ControlBodega objects filtered by the fecha_ingreso column
 * @method array findByCantonId(int $canton_id) Return ControlBodega objects filtered by the canton_id column
 * @method array findBySectorId(int $sector_id) Return ControlBodega objects filtered by the sector_id column
 */
abstract class BaseControlBodegaQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseControlBodegaQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'default';
        }
        if (null === $modelName) {
            $modelName = 'Colli\\ControlBundle\\Model\\ControlBodega';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ControlBodegaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   ControlBodegaQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ControlBodegaQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ControlBodegaQuery) {
            return $criteria;
        }
        $query = new ControlBodegaQuery(null, null, $modelAlias);

        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   ControlBodega|ControlBodega[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ControlBodegaPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ControlBodegaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 ControlBodega A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 ControlBodega A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `bodega_id`, `fecha_retiro`, `maquinaria_id`, `fecha_ingreso`, `canton_id`, `sector_id` FROM `control_bodega` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new ControlBodega();
            $obj->hydrate($row);
            ControlBodegaPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return ControlBodega|ControlBodega[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|ControlBodega[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return ControlBodegaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ControlBodegaPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ControlBodegaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ControlBodegaPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ControlBodegaQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ControlBodegaPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ControlBodegaPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ControlBodegaPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the bodega_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBodegaId(1234); // WHERE bodega_id = 1234
     * $query->filterByBodegaId(array(12, 34)); // WHERE bodega_id IN (12, 34)
     * $query->filterByBodegaId(array('min' => 12)); // WHERE bodega_id >= 12
     * $query->filterByBodegaId(array('max' => 12)); // WHERE bodega_id <= 12
     * </code>
     *
     * @see       filterByBodega()
     *
     * @param     mixed $bodegaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ControlBodegaQuery The current query, for fluid interface
     */
    public function filterByBodegaId($bodegaId = null, $comparison = null)
    {
        if (is_array($bodegaId)) {
            $useMinMax = false;
            if (isset($bodegaId['min'])) {
                $this->addUsingAlias(ControlBodegaPeer::BODEGA_ID, $bodegaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bodegaId['max'])) {
                $this->addUsingAlias(ControlBodegaPeer::BODEGA_ID, $bodegaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ControlBodegaPeer::BODEGA_ID, $bodegaId, $comparison);
    }

    /**
     * Filter the query on the fecha_retiro column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaRetiro('2011-03-14'); // WHERE fecha_retiro = '2011-03-14'
     * $query->filterByFechaRetiro('now'); // WHERE fecha_retiro = '2011-03-14'
     * $query->filterByFechaRetiro(array('max' => 'yesterday')); // WHERE fecha_retiro < '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaRetiro The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ControlBodegaQuery The current query, for fluid interface
     */
    public function filterByFechaRetiro($fechaRetiro = null, $comparison = null)
    {
        if (is_array($fechaRetiro)) {
            $useMinMax = false;
            if (isset($fechaRetiro['min'])) {
                $this->addUsingAlias(ControlBodegaPeer::FECHA_RETIRO, $fechaRetiro['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaRetiro['max'])) {
                $this->addUsingAlias(ControlBodegaPeer::FECHA_RETIRO, $fechaRetiro['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ControlBodegaPeer::FECHA_RETIRO, $fechaRetiro, $comparison);
    }

    /**
     * Filter the query on the maquinaria_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMaquinariaId(1234); // WHERE maquinaria_id = 1234
     * $query->filterByMaquinariaId(array(12, 34)); // WHERE maquinaria_id IN (12, 34)
     * $query->filterByMaquinariaId(array('min' => 12)); // WHERE maquinaria_id >= 12
     * $query->filterByMaquinariaId(array('max' => 12)); // WHERE maquinaria_id <= 12
     * </code>
     *
     * @see       filterByMaquinaria()
     *
     * @param     mixed $maquinariaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ControlBodegaQuery The current query, for fluid interface
     */
    public function filterByMaquinariaId($maquinariaId = null, $comparison = null)
    {
        if (is_array($maquinariaId)) {
            $useMinMax = false;
            if (isset($maquinariaId['min'])) {
                $this->addUsingAlias(ControlBodegaPeer::MAQUINARIA_ID, $maquinariaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maquinariaId['max'])) {
                $this->addUsingAlias(ControlBodegaPeer::MAQUINARIA_ID, $maquinariaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ControlBodegaPeer::MAQUINARIA_ID, $maquinariaId, $comparison);
    }

    /**
     * Filter the query on the fecha_ingreso column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaIngreso('2011-03-14'); // WHERE fecha_ingreso = '2011-03-14'
     * $query->filterByFechaIngreso('now'); // WHERE fecha_ingreso = '2011-03-14'
     * $query->filterByFechaIngreso(array('max' => 'yesterday')); // WHERE fecha_ingreso < '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaIngreso The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ControlBodegaQuery The current query, for fluid interface
     */
    public function filterByFechaIngreso($fechaIngreso = null, $comparison = null)
    {
        if (is_array($fechaIngreso)) {
            $useMinMax = false;
            if (isset($fechaIngreso['min'])) {
                $this->addUsingAlias(ControlBodegaPeer::FECHA_INGRESO, $fechaIngreso['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaIngreso['max'])) {
                $this->addUsingAlias(ControlBodegaPeer::FECHA_INGRESO, $fechaIngreso['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ControlBodegaPeer::FECHA_INGRESO, $fechaIngreso, $comparison);
    }

    /**
     * Filter the query on the canton_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCantonId(1234); // WHERE canton_id = 1234
     * $query->filterByCantonId(array(12, 34)); // WHERE canton_id IN (12, 34)
     * $query->filterByCantonId(array('min' => 12)); // WHERE canton_id >= 12
     * $query->filterByCantonId(array('max' => 12)); // WHERE canton_id <= 12
     * </code>
     *
     * @see       filterByCanton()
     *
     * @param     mixed $cantonId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ControlBodegaQuery The current query, for fluid interface
     */
    public function filterByCantonId($cantonId = null, $comparison = null)
    {
        if (is_array($cantonId)) {
            $useMinMax = false;
            if (isset($cantonId['min'])) {
                $this->addUsingAlias(ControlBodegaPeer::CANTON_ID, $cantonId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cantonId['max'])) {
                $this->addUsingAlias(ControlBodegaPeer::CANTON_ID, $cantonId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ControlBodegaPeer::CANTON_ID, $cantonId, $comparison);
    }

    /**
     * Filter the query on the sector_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySectorId(1234); // WHERE sector_id = 1234
     * $query->filterBySectorId(array(12, 34)); // WHERE sector_id IN (12, 34)
     * $query->filterBySectorId(array('min' => 12)); // WHERE sector_id >= 12
     * $query->filterBySectorId(array('max' => 12)); // WHERE sector_id <= 12
     * </code>
     *
     * @see       filterBySector()
     *
     * @param     mixed $sectorId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ControlBodegaQuery The current query, for fluid interface
     */
    public function filterBySectorId($sectorId = null, $comparison = null)
    {
        if (is_array($sectorId)) {
            $useMinMax = false;
            if (isset($sectorId['min'])) {
                $this->addUsingAlias(ControlBodegaPeer::SECTOR_ID, $sectorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sectorId['max'])) {
                $this->addUsingAlias(ControlBodegaPeer::SECTOR_ID, $sectorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ControlBodegaPeer::SECTOR_ID, $sectorId, $comparison);
    }

    /**
     * Filter the query by a related Canton object
     *
     * @param   Canton|PropelObjectCollection $canton The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ControlBodegaQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByCanton($canton, $comparison = null)
    {
        if ($canton instanceof Canton) {
            return $this
                ->addUsingAlias(ControlBodegaPeer::CANTON_ID, $canton->getId(), $comparison);
        } elseif ($canton instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ControlBodegaPeer::CANTON_ID, $canton->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCanton() only accepts arguments of type Canton or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Canton relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ControlBodegaQuery The current query, for fluid interface
     */
    public function joinCanton($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Canton');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Canton');
        }

        return $this;
    }

    /**
     * Use the Canton relation Canton object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Colli\ControlBundle\Model\CantonQuery A secondary query class using the current class as primary query
     */
    public function useCantonQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCanton($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Canton', '\Colli\ControlBundle\Model\CantonQuery');
    }

    /**
     * Filter the query by a related Sector object
     *
     * @param   Sector|PropelObjectCollection $sector The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ControlBodegaQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterBySector($sector, $comparison = null)
    {
        if ($sector instanceof Sector) {
            return $this
                ->addUsingAlias(ControlBodegaPeer::SECTOR_ID, $sector->getId(), $comparison);
        } elseif ($sector instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ControlBodegaPeer::SECTOR_ID, $sector->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySector() only accepts arguments of type Sector or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Sector relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ControlBodegaQuery The current query, for fluid interface
     */
    public function joinSector($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Sector');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Sector');
        }

        return $this;
    }

    /**
     * Use the Sector relation Sector object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Colli\ControlBundle\Model\SectorQuery A secondary query class using the current class as primary query
     */
    public function useSectorQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSector($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Sector', '\Colli\ControlBundle\Model\SectorQuery');
    }

    /**
     * Filter the query by a related Maquinaria object
     *
     * @param   Maquinaria|PropelObjectCollection $maquinaria The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ControlBodegaQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByMaquinaria($maquinaria, $comparison = null)
    {
        if ($maquinaria instanceof Maquinaria) {
            return $this
                ->addUsingAlias(ControlBodegaPeer::MAQUINARIA_ID, $maquinaria->getId(), $comparison);
        } elseif ($maquinaria instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ControlBodegaPeer::MAQUINARIA_ID, $maquinaria->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByMaquinaria() only accepts arguments of type Maquinaria or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Maquinaria relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ControlBodegaQuery The current query, for fluid interface
     */
    public function joinMaquinaria($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Maquinaria');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Maquinaria');
        }

        return $this;
    }

    /**
     * Use the Maquinaria relation Maquinaria object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Colli\ControlBundle\Model\MaquinariaQuery A secondary query class using the current class as primary query
     */
    public function useMaquinariaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMaquinaria($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Maquinaria', '\Colli\ControlBundle\Model\MaquinariaQuery');
    }

    /**
     * Filter the query by a related Bodega object
     *
     * @param   Bodega|PropelObjectCollection $bodega The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ControlBodegaQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByBodega($bodega, $comparison = null)
    {
        if ($bodega instanceof Bodega) {
            return $this
                ->addUsingAlias(ControlBodegaPeer::BODEGA_ID, $bodega->getId(), $comparison);
        } elseif ($bodega instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ControlBodegaPeer::BODEGA_ID, $bodega->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByBodega() only accepts arguments of type Bodega or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Bodega relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ControlBodegaQuery The current query, for fluid interface
     */
    public function joinBodega($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Bodega');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Bodega');
        }

        return $this;
    }

    /**
     * Use the Bodega relation Bodega object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Colli\ControlBundle\Model\BodegaQuery A secondary query class using the current class as primary query
     */
    public function useBodegaQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBodega($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Bodega', '\Colli\ControlBundle\Model\BodegaQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ControlBodega $controlBodega Object to remove from the list of results
     *
     * @return ControlBodegaQuery The current query, for fluid interface
     */
    public function prune($controlBodega = null)
    {
        if ($controlBodega) {
            $this->addUsingAlias(ControlBodegaPeer::ID, $controlBodega->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
