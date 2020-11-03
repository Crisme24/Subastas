<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201103132756 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pujas RENAME INDEX fk_pujas_subastas TO IDX_93BB73EA60B185C4');
        $this->addSql('ALTER TABLE pujas RENAME INDEX fk_pujas_users TO IDX_93BB73EAA76ED395');
        $this->addSql('ALTER TABLE subastas CHANGE user_id user_id INT DEFAULT NULL, CHANGE min_price min_price NUMERIC(20, 2) NOT NULL, CHANGE max_price max_price NUMERIC(20, 2) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pujas RENAME INDEX idx_93bb73eaa76ed395 TO fk_pujas_users');
        $this->addSql('ALTER TABLE pujas RENAME INDEX idx_93bb73ea60b185c4 TO fk_pujas_subastas');
        $this->addSql('ALTER TABLE subastas CHANGE user_id user_id INT NOT NULL, CHANGE min_price min_price DOUBLE PRECISION NOT NULL, CHANGE max_price max_price DOUBLE PRECISION NOT NULL');
    }
}
