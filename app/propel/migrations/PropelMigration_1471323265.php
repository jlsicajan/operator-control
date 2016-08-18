<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1471323265.
 * Generated on 2016-08-16 06:54:25 
 */
class PropelMigration_1471323265
{

    public function preUp($manager)
    {
        // add the pre-migration code here
    }

    public function postUp($manager)
    {
        // add the post-migration code here
    }

    public function preDown($manager)
    {
        // add the pre-migration code here
    }

    public function postDown($manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `bodega` CHANGE `equipo_id` `equipo_id` INTEGER(11) NOT NULL;

ALTER TABLE `bodega` CHANGE `cantidad` `cantidad` INTEGER(11) NOT NULL;

ALTER TABLE `bodega` CHANGE `precio` `precio` INTEGER(11);

ALTER TABLE `bodega` CHANGE `maquinaria_id` `maquinaria_id` INTEGER(11);

ALTER TABLE `control` CHANGE `canton_id` `canton_id` INTEGER(11) NOT NULL;

ALTER TABLE `control` CHANGE `sector_id` `sector_id` INTEGER(11) NOT NULL;

ALTER TABLE `control_bodega` CHANGE `bodega_id` `bodega_id` INTEGER(11);

ALTER TABLE `control_bodega` CHANGE `maquinaria_id` `maquinaria_id` INTEGER(11) NOT NULL;

ALTER TABLE `control_bodega` CHANGE `canton_id` `canton_id` INTEGER(11);

ALTER TABLE `control_bodega` CHANGE `sector_id` `sector_id` INTEGER(11);

ALTER TABLE `maquinaria` CHANGE `numero` `numero` INTEGER(11) NOT NULL;

ALTER TABLE `sector` CHANGE `ancho` `ancho` INTEGER(11) NOT NULL;

ALTER TABLE `sector` CHANGE `largo` `largo` INTEGER(11) NOT NULL;

ALTER TABLE `sector` CHANGE `canton_id` `canton_id` INTEGER(11) NOT NULL;

CREATE TABLE `trabajador`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE `trabajador_control`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `trabajador_id` VARCHAR(15),
    `tarea` VARCHAR(250),
    PRIMARY KEY (`id`),
    INDEX `trabajador_control_FI_1` (`trabajador_id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `trabajador`;

DROP TABLE IF EXISTS `trabajador_control`;

ALTER TABLE `bodega` CHANGE `equipo_id` `equipo_id` INTEGER NOT NULL;

ALTER TABLE `bodega` CHANGE `cantidad` `cantidad` INTEGER NOT NULL;

ALTER TABLE `bodega` CHANGE `precio` `precio` INTEGER;

ALTER TABLE `bodega` CHANGE `maquinaria_id` `maquinaria_id` INTEGER;

ALTER TABLE `control` CHANGE `canton_id` `canton_id` INTEGER NOT NULL;

ALTER TABLE `control` CHANGE `sector_id` `sector_id` INTEGER NOT NULL;

ALTER TABLE `control_bodega` CHANGE `bodega_id` `bodega_id` INTEGER;

ALTER TABLE `control_bodega` CHANGE `maquinaria_id` `maquinaria_id` INTEGER NOT NULL;

ALTER TABLE `control_bodega` CHANGE `canton_id` `canton_id` INTEGER;

ALTER TABLE `control_bodega` CHANGE `sector_id` `sector_id` INTEGER;

ALTER TABLE `maquinaria` CHANGE `numero` `numero` INTEGER NOT NULL;

ALTER TABLE `sector` CHANGE `ancho` `ancho` INTEGER NOT NULL;

ALTER TABLE `sector` CHANGE `largo` `largo` INTEGER NOT NULL;

ALTER TABLE `sector` CHANGE `canton_id` `canton_id` INTEGER NOT NULL;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}