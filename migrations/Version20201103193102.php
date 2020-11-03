<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201103193102 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pujas (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, subasta_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, create_at DATETIME NOT NULL, INDEX IDX_93BB73EA60B185C4 (subasta_id), INDEX IDX_93BB73EAA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subastas (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, image VARCHAR(255) DEFAULT \'NULL\', min_price NUMERIC(20, 2) NOT NULL, max_price NUMERIC(20, 2) NOT NULL, start_date DATETIME DEFAULT \'current_timestamp()\', end_date DATETIME DEFAULT \'current_timestamp()\', status VARCHAR(20) DEFAULT \'NULL\', INDEX fk_subastas_users (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, surname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(50) DEFAULT \'NULL\', created_at DATETIME DEFAULT \'current_timestamp()\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pujas ADD CONSTRAINT FK_93BB73EA60B185C4 FOREIGN KEY (subasta_id) REFERENCES subastas (id)');
        $this->addSql('ALTER TABLE pujas ADD CONSTRAINT FK_93BB73EAA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE subastas ADD CONSTRAINT FK_875BF3A4A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pujas DROP FOREIGN KEY FK_93BB73EA60B185C4');
        $this->addSql('ALTER TABLE pujas DROP FOREIGN KEY FK_93BB73EAA76ED395');
        $this->addSql('ALTER TABLE subastas DROP FOREIGN KEY FK_875BF3A4A76ED395');
        $this->addSql('DROP TABLE pujas');
        $this->addSql('DROP TABLE subastas');
        $this->addSql('DROP TABLE users');
    }
}
