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
use Colli\ControlBundle\Model\BodegaPeer;
use Colli\ControlBundle\Model\BodegaQuery;
use Colli\ControlBundle\Model\Control;
use Colli\ControlBundle\Model\ControlBodega;
use Colli\ControlBundle\Model\Equipo;
use Colli\ControlBundle\Model\Maquinaria;

/**
 * @method BodegaQuery orderById($order = Criteria::ASC) Order by the id column
 * @method BodegaQuery orderByEquipoId($order = Criteria::ASC) Order by the equipo_id column
 * @method BodegaQuery orderByCantidad($order = Criteria::ASC) Order by the cantidad column
 * @method BodegaQuery orderByPrecio($order = Criteria::ASC) Order by the precio column
 * @method BodegaQuery orderByEstado($order = Criteria::ASC) Order by the estado column
 * @method BodegaQuery orderByMaquinariaId($order = Criteria::ASC) Order by the maquinaria_id column
 *
 * @method BodegaQuery groupById() Group by the id column
 * @method BodegaQuery groupByEquipoId() Group by the equipo_id column
 * @method BodegaQuery groupByCantidad() Group by the cantidad column
 * @method BodegaQuery groupByPrecio() Group by the precio column
 * @method BodegaQuery groupByEstado() Group by the estado column
 * @method BodegaQuery groupByMaquinariaId() Group by the maquinaria_id column
 *
 * @method BodegaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method BodegaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method BodegaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method BodegaQuery leftJoinMaquinaria($relationAlias = null) Adds a LEFT JOIN clause to the query using the Maquinaria relation
 * @method BodegaQuery rightJoinMaquinaria($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Maquinaria relation
 * @method BodegaQuery innerJoinMaquinaria($relationAlias = null) Adds a INNER JOIN clause to the query using the Maquinaria relation
 *
 * @method BodegaQuery leftJoinEquipo($relationAlias = null) Adds a LEFT JOIN clause to the query using the Equipo relation
 * @method BodegaQuery rightJoinEquipo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Equipo relation
 * @method BodegaQuery innerJoinEquipo($relationAlias = null) Adds a INNER JOIN clause to the query using the Equipo relation
 *
 * @method BodegaQuery leftJoinControlBodega($relationAlias = null) Adds a LEFT JOIN clause to the query using the ControlBodega relation
 * @method BodegaQuery rightJoinControlBodega($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ControlBodega relation
 * @method BodegaQuery innerJoinControlBodega($relationAlias = null) Adds a INNER JOIN clause to the query using the ControlBodega relation
 *
 * @method BodegaQuery leftJoinControl($relationAlias = null) Adds a LEFT JOIN clause to the query using the Control relation
 * @method BodegaQuery rightJoinControl($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Control relation
 * @method BodegaQuery innerJoinControl($relationAlias = null) Adds a INNER JOIN clause to the query using the Control relation
 *
 * @method Bodega findOne(PropelPDO $con = null) Return the first Bodega matching the query
 * @method Bodega findOneOrCreate(PropelPDO $con = null) Return the first Bodega matching the query, or a new Bodega object populated from the query conditions when no match is found
 *
 * @method Bodega findOneByEquipoId(int $equipo_id) Return the first Bodega filtered by the equipo_id column
 * @method Bodega findOneByCantidad(int $cantidad) Return the first Bodega filtered by the cantidad column
 * @method Bodega findOneByPrecio(int $precio) Return the first Bodega filtered by the precio column
 * @method Bodega findOneByEstado(string $estado) Return the first Bodega filtered by the estado column
 * @method Bodega findOneByMaquinariaId(int $maquinaria_id) Return the first Bodega filtered by the maquinaria_id column
 *
 * @method array findById(int $id) Return Bodega objects filtered by the id column
 * @method array findByEquipoId(int $equipo_id) Return Bodega objects filtered by the equipo_id column
 * @method array findByCantidad(int $cantidad) Return Bodega objects filtered by the cantidad column
 * @method array findByPrecio(int $precio) Return Bodega objects filtered by the precio column
 * @method array findByEstado(string $estado) Return Bodega objects filtered by the estado column
 * @method array findByMaquinariaId(int $maquinaria_id) Return Bodega objects filtered by the maquinaria_id column
 */
