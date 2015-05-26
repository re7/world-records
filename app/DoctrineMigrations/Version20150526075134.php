<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150526075134 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE security_user ADD uuid VARCHAR(255)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_52825A88D17F50A6 ON security_user (uuid)');
        $this->addSql('UPDATE security_user SET uuid = identifier WHERE uuid IS NULL');
        $this->addSql('ALTER TABLE security_user CHANGE uuid uuid VARCHAR(255) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_52825A88D17F50A6 ON security_user');
        $this->addSql('ALTER TABLE security_user DROP uuid');
    }
}
