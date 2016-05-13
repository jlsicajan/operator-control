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
use Colli\ControlBundle\Model\Canton;
use Colli\ControlBundle\Model\Control;
use Colli\ControlBundle\Model\ControlBodega;
use Colli\ControlBundle\Model\Sector;
use Colli\ControlBundle\Model\SectorPeer;
use Colli\ControlBundle\Model\SectorQuery;

/**
 * @method SectorQuery orderById($order = Criteria::ASC) Order by the id column
 * @method SectorQuery orderByDescripcion($order = Criteria::ASC) Order by the descripcion column
 * @method SectorQuery orderByAncho($order = Criteria::ASC) Order by the ancho column
 * @method SectorQuery orderByLargo($order = Criteria::ASC) Order by the largo column
 * @method SectorQuery orderByUnidadMedida($order = Criteria::ASC) Order by the unidad_medida column
 * @method SectorQuery orderByCantonId($order = Criteria::ASC) Order by the canton_id column
 *
 * @method SectorQuery groupById() Group by the id column
 * @method SectorQuery groupByDescripcion() Group by the descripcion column
 * @method SectorQuery groupByAncho() Group by the ancho column
 * @method SectorQuery groupByLargo() Group by the largo column
 * @method SectorQuery groupByUnidadMedida() Group by the unidad_medida column
 * @method SectorQuery groupByCantonId() Group by the canton_id column
 *
 * @method SectorQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method SectorQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method SectorQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method SectorQuery leftJoinCanton($relationAlias = null) Adds a LEFT JOIN clause to the query using the Canton relation
 * @method SectorQuery rightJoinCanton($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Canton relation
 * @method SectorQuery innerJoinCanton($relationAlias = null) Adds a INNER JOIN clause to the query using the Canton relation
 *
 * @method SectorQuery leftJoinControlBodega($relationAlias = null) Adds a LEFT JOIN clause to the query using the ControlBodega relation
 * @method SectorQuery rightJoinControlBodega($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ControlBodega relation
 * @method SectorQuery innerJoinControlBodega($relationAlias = null) Adds a INNER JOIN clause to the query using the ControlBodega relation
 *
 * @method SectorQuery leftJoinControl($relationAlias = null) Adds a LEFT JOIN clause to the query using the Control relation
 * @method SectorQuery rightJoinControl($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Control relation
 * @method SectorQuery innerJoinControl($relationAlias = null) Adds a INNER JOIN clause to the query using the Control relation
 *
 * @method Sector findOne(PropelPDO $con = null) Return the first Sector matching the query
 * @method Sector findOneOrCreate(PropelPDO $con = null) Return the first Sector matching the query, or a new Sector object populated from the query conditions when no match is found
 *
 * @method Sector findOneByDescripcion(string $descripcion) Return the first Sector filtered by the descripcion column
 * @method Sector findOneByAncho(int $ancho) Return the first Sector filtered by the ancho column
 * @method Sector findOneByLargo(int $largo) Return the first Sector filtered by the largo column
 * @method Sector findOneByUnidadMedida(string $unidad_medida) Return the first Sector filtered by the unidad_medida column
 * @method Sector findOneByCantonId(int $canton_id) Return the first Sector filtered by the canton_id column
 *
 * @method array findById(int $id) Return Sector objects filtered by the id column
 * @method array findByDescripcion(string $descripcion) Return Sector objects filtered by the descripcion column
 * @method array findByAncho(int $ancho) Return Sector objects filtered by the ancho column
 * @method array findByLargo(int $largo) Return Sector objects filtered by the largo column
 * @method array findByUnidadMedida(string $unidad_medida) Return Sector objects filtered by the unidad_medida column
 * @method array findByCantonId(int $canton_id) Return Sector objects filtered by the canton_id column
 */
