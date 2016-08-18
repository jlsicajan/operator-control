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
use Colli\ControlBundle\Model\Trabajador;
use Colli\ControlBundle\Model\TrabajadorControl;
use Colli\ControlBundle\Model\TrabajadorPeer;
use Colli\ControlBundle\Model\TrabajadorQuery;

/**
 * @method TrabajadorQuery orderById($order = Criteria::ASC) Order by the id column
 * @method TrabajadorQuery orderByNombre($order = Criteria::ASC) Order by the nombre column
 *
 * @method TrabajadorQuery groupById() Group by the id column
 * @method TrabajadorQuery groupByNombre() Group by the nombre column
 *
 * @method TrabajadorQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TrabajadorQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TrabajadorQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TrabajadorQuery leftJoinTrabajadorControl($relationAlias = null) Adds a LEFT JOIN clause to the query using the TrabajadorControl relation
 * @method TrabajadorQuery rightJoinTrabajadorControl($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TrabajadorControl relation
 * @method TrabajadorQuery innerJoinTrabajadorControl($relationAlias = null) Adds a INNER JOIN clause to the query using the TrabajadorControl relation
 *
 * @method Trabajador findOne(PropelPDO $con = null) Return the first Trabajador matching the query
 * @method Trabajador findOneOrCreate(PropelPDO $con = null) Return the first Trabajador matching the query, or a new Trabajador object populated from the query conditions when no match is found
 *
 * @method Trabajador findOneByNombre(string $nombre) Return the first Trabajador filtered by the nombre column
 *
 * @method array findById(int $id) Return Trabajador objects filtered by the id column
 * @method array findByNombre(string $nombre) Return Trabajador objects filtered by the nombre column
 */
abstract class BaseTrabajadorQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTrabajadorQuery object.
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
            $modelName = 'Colli\\ControlBundle\\Model\\Trabajador';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TrabajadorQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   TrabajadorQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TrabajadorQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TrabajadorQuery) {
            return $criteria;
        }
        $query = new TrabajadorQuery(null, null, $modelAlias);

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
     * @return   Trabajador|Trabajador[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TrabajadorPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TrabajadorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Trabajador A model object, or null if the key is not found
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
     * @return                 Trabajador A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `nombre` FROM `trabajador` WHERE `id` = :p0';
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
            $obj = new Trabajador();
            $obj->hydrate($row);
            TrabajadorPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Trabajador|Trabajador[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Trabajador[]|mixed the list of results, formatted by the current formatter
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
     * @return TrabajadorQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TrabajadorPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TrabajadorQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TrabajadorPeer::ID, $keys, Criteria::IN);
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
     * @return TrabajadorQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(TrabajadorPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(TrabajadorPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TrabajadorPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the nombre column
     *
     * Example usage:
     * <code>
     * $query->filterByNombre('fooValue');   // WHERE nombre = 'fooValue'
     * $query->filterByNombre('%fooValue%'); // WHERE nombre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombre The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TrabajadorQuery The current query, for fluid interface
     */
    public function filterByNombre($nombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombre)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nombre)) {
                $nombre = str_replace('*', '%', $nombre);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TrabajadorPeer::NOMBRE, $nombre, $comparison);
    }

    /**
     * Filter the query by a related TrabajadorControl object
     *
     * @param   TrabajadorControl|PropelObjectCollection $trabajadorControl  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 TrabajadorQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTrabajadorControl($trabajadorControl, $comparison = null)
    {
        if ($trabajadorControl instanceof TrabajadorControl) {
            return $this
                ->addUsingAlias(TrabajadorPeer::ID, $trabajadorControl->getTrabajadorId(), $comparison);
        } elseif ($trabajadorControl instanceof PropelObjectCollection) {
            return $this
                ->useTrabajadorControlQuery()
                ->filterByPrimaryKeys($trabajadorControl->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTrabajadorControl() only accepts arguments of type TrabajadorControl or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TrabajadorControl relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TrabajadorQuery The current query, for fluid interface
     */
    public function joinTrabajadorControl($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TrabajadorControl');

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
            $this->addJoinObject($join, 'TrabajadorControl');
        }

        return $this;
    }

    /**
     * Use the TrabajadorControl relation TrabajadorControl object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Colli\ControlBundle\Model\TrabajadorControlQuery A secondary query class using the current class as primary query
     */
    public function useTrabajadorControlQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTrabajadorControl($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TrabajadorControl', '\Colli\ControlBundle\Model\TrabajadorControlQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Trabajador $trabajador Object to remove from the list of results
     *
     * @return TrabajadorQuery The current query, for fluid interface
     */
    public function prune($trabajador = null)
    {
        if ($trabajador) {
            $this->addUsingAlias(TrabajadorPeer::ID, $trabajador->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
