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
use Colli\ControlBundle\Model\Control;
use Colli\ControlBundle\Model\ControlPeer;
use Colli\ControlBundle\Model\ControlQuery;
use Colli\ControlBundle\Model\Maquinaria;
use Colli\ControlBundle\Model\Sector;

/**
 * @method ControlQuery orderById($order = Criteria::ASC) Order by the id column
 * @method ControlQuery orderByCantonId($order = Criteria::ASC) Order by the canton_id column
 * @method ControlQuery orderBySectorId($order = Criteria::ASC) Order by the sector_id column
 * @method ControlQuery orderByCantidadCamionadasSector($order = Criteria::ASC) Order by the cantidad_camionadas_sector column
 * @method ControlQuery orderByPrecioDieselSector($order = Criteria::ASC) Order by the precio_diesel_sector column
 * @method ControlQuery orderByGalonesDieselSector($order = Criteria::ASC) Order by the galones_diesel_sector column
 * @method ControlQuery orderByDiasCantidadSector($order = Criteria::ASC) Order by the dias_cantidad_sector column
 * @method ControlQuery orderByHorasDiariasSector($order = Criteria::ASC) Order by the horas_diarias_sector column
 * @method ControlQuery orderByHorasTotalSector($order = Criteria::ASC) Order by the horas_total_sector column
 * @method ControlQuery orderByGrosorBalastoSector($order = Criteria::ASC) Order by the grosor_balasto_sector column
 * @method ControlQuery orderByRepacarionSector($order = Criteria::ASC) Order by the repacarion_sector column
 * @method ControlQuery orderByMaquinariaId($order = Criteria::ASC) Order by the maquinaria_id column
 * @method ControlQuery orderByBodegaId($order = Criteria::ASC) Order by the bodega_id column
 * @method ControlQuery orderByObservaciones($order = Criteria::ASC) Order by the observaciones column
 *
 * @method ControlQuery groupById() Group by the id column
 * @method ControlQuery groupByCantonId() Group by the canton_id column
 * @method ControlQuery groupBySectorId() Group by the sector_id column
 * @method ControlQuery groupByCantidadCamionadasSector() Group by the cantidad_camionadas_sector column
 * @method ControlQuery groupByPrecioDieselSector() Group by the precio_diesel_sector column
 * @method ControlQuery groupByGalonesDieselSector() Group by the galones_diesel_sector column
 * @method ControlQuery groupByDiasCantidadSector() Group by the dias_cantidad_sector column
 * @method ControlQuery groupByHorasDiariasSector() Group by the horas_diarias_sector column
 * @method ControlQuery groupByHorasTotalSector() Group by the horas_total_sector column
 * @method ControlQuery groupByGrosorBalastoSector() Group by the grosor_balasto_sector column
 * @method ControlQuery groupByRepacarionSector() Group by the repacarion_sector column
 * @method ControlQuery groupByMaquinariaId() Group by the maquinaria_id column
 * @method ControlQuery groupByBodegaId() Group by the bodega_id column
 * @method ControlQuery groupByObservaciones() Group by the observaciones column
 *
 * @method ControlQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ControlQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ControlQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ControlQuery leftJoinCanton($relationAlias = null) Adds a LEFT JOIN clause to the query using the Canton relation
 * @method ControlQuery rightJoinCanton($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Canton relation
 * @method ControlQuery innerJoinCanton($relationAlias = null) Adds a INNER JOIN clause to the query using the Canton relation
 *
 * @method ControlQuery leftJoinSector($relationAlias = null) Adds a LEFT JOIN clause to the query using the Sector relation
 * @method ControlQuery rightJoinSector($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Sector relation
 * @method ControlQuery innerJoinSector($relationAlias = null) Adds a INNER JOIN clause to the query using the Sector relation
 *
 * @method ControlQuery leftJoinMaquinaria($relationAlias = null) Adds a LEFT JOIN clause to the query using the Maquinaria relation
 * @method ControlQuery rightJoinMaquinaria($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Maquinaria relation
 * @method ControlQuery innerJoinMaquinaria($relationAlias = null) Adds a INNER JOIN clause to the query using the Maquinaria relation
 *
 * @method ControlQuery leftJoinBodega($relationAlias = null) Adds a LEFT JOIN clause to the query using the Bodega relation
 * @method ControlQuery rightJoinBodega($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Bodega relation
 * @method ControlQuery innerJoinBodega($relationAlias = null) Adds a INNER JOIN clause to the query using the Bodega relation
 *
 * @method Control findOne(PropelPDO $con = null) Return the first Control matching the query
 * @method Control findOneOrCreate(PropelPDO $con = null) Return the first Control matching the query, or a new Control object populated from the query conditions when no match is found
 *
 * @method Control findOneByCantonId(int $canton_id) Return the first Control filtered by the canton_id column
 * @method Control findOneBySectorId(int $sector_id) Return the first Control filtered by the sector_id column
 * @method Control findOneByCantidadCamionadasSector(string $cantidad_camionadas_sector) Return the first Control filtered by the cantidad_camionadas_sector column
 * @method Control findOneByPrecioDieselSector(string $precio_diesel_sector) Return the first Control filtered by the precio_diesel_sector column
 * @method Control findOneByGalonesDieselSector(string $galones_diesel_sector) Return the first Control filtered by the galones_diesel_sector column
 * @method Control findOneByDiasCantidadSector(string $dias_cantidad_sector) Return the first Control filtered by the dias_cantidad_sector column
 * @method Control findOneByHorasDiariasSector(string $horas_diarias_sector) Return the first Control filtered by the horas_diarias_sector column
 * @method Control findOneByHorasTotalSector(string $horas_total_sector) Return the first Control filtered by the horas_total_sector column
 * @method Control findOneByGrosorBalastoSector(string $grosor_balasto_sector) Return the first Control filtered by the grosor_balasto_sector column
 * @method Control findOneByRepacarionSector(string $repacarion_sector) Return the first Control filtered by the repacarion_sector column
 * @method Control findOneByMaquinariaId(string $maquinaria_id) Return the first Control filtered by the maquinaria_id column
 * @method Control findOneByBodegaId(string $bodega_id) Return the first Control filtered by the bodega_id column
 * @method Control findOneByObservaciones(string $observaciones) Return the first Control filtered by the observaciones column
 *
 * @method array findById(int $id) Return Control objects filtered by the id column
 * @method array findByCantonId(int $canton_id) Return Control objects filtered by the canton_id column
 * @method array findBySectorId(int $sector_id) Return Control objects filtered by the sector_id column
 * @method array findByCantidadCamionadasSector(string $cantidad_camionadas_sector) Return Control objects filtered by the cantidad_camionadas_sector column
 * @method array findByPrecioDieselSector(string $precio_diesel_sector) Return Control objects filtered by the precio_diesel_sector column
 * @method array findByGalonesDieselSector(string $galones_diesel_sector) Return Control objects filtered by the galones_diesel_sector column
 * @method array findByDiasCantidadSector(string $dias_cantidad_sector) Return Control objects filtered by the dias_cantidad_sector column
 * @method array findByHorasDiariasSector(string $horas_diarias_sector) Return Control objects filtered by the horas_diarias_sector column
 * @method array findByHorasTotalSector(string $horas_total_sector) Return Control objects filtered by the horas_total_sector column
 * @method array findByGrosorBalastoSector(string $grosor_balasto_sector) Return Control objects filtered by the grosor_balasto_sector column
 * @method array findByRepacarionSector(string $repacarion_sector) Return Control objects filtered by the repacarion_sector column
 * @method array findByMaquinariaId(string $maquinaria_id) Return Control objects filtered by the maquinaria_id column
 * @method array findByBodegaId(string $bodega_id) Return Control objects filtered by the bodega_id column
 * @method array findByObservaciones(string $observaciones) Return Control objects filtered by the observaciones column
 */
