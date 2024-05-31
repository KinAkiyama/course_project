<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240530212017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_collection ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE item_collection ADD CONSTRAINT FK_41FC4D38F675F31B FOREIGN KEY (author_id) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_41FC4D38F675F31B ON item_collection (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE item_collection DROP CONSTRAINT FK_41FC4D38F675F31B');
        $this->addSql('DROP INDEX IDX_41FC4D38F675F31B');
        $this->addSql('ALTER TABLE item_collection DROP author_id');
    }
}
