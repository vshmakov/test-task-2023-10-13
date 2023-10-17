<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20231017190439 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates coupon and product tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE coupon (code VARCHAR(12) NOT NULL, type VARCHAR(12) NOT NULL, amount INT DEFAULT NULL, percent NUMERIC(9, 2) DEFAULT NULL, PRIMARY KEY(code))');
        $this->addSql('COMMENT ON COLUMN coupon.amount IS \'(DC2Type:eur)\'');
        $this->addSql('CREATE TABLE product (id INT NOT NULL, title VARCHAR(255) NOT NULL, price INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN product.price IS \'(DC2Type:eur)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE product_id_seq CASCADE');
        $this->addSql('DROP TABLE coupon');
        $this->addSql('DROP TABLE product');
    }
}
