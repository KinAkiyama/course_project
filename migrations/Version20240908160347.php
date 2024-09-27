<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240908160347 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE collection_category (id UUID NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN collection_category.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE custom_item_attribute (id UUID NOT NULL, item_collection_id UUID NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DC45CCD1BDE5FE26 ON custom_item_attribute (item_collection_id)');
        $this->addSql('COMMENT ON COLUMN custom_item_attribute.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN custom_item_attribute.item_collection_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE item (id UUID NOT NULL, item_collection_id UUID NOT NULL, user_id VARCHAR(255) NOT NULL, name VARCHAR(180) NOT NULL, added_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1F1B251EBDE5FE26 ON item (item_collection_id)');
        $this->addSql('COMMENT ON COLUMN item.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN item.item_collection_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN item.added_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE items_to_tags (item_id UUID NOT NULL, item_tag_id UUID NOT NULL, PRIMARY KEY(item_id, item_tag_id))');
        $this->addSql('CREATE INDEX IDX_F4D2DDE8126F525E ON items_to_tags (item_id)');
        $this->addSql('CREATE INDEX IDX_F4D2DDE83C2B16DE ON items_to_tags (item_tag_id)');
        $this->addSql('COMMENT ON COLUMN items_to_tags.item_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN items_to_tags.item_tag_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE item_collection (id UUID NOT NULL, category_id UUID NOT NULL, name VARCHAR(180) NOT NULL, description VARCHAR(180) NOT NULL, image_url VARCHAR(255) DEFAULT NULL, user_id VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_41FC4D3812469DE2 ON item_collection (category_id)');
        $this->addSql('COMMENT ON COLUMN item_collection.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN item_collection.category_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE item_tags (id UUID NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A78CD0DD5E237E06 ON item_tags (name)');
        $this->addSql('COMMENT ON COLUMN item_tags.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE "users" (id UUID NOT NULL, username VARCHAR(180) NOT NULL, password VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL, status INT NOT NULL, added_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, last_sign_in_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "users" (username)');
        $this->addSql('COMMENT ON COLUMN "users".id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "users".added_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "users".last_sign_in_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE value_item_attributes (id UUID NOT NULL, item_id UUID NOT NULL, custom_item_attribute_id UUID NOT NULL, type VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E941AF66126F525E ON value_item_attributes (item_id)');
        $this->addSql('CREATE INDEX IDX_E941AF668BF3B7B6 ON value_item_attributes (custom_item_attribute_id)');
        $this->addSql('COMMENT ON COLUMN value_item_attributes.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN value_item_attributes.item_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN value_item_attributes.custom_item_attribute_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE custom_item_attribute ADD CONSTRAINT FK_DC45CCD1BDE5FE26 FOREIGN KEY (item_collection_id) REFERENCES item_collection (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EBDE5FE26 FOREIGN KEY (item_collection_id) REFERENCES item_collection (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE items_to_tags ADD CONSTRAINT FK_F4D2DDE8126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE items_to_tags ADD CONSTRAINT FK_F4D2DDE83C2B16DE FOREIGN KEY (item_tag_id) REFERENCES item_tags (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE item_collection ADD CONSTRAINT FK_41FC4D3812469DE2 FOREIGN KEY (category_id) REFERENCES collection_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE value_item_attributes ADD CONSTRAINT FK_E941AF66126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE value_item_attributes ADD CONSTRAINT FK_E941AF668BF3B7B6 FOREIGN KEY (custom_item_attribute_id) REFERENCES custom_item_attribute (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE custom_item_attribute DROP CONSTRAINT FK_DC45CCD1BDE5FE26');
        $this->addSql('ALTER TABLE item DROP CONSTRAINT FK_1F1B251EBDE5FE26');
        $this->addSql('ALTER TABLE items_to_tags DROP CONSTRAINT FK_F4D2DDE8126F525E');
        $this->addSql('ALTER TABLE items_to_tags DROP CONSTRAINT FK_F4D2DDE83C2B16DE');
        $this->addSql('ALTER TABLE item_collection DROP CONSTRAINT FK_41FC4D3812469DE2');
        $this->addSql('ALTER TABLE value_item_attributes DROP CONSTRAINT FK_E941AF66126F525E');
        $this->addSql('ALTER TABLE value_item_attributes DROP CONSTRAINT FK_E941AF668BF3B7B6');
        $this->addSql('DROP TABLE collection_category');
        $this->addSql('DROP TABLE custom_item_attribute');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE items_to_tags');
        $this->addSql('DROP TABLE item_collection');
        $this->addSql('DROP TABLE item_tags');
        $this->addSql('DROP TABLE "users"');
        $this->addSql('DROP TABLE value_item_attributes');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