abstract class BaseSectorQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseSectorQuery object.
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
            $modelName = 'Colli\\ControlBundle\\Model\\Sector';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new SectorQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   SectorQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return SectorQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof SectorQuery) {
            return $criteria;
        }
        $query = new SectorQuery(null, null, $modelAlias);

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
     * @return   Sector|Sector[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SectorPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(SectorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Sector A model object, or null if the key is not found
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
     * @return                 Sector A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `descripcion`, `ancho`, `largo`, `unidad_medida`, `canton_id` FROM `sector` WHERE `id` = :p0';
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
            $obj = new Sector();
            $obj->hydrate($row);
            SectorPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Sector|Sector[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Sector[]|mixed the list of results, formatted by the current formatter
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
     * @return SectorQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SectorPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return SectorQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SectorPeer::ID, $keys, Criteria::IN);
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
     * @return SectorQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SectorPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SectorPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SectorPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the descripcion column
     *
     * Example usage:
     * <code>
     * $query->filterByDescripcion('fooValue');   // WHERE descripcion = 'fooValue'
     * $query->filterByDescripcion('%fooValue%'); // WHERE descripcion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $descripcion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SectorQuery The current query, for fluid interface
     */
    public function filterByDescripcion($descripcion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descripcion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $descripcion)) {
                $descripcion = str_replace('*', '%', $descripcion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SectorPeer::DESCRIPCION, $descripcion, $comparison);
    }

    /**
     * Filter the query on the ancho column
     *
     * Example usage:
     * <code>
     * $query->filterByAncho(1234); // WHERE ancho = 1234
     * $query->filterByAncho(array(12, 34)); // WHERE ancho IN (12, 34)
     * $query->filterByAncho(array('min' => 12)); // WHERE ancho >= 12
     * $query->filterByAncho(array('max' => 12)); // WHERE ancho <= 12
     * </code>
     *
     * @param     mixed $ancho The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SectorQuery The current query, for fluid interface
     */
    public function filterByAncho($ancho = null, $comparison = null)
    {
        if (is_array($ancho)) {
            $useMinMax = false;
            if (isset($ancho['min'])) {
                $this->addUsingAlias(SectorPeer::ANCHO, $ancho['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ancho['max'])) {
                $this->addUsingAlias(SectorPeer::ANCHO, $ancho['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SectorPeer::ANCHO, $ancho, $comparison);
    }

    /**
     * Filter the query on the largo column
     *
     * Example usage:
     * <code>
     * $query->filterByLargo(1234); // WHERE largo = 1234
     * $query->filterByLargo(array(12, 34)); // WHERE largo IN (12, 34)
     * $query->filterByLargo(array('min' => 12)); // WHERE largo >= 12
     * $query->filterByLargo(array('max' => 12)); // WHERE largo <= 12
     * </code>
     *
     * @param     mixed $largo The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SectorQuery The current query, for fluid interface
     */
    public function filterByLargo($largo = null, $comparison = null)
    {
        if (is_array($largo)) {
            $useMinMax = false;
            if (isset($largo['min'])) {
                $this->addUsingAlias(SectorPeer::LARGO, $largo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($largo['max'])) {
                $this->addUsingAlias(SectorPeer::LARGO, $largo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SectorPeer::LARGO, $largo, $comparison);
    }

    /**
     * Filter the query on the unidad_medida column
     *
     * Example usage:
     * <code>
     * $query->filterByUnidadMedida('fooValue');   // WHERE unidad_medida = 'fooValue'
     * $query->filterByUnidadMedida('%fooValue%'); // WHERE unidad_medida LIKE '%fooValue%'
     * </code>
     *
     * @param     string $unidadMedida The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SectorQuery The current query, for fluid interface
     */
    public function filterByUnidadMedida($unidadMedida = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($unidadMedida)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $unidadMedida)) {
                $unidadMedida = str_replace('*', '%', $unidadMedida);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SectorPeer::UNIDAD_MEDIDA, $unidadMedida, $comparison);
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
     * @return SectorQuery The current query, for fluid interface
     */
    public function filterByCantonId($cantonId = null, $comparison = null)
    {
        if (is_array($cantonId)) {
            $useMinMax = false;
            if (isset($cantonId['min'])) {
                $this->addUsingAlias(SectorPeer::CANTON_ID, $cantonId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cantonId['max'])) {
                $this->addUsingAlias(SectorPeer::CANTON_ID, $cantonId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SectorPeer::CANTON_ID, $cantonId, $comparison);
    }

    /**
     * Filter the query by a related Canton object
     *
     * @param   Canton|PropelObjectCollection $canton The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 SectorQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByCanton($canton, $comparison = null)
    {
        if ($canton instanceof Canton) {
            return $this
                ->addUsingAlias(SectorPeer::CANTON_ID, $canton->getId(), $comparison);
        } elseif ($canton instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SectorPeer::CANTON_ID, $canton->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return SectorQuery The current query, for fluid interface
     */
    public function joinCanton($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useCantonQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCanton($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Canton', '\Colli\ControlBundle\Model\CantonQuery');
    }

    /**
     * Filter the query by a related ControlBodega object
     *
     * @param   ControlBodega|PropelObjectCollection $controlBodega  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 SectorQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByControlBodega($controlBodega, $comparison = null)
    {
        if ($controlBodega instanceof ControlBodega) {
            return $this
                ->addUsingAlias(SectorPeer::ID, $controlBodega->getSectorId(), $comparison);
        } elseif ($controlBodega instanceof PropelObjectCollection) {
            return $this
                ->useControlBodegaQuery()
                ->filterByPrimaryKeys($controlBodega->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByControlBodega() only accepts arguments of type ControlBodega or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ControlBodega relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SectorQuery The current query, for fluid interface
     */
    public function joinControlBodega($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ControlBodega');

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
            $this->addJoinObject($join, 'ControlBodega');
        }

        return $this;
    }

    /**
     * Use the ControlBodega relation ControlBodega object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Colli\ControlBundle\Model\ControlBodegaQuery A secondary query class using the current class as primary query
     */
    public function useControlBodegaQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinControlBodega($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ControlBodega', '\Colli\ControlBundle\Model\ControlBodegaQuery');
    }

    /**
     * Filter the query by a related Control object
     *
     * @param   Control|PropelObjectCollection $control  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 SectorQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByControl($control, $comparison = null)
    {
        if ($control instanceof Control) {
            return $this
                ->addUsingAlias(SectorPeer::ID, $control->getSectorId(), $comparison);
        } elseif ($control instanceof PropelObjectCollection) {
            return $this
                ->useControlQuery()
                ->filterByPrimaryKeys($control->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByControl() only accepts arguments of type Control or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Control relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SectorQuery The current query, for fluid interface
     */
    public function joinControl($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Control');

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
            $this->addJoinObject($join, 'Control');
        }

        return $this;
    }

    /**
     * Use the Control relation Control object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Colli\ControlBundle\Model\ControlQuery A secondary query class using the current class as primary query
     */
    public function useControlQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinControl($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Control', '\Colli\ControlBundle\Model\ControlQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Sector $sector Object to remove from the list of results
     *
     * @return SectorQuery The current query, for fluid interface
     */
    public function prune($sector = null)
    {
        if ($sector) {
            $this->addUsingAlias(SectorPeer::ID, $sector->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
