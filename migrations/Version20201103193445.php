<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201103193445 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pujas ADD CONSTRAINT FK_93BB73EA60B185C4 FOREIGN KEY (subasta_id) REFERENCES subastas (id)');
        $this->addSql('ALTER TABLE pujas ADD CONSTRAINT FK_93BB73EAA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE subastas CHANGE user_id user_id INT DEFAULT NULL, CHANGE image image VARCHAR(255) DEFAULT \'NULL\', CHANGE min_price min_price NUMERIC(20, 2) NOT NULL, CHANGE max_price max_price NUMERIC(20, 2) NOT NULL, CHANGE start_date start_date DATETIME DEFAULT \'current_timestamp()\', CHANGE end_date end_date DATETIME DEFAULT \'current_timestamp()\', CHANGE status status VARCHAR(20) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE users CHANGE role role VARCHAR(50) DEFAULT \'NULL\', CHANGE created_at created_at DATETIME DEFAULT \'current_timestamp()\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pujas DROP FOREIGN KEY FK_93BB73EA60B185C4');
        $this->addSql('ALTER TABLE pujas DROP FOREIGN KEY FK_93BB73EAA76ED395');
        $this->addSql('ALTER TABLE subastas CHANGE user_id user_id INT NOT NULL, CHANGE image image VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CHANGE min_price min_price DOUBLE PRECISION NOT NULL, CHANGE max_price max_price DOUBLE PRECISION NOT NULL, CHANGE start_date start_date DATETIME DEFAULT CURRENT_TIMESTAMP, CHANGE end_date end_date DATETIME DEFAULT CURRENT_TIMESTAMP, CHANGE status status VARCHAR(20) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE users CHANGE role role VARCHAR(50) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP');
    }
}
