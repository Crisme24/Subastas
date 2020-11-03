<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201101125937 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE biddings CHANGE sale_id sale_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE products CHANGE category_id category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sales CHANGE user_id user_id INT DEFAULT NULL, CHANGE product_id product_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE biddings CHANGE sale_id sale_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE products CHANGE category_id category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sales CHANGE product_id product_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL');
    }
}