abstract class BaseControlQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseControlQuery object.
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
            $modelName = 'Colli\\ControlBundle\\Model\\Control';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ControlQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   ControlQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ControlQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ControlQuery) {
            return $criteria;
        }
        $query = new ControlQuery(null, null, $modelAlias);

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
     * @return   Control|Control[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ControlPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ControlPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Control A model object, or null if the key is not found
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
     * @return                 Control A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `canton_id`, `sector_id`, `cantidad_camionadas_sector`, `precio_diesel_sector`, `galones_diesel_sector`, `dias_cantidad_sector`, `horas_diarias_sector`, `horas_total_sector`, `grosor_balasto_sector`, `repacarion_sector`, `maquinaria_id`, `bodega_id`, `observaciones` FROM `control` WHERE `id` = :p0';
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
            $obj = new Control();
            $obj->hydrate($row);
            ControlPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Control|Control[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Control[]|mixed the list of results, formatted by the current formatter
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
     * @return ControlQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ControlPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ControlQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ControlPeer::ID, $keys, Criteria::IN);
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
     * @return ControlQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ControlPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ControlPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ControlPeer::ID, $id, $comparison);
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
     * @return ControlQuery The current query, for fluid interface
     */
    public function filterByCantonId($cantonId = null, $comparison = null)
    {
        if (is_array($cantonId)) {
            $useMinMax = false;
            if (isset($cantonId['min'])) {
                $this->addUsingAlias(ControlPeer::CANTON_ID, $cantonId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cantonId['max'])) {
                $this->addUsingAlias(ControlPeer::CANTON_ID, $cantonId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ControlPeer::CANTON_ID, $cantonId, $comparison);
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
     * @return ControlQuery The current query, for fluid interface
     */
    public function filterBySectorId($sectorId = null, $comparison = null)
    {
        if (is_array($sectorId)) {
            $useMinMax = false;
            if (isset($sectorId['min'])) {
                $this->addUsingAlias(ControlPeer::SECTOR_ID, $sectorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sectorId['max'])) {
                $this->addUsingAlias(ControlPeer::SECTOR_ID, $sectorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ControlPeer::SECTOR_ID, $sectorId, $comparison);
    }

    /**
     * Filter the query on the cantidad_camionadas_sector column
     *
     * Example usage:
     * <code>
     * $query->filterByCantidadCamionadasSector('fooValue');   // WHERE cantidad_camionadas_sector = 'fooValue'
     * $query->filterByCantidadCamionadasSector('%fooValue%'); // WHERE cantidad_camionadas_sector LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cantidadCamionadasSector The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ControlQuery The current query, for fluid interface
     */
    public function filterByCantidadCamionadasSector($cantidadCamionadasSector = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cantidadCamionadasSector)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cantidadCamionadasSector)) {
                $cantidadCamionadasSector = str_replace('*', '%', $cantidadCamionadasSector);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ControlPeer::CANTIDAD_CAMIONADAS_SECTOR, $cantidadCamionadasSector, $comparison);
    }

    /**
     * Filter the query on the precio_diesel_sector column
     *
     * Example usage:
     * <code>
     * $query->filterByPrecioDieselSector('fooValue');   // WHERE precio_diesel_sector = 'fooValue'
     * $query->filterByPrecioDieselSector('%fooValue%'); // WHERE precio_diesel_sector LIKE '%fooValue%'
     * </code>
     *
     * @param     string $precioDieselSector The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ControlQuery The current query, for fluid interface
     */
    public function filterByPrecioDieselSector($precioDieselSector = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($precioDieselSector)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $precioDieselSector)) {
                $precioDieselSector = str_replace('*', '%', $precioDieselSector);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ControlPeer::PRECIO_DIESEL_SECTOR, $precioDieselSector, $comparison);
    }

    /**
     * Filter the query on the galones_diesel_sector column
     *
     * Example usage:
     * <code>
     * $query->filterByGalonesDieselSector('fooValue');   // WHERE galones_diesel_sector = 'fooValue'
     * $query->filterByGalonesDieselSector('%fooValue%'); // WHERE galones_diesel_sector LIKE '%fooValue%'
     * </code>
     *
     * @param     string $galonesDieselSector The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ControlQuery The current query, for fluid interface
     */
    public function filterByGalonesDieselSector($galonesDieselSector = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($galonesDieselSector)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $galonesDieselSector)) {
                $galonesDieselSector = str_replace('*', '%', $galonesDieselSector);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ControlPeer::GALONES_DIESEL_SECTOR, $galonesDieselSector, $comparison);
    }

    /**
     * Filter the query on the dias_cantidad_sector column
     *
     * Example usage:
     * <code>
     * $query->filterByDiasCantidadSector('fooValue');   // WHERE dias_cantidad_sector = 'fooValue'
     * $query->filterByDiasCantidadSector('%fooValue%'); // WHERE dias_cantidad_sector LIKE '%fooValue%'
     * </code>
     *
     * @param     string $diasCantidadSector The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ControlQuery The current query, for fluid interface
     */
    public function filterByDiasCantidadSector($diasCantidadSector = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($diasCantidadSector)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $diasCantidadSector)) {
                $diasCantidadSector = str_replace('*', '%', $diasCantidadSector);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ControlPeer::DIAS_CANTIDAD_SECTOR, $diasCantidadSector, $comparison);
    }

    /**
     * Filter the query on the horas_diarias_sector column
     *
     * Example usage:
     * <code>
     * $query->filterByHorasDiariasSector('fooValue');   // WHERE horas_diarias_sector = 'fooValue'
     * $query->filterByHorasDiariasSector('%fooValue%'); // WHERE horas_diarias_sector LIKE '%fooValue%'
     * </code>
     *
     * @param     string $horasDiariasSector The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ControlQuery The current query, for fluid interface
     */
    public function filterByHorasDiariasSector($horasDiariasSector = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($horasDiariasSector)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $horasDiariasSector)) {
                $horasDiariasSector = str_replace('*', '%', $horasDiariasSector);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ControlPeer::HORAS_DIARIAS_SECTOR, $horasDiariasSector, $comparison);
    }

    /**
     * Filter the query on the horas_total_sector column
     *
     * Example usage:
     * <code>
     * $query->filterByHorasTotalSector('fooValue');   // WHERE horas_total_sector = 'fooValue'
     * $query->filterByHorasTotalSector('%fooValue%'); // WHERE horas_total_sector LIKE '%fooValue%'
     * </code>
     *
     * @param     string $horasTotalSector The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ControlQuery The current query, for fluid interface
     */
    public function filterByHorasTotalSector($horasTotalSector = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($horasTotalSector)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $horasTotalSector)) {
                $horasTotalSector = str_replace('*', '%', $horasTotalSector);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ControlPeer::HORAS_TOTAL_SECTOR, $horasTotalSector, $comparison);
    }

    /**
     * Filter the query on the grosor_balasto_sector column
     *
     * Example usage:
     * <code>
     * $query->filterByGrosorBalastoSector('fooValue');   // WHERE grosor_balasto_sector = 'fooValue'
     * $query->filterByGrosorBalastoSector('%fooValue%'); // WHERE grosor_balasto_sector LIKE '%fooValue%'
     * </code>
     *
     * @param     string $grosorBalastoSector The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ControlQuery The current query, for fluid interface
     */
    public function filterByGrosorBalastoSector($grosorBalastoSector = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($grosorBalastoSector)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $grosorBalastoSector)) {
                $grosorBalastoSector = str_replace('*', '%', $grosorBalastoSector);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ControlPeer::GROSOR_BALASTO_SECTOR, $grosorBalastoSector, $comparison);
    }

    /**
     * Filter the query on the repacarion_sector column
     *
     * Example usage:
     * <code>
     * $query->filterByRepacarionSector('fooValue');   // WHERE repacarion_sector = 'fooValue'
     * $query->filterByRepacarionSector('%fooValue%'); // WHERE repacarion_sector LIKE '%fooValue%'
     * </code>
     *
     * @param     string $repacarionSector The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ControlQuery The current query, for fluid interface
     */
    public function filterByRepacarionSector($repacarionSector = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($repacarionSector)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $repacarionSector)) {
                $repacarionSector = str_replace('*', '%', $repacarionSector);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ControlPeer::REPACARION_SECTOR, $repacarionSector, $comparison);
    }

    /**
     * Filter the query on the maquinaria_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMaquinariaId('fooValue');   // WHERE maquinaria_id = 'fooValue'
     * $query->filterByMaquinariaId('%fooValue%'); // WHERE maquinaria_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $maquinariaId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ControlQuery The current query, for fluid interface
     */
    public function filterByMaquinariaId($maquinariaId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($maquinariaId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $maquinariaId)) {
                $maquinariaId = str_replace('*', '%', $maquinariaId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ControlPeer::MAQUINARIA_ID, $maquinariaId, $comparison);
    }

    /**
     * Filter the query on the bodega_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBodegaId('fooValue');   // WHERE bodega_id = 'fooValue'
     * $query->filterByBodegaId('%fooValue%'); // WHERE bodega_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bodegaId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ControlQuery The current query, for fluid interface
     */
    public function filterByBodegaId($bodegaId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bodegaId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $bodegaId)) {
                $bodegaId = str_replace('*', '%', $bodegaId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ControlPeer::BODEGA_ID, $bodegaId, $comparison);
    }

    /**
     * Filter the query on the observaciones column
     *
     * Example usage:
     * <code>
     * $query->filterByObservaciones('fooValue');   // WHERE observaciones = 'fooValue'
     * $query->filterByObservaciones('%fooValue%'); // WHERE observaciones LIKE '%fooValue%'
     * </code>
     *
     * @param     string $observaciones The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ControlQuery The current query, for fluid interface
     */
    public function filterByObservaciones($observaciones = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($observaciones)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $observaciones)) {
                $observaciones = str_replace('*', '%', $observaciones);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ControlPeer::OBSERVACIONES, $observaciones, $comparison);
    }

    /**
     * Filter the query by a related Canton object
     *
     * @param   Canton|PropelObjectCollection $canton The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ControlQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByCanton($canton, $comparison = null)
    {
        if ($canton instanceof Canton) {
            return $this
                ->addUsingAlias(ControlPeer::CANTON_ID, $canton->getId(), $comparison);
        } elseif ($canton instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ControlPeer::CANTON_ID, $canton->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return ControlQuery The current query, for fluid interface
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
     * Filter the query by a related Sector object
     *
     * @param   Sector|PropelObjectCollection $sector The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ControlQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterBySector($sector, $comparison = null)
    {
        if ($sector instanceof Sector) {
            return $this
                ->addUsingAlias(ControlPeer::SECTOR_ID, $sector->getId(), $comparison);
        } elseif ($sector instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ControlPeer::SECTOR_ID, $sector->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return ControlQuery The current query, for fluid interface
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
     * Filter the query by a related Maquinaria object
     *
     * @param   Maquinaria|PropelObjectCollection $maquinaria The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ControlQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByMaquinaria($maquinaria, $comparison = null)
    {
        if ($maquinaria instanceof Maquinaria) {
            return $this
                ->addUsingAlias(ControlPeer::MAQUINARIA_ID, $maquinaria->getId(), $comparison);
        } elseif ($maquinaria instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ControlPeer::MAQUINARIA_ID, $maquinaria->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return ControlQuery The current query, for fluid interface
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
     * Filter the query by a related Bodega object
     *
     * @param   Bodega|PropelObjectCollection $bodega The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ControlQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByBodega($bodega, $comparison = null)
    {
        if ($bodega instanceof Bodega) {
            return $this
                ->addUsingAlias(ControlPeer::BODEGA_ID, $bodega->getId(), $comparison);
        } elseif ($bodega instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ControlPeer::BODEGA_ID, $bodega->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return ControlQuery The current query, for fluid interface
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
     * @param   Control $control Object to remove from the list of results
     *
     * @return ControlQuery The current query, for fluid interface
     */
    public function prune($control = null)
    {
        if ($control) {
            $this->addUsingAlias(ControlPeer::ID, $control->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
