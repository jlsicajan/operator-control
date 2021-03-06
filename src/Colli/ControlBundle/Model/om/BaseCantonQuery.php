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
use Colli\ControlBundle\Model\CantonPeer;
use Colli\ControlBundle\Model\CantonQuery;
use Colli\ControlBundle\Model\Control;
use Colli\ControlBundle\Model\ControlBodega;
use Colli\ControlBundle\Model\Sector;

/**
 * @method CantonQuery orderById($order = Criteria::ASC) Order by the id column
 * @method CantonQuery orderByDescripcion($order = Criteria::ASC) Order by the descripcion column
 *
 * @method CantonQuery groupById() Group by the id column
 * @method CantonQuery groupByDescripcion() Group by the descripcion column
 *
 * @method CantonQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CantonQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CantonQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method CantonQuery leftJoinSector($relationAlias = null) Adds a LEFT JOIN clause to the query using the Sector relation
 * @method CantonQuery rightJoinSector($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Sector relation
 * @method CantonQuery innerJoinSector($relationAlias = null) Adds a INNER JOIN clause to the query using the Sector relation
 *
 * @method CantonQuery leftJoinControlBodega($relationAlias = null) Adds a LEFT JOIN clause to the query using the ControlBodega relation
 * @method CantonQuery rightJoinControlBodega($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ControlBodega relation
 * @method CantonQuery innerJoinControlBodega($relationAlias = null) Adds a INNER JOIN clause to the query using the ControlBodega relation
 *
 * @method CantonQuery leftJoinControl($relationAlias = null) Adds a LEFT JOIN clause to the query using the Control relation
 * @method CantonQuery rightJoinControl($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Control relation
 * @method CantonQuery innerJoinControl($relationAlias = null) Adds a INNER JOIN clause to the query using the Control relation
 *
 * @method Canton findOne(PropelPDO $con = null) Return the first Canton matching the query
 * @method Canton findOneOrCreate(PropelPDO $con = null) Return the first Canton matching the query, or a new Canton object populated from the query conditions when no match is found
 *
 * @method Canton findOneByDescripcion(string $descripcion) Return the first Canton filtered by the descripcion column
 *
 * @method array findById(int $id) Return Canton objects filtered by the id column
 * @method array findByDescripcion(string $descripcion) Return Canton objects filtered by the descripcion column
 */
abstract class BaseCantonQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseCantonQuery object.
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
            $modelName = 'Colli\\ControlBundle\\Model\\Canton';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CantonQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   CantonQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CantonQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CantonQuery) {
            return $criteria;
        }
        $query = new CantonQuery(null, null, $modelAlias);

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
     * @return   Canton|Canton[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CantonPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CantonPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Canton A model object, or null if the key is not found
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
     * @return                 Canton A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `descripcion` FROM `canton` WHERE `id` = :p0';
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
            $obj = new Canton();
            $obj->hydrate($row);
            CantonPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Canton|Canton[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Canton[]|mixed the list of results, formatted by the current formatter
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
     * @return CantonQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CantonPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CantonQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CantonPeer::ID, $keys, Criteria::IN);
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
     * @return CantonQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CantonPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CantonPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CantonPeer::ID, $id, $comparison);
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
     * @return CantonQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CantonPeer::DESCRIPCION, $descripcion, $comparison);
    }

    /**
     * Filter the query by a related Sector object
     *
     * @param   Sector|PropelObjectCollection $sector  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 CantonQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterBySector($sector, $comparison = null)
    {
        if ($sector instanceof Sector) {
            return $this
                ->addUsingAlias(CantonPeer::ID, $sector->getCantonId(), $comparison);
        } elseif ($sector instanceof PropelObjectCollection) {
            return $this
                ->useSectorQuery()
                ->filterByPrimaryKeys($sector->getPrimaryKeys())
                ->endUse();
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
     * @return CantonQuery The current query, for fluid interface
     */
    public function joinSector($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useSectorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSector($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Sector', '\Colli\ControlBundle\Model\SectorQuery');
    }

    /**
     * Filter the query by a related ControlBodega object
     *
     * @param   ControlBodega|PropelObjectCollection $controlBodega  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 CantonQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByControlBodega($controlBodega, $comparison = null)
    {
        if ($controlBodega instanceof ControlBodega) {
            return $this
                ->addUsingAlias(CantonPeer::ID, $controlBodega->getCantonId(), $comparison);
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
     * @return CantonQuery The current query, for fluid interface
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
     * @return                 CantonQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByControl($control, $comparison = null)
    {
        if ($control instanceof Control) {
            return $this
                ->addUsingAlias(CantonPeer::ID, $control->getCantonId(), $comparison);
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
     * @return CantonQuery The current query, for fluid interface
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
     * @param   Canton $canton Object to remove from the list of results
     *
     * @return CantonQuery The current query, for fluid interface
     */
    public function prune($canton = null)
    {
        if ($canton) {
            $this->addUsingAlias(CantonPeer::ID, $canton->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
