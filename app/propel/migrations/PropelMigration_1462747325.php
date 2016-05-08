<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1462747325.
 * Generated on 2016-05-08 17:42:05 by ndrlubuntu
 */
class PropelMigration_1462747325
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

ALTER TABLE `bodega` CHANGE `cantidad` `cantidad` INTEGER(11) NOT NULL;

ALTER TABLE `bodega` CHANGE `precio` `precio` INTEGER(11) NOT NULL;

ALTER TABLE `control` CHANGE `canton_id` `canton_id` INTEGER(11) NOT NULL;

ALTER TABLE `control` CHANGE `sector_id` `sector_id` INTEGER(11) NOT NULL;

ALTER TABLE `control_bodega` CHANGE `bodega_id` `bodega_id` INTEGER(11);

ALTER TABLE `control_bodega`
    ADD `fecha_retiro` DATETIME AFTER `bodega_id`,
    ADD `maquinaria_id` INTEGER(11) NOT NULL AFTER `fecha_retiro`,
    ADD `fecha_ingreso` DATETIME AFTER `maquinaria_id`,
    ADD `canton_id` INTEGER(11) AFTER `fecha_ingreso`,
    ADD `sector_id` INTEGER(11) AFTER `canton_id`;

CREATE INDEX `control_bodega_FI_1` ON `control_bodega` (`canton_id`);

CREATE INDEX `control_bodega_FI_2` ON `control_bodega` (`sector_id`);

CREATE INDEX `control_bodega_FI_3` ON `control_bodega` (`maquinaria_id`);

CREATE INDEX `control_bodega_FI_4` ON `control_bodega` (`bodega_id`);

ALTER TABLE `maquinaria` CHANGE `numero` `numero` INTEGER(11) NOT NULL;

ALTER TABLE `sector` CHANGE `ancho` `ancho` INTEGER(11) NOT NULL;

ALTER TABLE `sector` CHANGE `largo` `largo` INTEGER(11) NOT NULL;

ALTER TABLE `sector` CHANGE `canton_id` `canton_id` INTEGER(11) NOT NULL;

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

ALTER TABLE `bodega` CHANGE `cantidad` `cantidad` INTEGER NOT NULL;

ALTER TABLE `bodega` CHANGE `precio` `precio` INTEGER NOT NULL;

ALTER TABLE `control` CHANGE `canton_id` `canton_id` INTEGER NOT NULL;

ALTER TABLE `control` CHANGE `sector_id` `sector_id` INTEGER NOT NULL;

DROP INDEX `control_bodega_FI_1` ON `control_bodega`;

DROP INDEX `control_bodega_FI_2` ON `control_bodega`;

DROP INDEX `control_bodega_FI_3` ON `control_bodega`;

DROP INDEX `control_bodega_FI_4` ON `control_bodega`;

ALTER TABLE `control_bodega` CHANGE `bodega_id` `bodega_id` INTEGER;

ALTER TABLE `control_bodega` DROP `fecha_retiro`;

ALTER TABLE `control_bodega` DROP `maquinaria_id`;

ALTER TABLE `control_bodega` DROP `fecha_ingreso`;

ALTER TABLE `control_bodega` DROP `canton_id`;

ALTER TABLE `control_bodega` DROP `sector_id`;

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