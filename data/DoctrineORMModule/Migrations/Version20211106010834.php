<?php declare(strict_types=1);

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211106010834 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $createTableVehicle = <<<SQL

        CREATE TABLE vehicle (
        uuid NVARCHAR(36) NOT NULL,
        merk NVARCHAR(36) NULL DEFAULT NULL,
        plate_number NVARCHAR(12) NULL DEFAULT NULL,
        type NVARCHAR(20) NULL DEFAULT NULL,
        created_at DATETIME2 NOT NULL,
        updated_at DATETIME2 NULL,
        deleted_at DATETIME2 NULL,
        PRIMARY KEY (uuid));

SQL;    
        $this->addsql($createTableVehicle);
    }

    public function down(Schema $schema) : void
    {
        $dropTableVehicle =<<<SQL
        DROP TABLE vehicle;
SQL;
        $this->addsql($dropTableVehicle);
    }
}