abstract class BaseBodegaQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseBodegaQuery object.
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
            $modelName = 'Colli\\ControlBundle\\Model\\Bodega';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new BodegaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   BodegaQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return BodegaQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof BodegaQuery) {
            return $criteria;
        }
        $query = new BodegaQuery(null, null, $modelAlias);

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
     * @return   Bodega|Bodega[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BodegaPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(BodegaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Bodega A model object, or null if the key is not found
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
     * @return                 Bodega A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `equipo_id`, `cantidad`, `precio`, `estado`, `maquinaria_id` FROM `bodega` WHERE `id` = :p0';
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
            $obj = new Bodega();
            $obj->hydrate($row);
            BodegaPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Bodega|Bodega[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Bodega[]|mixed the list of results, formatted by the current formatter
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
     * @return BodegaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BodegaPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return BodegaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BodegaPeer::ID, $keys, Criteria::IN);
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
     * @return BodegaQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(BodegaPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(BodegaPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BodegaPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the equipo_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEquipoId(1234); // WHERE equipo_id = 1234
     * $query->filterByEquipoId(array(12, 34)); // WHERE equipo_id IN (12, 34)
     * $query->filterByEquipoId(array('min' => 12)); // WHERE equipo_id >= 12
     * $query->filterByEquipoId(array('max' => 12)); // WHERE equipo_id <= 12
     * </code>
     *
     * @see       filterByEquipo()
     *
     * @param     mixed $equipoId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BodegaQuery The current query, for fluid interface
     */
    public function filterByEquipoId($equipoId = null, $comparison = null)
    {
        if (is_array($equipoId)) {
            $useMinMax = false;
            if (isset($equipoId['min'])) {
                $this->addUsingAlias(BodegaPeer::EQUIPO_ID, $equipoId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($equipoId['max'])) {
                $this->addUsingAlias(BodegaPeer::EQUIPO_ID, $equipoId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BodegaPeer::EQUIPO_ID, $equipoId, $comparison);
    }

    /**
     * Filter the query on the cantidad column
     *
     * Example usage:
     * <code>
     * $query->filterByCantidad(1234); // WHERE cantidad = 1234
     * $query->filterByCantidad(array(12, 34)); // WHERE cantidad IN (12, 34)
     * $query->filterByCantidad(array('min' => 12)); // WHERE cantidad >= 12
     * $query->filterByCantidad(array('max' => 12)); // WHERE cantidad <= 12
     * </code>
     *
     * @param     mixed $cantidad The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BodegaQuery The current query, for fluid interface
     */
    public function filterByCantidad($cantidad = null, $comparison = null)
    {
        if (is_array($cantidad)) {
            $useMinMax = false;
            if (isset($cantidad['min'])) {
                $this->addUsingAlias(BodegaPeer::CANTIDAD, $cantidad['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cantidad['max'])) {
                $this->addUsingAlias(BodegaPeer::CANTIDAD, $cantidad['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BodegaPeer::CANTIDAD, $cantidad, $comparison);
    }

    /**
     * Filter the query on the precio column
     *
     * Example usage:
     * <code>
     * $query->filterByPrecio(1234); // WHERE precio = 1234
     * $query->filterByPrecio(array(12, 34)); // WHERE precio IN (12, 34)
     * $query->filterByPrecio(array('min' => 12)); // WHERE precio >= 12
     * $query->filterByPrecio(array('max' => 12)); // WHERE precio <= 12
     * </code>
     *
     * @param     mixed $precio The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BodegaQuery The current query, for fluid interface
     */
    public function filterByPrecio($precio = null, $comparison = null)
    {
        if (is_array($precio)) {
            $useMinMax = false;
            if (isset($precio['min'])) {
                $this->addUsingAlias(BodegaPeer::PRECIO, $precio['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($precio['max'])) {
                $this->addUsingAlias(BodegaPeer::PRECIO, $precio['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BodegaPeer::PRECIO, $precio, $comparison);
    }

    /**
     * Filter the query on the estado column
     *
     * Example usage:
     * <code>
     * $query->filterByEstado('fooValue');   // WHERE estado = 'fooValue'
     * $query->filterByEstado('%fooValue%'); // WHERE estado LIKE '%fooValue%'
     * </code>
     *
     * @param     string $estado The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BodegaQuery The current query, for fluid interface
     */
    public function filterByEstado($estado = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($estado)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $estado)) {
                $estado = str_replace('*', '%', $estado);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BodegaPeer::ESTADO, $estado, $comparison);
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
     * @return BodegaQuery The current query, for fluid interface
     */
    public function filterByMaquinariaId($maquinariaId = null, $comparison = null)
    {
        if (is_array($maquinariaId)) {
            $useMinMax = false;
            if (isset($maquinariaId['min'])) {
                $this->addUsingAlias(BodegaPeer::MAQUINARIA_ID, $maquinariaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maquinariaId['max'])) {
                $this->addUsingAlias(BodegaPeer::MAQUINARIA_ID, $maquinariaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BodegaPeer::MAQUINARIA_ID, $maquinariaId, $comparison);
    }

    /**
     * Filter the query by a related Maquinaria object
     *
     * @param   Maquinaria|PropelObjectCollection $maquinaria The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 BodegaQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByMaquinaria($maquinaria, $comparison = null)
    {
        if ($maquinaria instanceof Maquinaria) {
            return $this
                ->addUsingAlias(BodegaPeer::MAQUINARIA_ID, $maquinaria->getId(), $comparison);
        } elseif ($maquinaria instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BodegaPeer::MAQUINARIA_ID, $maquinaria->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return BodegaQuery The current query, for fluid interface
     */
    public function joinMaquinaria($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useMaquinariaQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMaquinaria($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Maquinaria', '\Colli\ControlBundle\Model\MaquinariaQuery');
    }

    /**
     * Filter the query by a related Equipo object
     *
     * @param   Equipo|PropelObjectCollection $equipo The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 BodegaQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByEquipo($equipo, $comparison = null)
    {
        if ($equipo instanceof Equipo) {
            return $this
                ->addUsingAlias(BodegaPeer::EQUIPO_ID, $equipo->getId(), $comparison);
        } elseif ($equipo instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BodegaPeer::EQUIPO_ID, $equipo->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByEquipo() only accepts arguments of type Equipo or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Equipo relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BodegaQuery The current query, for fluid interface
     */
    public function joinEquipo($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Equipo');

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
            $this->addJoinObject($join, 'Equipo');
        }

        return $this;
    }

    /**
     * Use the Equipo relation Equipo object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Colli\ControlBundle\Model\EquipoQuery A secondary query class using the current class as primary query
     */
    public function useEquipoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEquipo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Equipo', '\Colli\ControlBundle\Model\EquipoQuery');
    }

    /**
     * Filter the query by a related ControlBodega object
     *
     * @param   ControlBodega|PropelObjectCollection $controlBodega  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 BodegaQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByControlBodega($controlBodega, $comparison = null)
    {
        if ($controlBodega instanceof ControlBodega) {
            return $this
                ->addUsingAlias(BodegaPeer::ID, $controlBodega->getBodegaId(), $comparison);
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
     * @return BodegaQuery The current query, for fluid interface
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
     * @return                 BodegaQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByControl($control, $comparison = null)
    {
        if ($control instanceof Control) {
            return $this
                ->addUsingAlias(BodegaPeer::ID, $control->getBodegaId(), $comparison);
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
     * @return BodegaQuery The current query, for fluid interface
     */
    public function joinControl($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useControlQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinControl($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Control', '\Colli\ControlBundle\Model\ControlQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Bodega $bodega Object to remove from the list of results
     *
     * @return BodegaQuery The current query, for fluid interface
     */
    public function prune($bodega = null)
    {
        if ($bodega) {
            $this->addUsingAlias(BodegaPeer::ID, $bodega->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
