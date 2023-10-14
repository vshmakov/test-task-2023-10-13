<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20231014142402 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates product and purchase tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE purchase_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE product (id INT NOT NULL, title VARCHAR(255) NOT NULL, price INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN product.price IS \'(DC2Type:eur)\'');
        $this->addSql('CREATE TABLE purchase (id INT NOT NULL, product_id INT NOT NULL, tax_number VARCHAR(20) NOT NULL, coupon_code VARCHAR(20) NOT NULL, payment_processor VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6117D13B4584665A ON purchase (product_id)');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13B4584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE product_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE purchase_id_seq CASCADE');
        $this->addSql('ALTER TABLE purchase DROP CONSTRAINT FK_6117D13B4584665A');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE purchase');
    }
}
