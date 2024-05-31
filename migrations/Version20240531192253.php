<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240531192253 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collection_item ADD item_collection_id INT NOT NULL');
        $this->addSql('ALTER TABLE collection_item ADD CONSTRAINT FK_556C09F0BDE5FE26 FOREIGN KEY (item_collection_id) REFERENCES item_collection (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_556C09F0BDE5FE26 ON collection_item (item_collection_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE collection_item DROP CONSTRAINT FK_556C09F0BDE5FE26');
        $this->addSql('DROP INDEX IDX_556C09F0BDE5FE26');
        $this->addSql('ALTER TABLE collection_item DROP item_collection_id');
    }
}
