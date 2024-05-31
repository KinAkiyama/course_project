<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240531191529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE collection_item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE item_boolean_type_attribute_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE item_date_type_attribute_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE item_integer_type_attribute_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE item_string_type_attribute_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE item_text_type_attribute_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE collection_item (id INT NOT NULL, name VARCHAR(255) NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE item_boolean_type_attribute (id INT NOT NULL, custom_item_attribute_id INT DEFAULT NULL, collection_item_id INT DEFAULT NULL, value BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_969ADB6F8BF3B7B6 ON item_boolean_type_attribute (custom_item_attribute_id)');
        $this->addSql('CREATE INDEX IDX_969ADB6F4643208F ON item_boolean_type_attribute (collection_item_id)');
        $this->addSql('CREATE TABLE item_date_type_attribute (id INT NOT NULL, custom_item_attribute_id INT DEFAULT NULL, collection_item_id INT DEFAULT NULL, value DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DE2CDE6C8BF3B7B6 ON item_date_type_attribute (custom_item_attribute_id)');
        $this->addSql('CREATE INDEX IDX_DE2CDE6C4643208F ON item_date_type_attribute (collection_item_id)');
        $this->addSql('CREATE TABLE item_integer_type_attribute (id INT NOT NULL, custom_item_attribute_id INT DEFAULT NULL, collection_item_id INT DEFAULT NULL, value INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B255DF2B8BF3B7B6 ON item_integer_type_attribute (custom_item_attribute_id)');
        $this->addSql('CREATE INDEX IDX_B255DF2B4643208F ON item_integer_type_attribute (collection_item_id)');
        $this->addSql('CREATE TABLE item_string_type_attribute (id INT NOT NULL, custom_item_attribute_id INT DEFAULT NULL, collection_item_id INT DEFAULT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9FECDC578BF3B7B6 ON item_string_type_attribute (custom_item_attribute_id)');
        $this->addSql('CREATE INDEX IDX_9FECDC574643208F ON item_string_type_attribute (collection_item_id)');
        $this->addSql('CREATE TABLE item_text_type_attribute (id INT NOT NULL, custom_item_attribute_id INT DEFAULT NULL, collection_item_id INT DEFAULT NULL, value TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1B91F53E8BF3B7B6 ON item_text_type_attribute (custom_item_attribute_id)');
        $this->addSql('CREATE INDEX IDX_1B91F53E4643208F ON item_text_type_attribute (collection_item_id)');
        $this->addSql('ALTER TABLE item_boolean_type_attribute ADD CONSTRAINT FK_969ADB6F8BF3B7B6 FOREIGN KEY (custom_item_attribute_id) REFERENCES custom_item_attribute (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE item_boolean_type_attribute ADD CONSTRAINT FK_969ADB6F4643208F FOREIGN KEY (collection_item_id) REFERENCES collection_item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE item_date_type_attribute ADD CONSTRAINT FK_DE2CDE6C8BF3B7B6 FOREIGN KEY (custom_item_attribute_id) REFERENCES custom_item_attribute (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE item_date_type_attribute ADD CONSTRAINT FK_DE2CDE6C4643208F FOREIGN KEY (collection_item_id) REFERENCES collection_item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE item_integer_type_attribute ADD CONSTRAINT FK_B255DF2B8BF3B7B6 FOREIGN KEY (custom_item_attribute_id) REFERENCES custom_item_attribute (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE item_integer_type_attribute ADD CONSTRAINT FK_B255DF2B4643208F FOREIGN KEY (collection_item_id) REFERENCES collection_item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE item_string_type_attribute ADD CONSTRAINT FK_9FECDC578BF3B7B6 FOREIGN KEY (custom_item_attribute_id) REFERENCES custom_item_attribute (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE item_string_type_attribute ADD CONSTRAINT FK_9FECDC574643208F FOREIGN KEY (collection_item_id) REFERENCES collection_item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE item_text_type_attribute ADD CONSTRAINT FK_1B91F53E8BF3B7B6 FOREIGN KEY (custom_item_attribute_id) REFERENCES custom_item_attribute (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE item_text_type_attribute ADD CONSTRAINT FK_1B91F53E4643208F FOREIGN KEY (collection_item_id) REFERENCES collection_item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE collection_item_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE item_boolean_type_attribute_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE item_date_type_attribute_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE item_integer_type_attribute_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE item_string_type_attribute_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE item_text_type_attribute_id_seq CASCADE');
        $this->addSql('ALTER TABLE item_boolean_type_attribute DROP CONSTRAINT FK_969ADB6F8BF3B7B6');
        $this->addSql('ALTER TABLE item_boolean_type_attribute DROP CONSTRAINT FK_969ADB6F4643208F');
        $this->addSql('ALTER TABLE item_date_type_attribute DROP CONSTRAINT FK_DE2CDE6C8BF3B7B6');
        $this->addSql('ALTER TABLE item_date_type_attribute DROP CONSTRAINT FK_DE2CDE6C4643208F');
        $this->addSql('ALTER TABLE item_integer_type_attribute DROP CONSTRAINT FK_B255DF2B8BF3B7B6');
        $this->addSql('ALTER TABLE item_integer_type_attribute DROP CONSTRAINT FK_B255DF2B4643208F');
        $this->addSql('ALTER TABLE item_string_type_attribute DROP CONSTRAINT FK_9FECDC578BF3B7B6');
        $this->addSql('ALTER TABLE item_string_type_attribute DROP CONSTRAINT FK_9FECDC574643208F');
        $this->addSql('ALTER TABLE item_text_type_attribute DROP CONSTRAINT FK_1B91F53E8BF3B7B6');
        $this->addSql('ALTER TABLE item_text_type_attribute DROP CONSTRAINT FK_1B91F53E4643208F');
        $this->addSql('DROP TABLE collection_item');
        $this->addSql('DROP TABLE item_boolean_type_attribute');
        $this->addSql('DROP TABLE item_date_type_attribute');
        $this->addSql('DROP TABLE item_integer_type_attribute');
        $this->addSql('DROP TABLE item_string_type_attribute');
        $this->addSql('DROP TABLE item_text_type_attribute');
    }
}
