<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231102170000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(200) NOT NULL, email VARCHAR(100) DEFAULT NULL, address VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guide (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(200) NOT NULL, hiring_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE period (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(200) NOT NULL, description LONGTEXT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE travel (id INT AUTO_INCREMENT NOT NULL, guide_id INT NOT NULL, period_id INT NOT NULL, departure_date DATE NOT NULL, arrival_date DATE NOT NULL, price DOUBLE PRECISION NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_2D0B6BCED7ED1D4B (guide_id), INDEX IDX_2D0B6BCEEC8B7ADE (period_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE travel_customer (travel_id INT NOT NULL, customer_id INT NOT NULL, INDEX IDX_EB48ED4CECAB15B3 (travel_id), INDEX IDX_EB48ED4C9395C3F3 (customer_id), PRIMARY KEY(travel_id, customer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE travel ADD CONSTRAINT FK_2D0B6BCED7ED1D4B FOREIGN KEY (guide_id) REFERENCES guide (id)');
        $this->addSql('ALTER TABLE travel ADD CONSTRAINT FK_2D0B6BCEEC8B7ADE FOREIGN KEY (period_id) REFERENCES period (id)');
        $this->addSql('ALTER TABLE travel_customer ADD CONSTRAINT FK_EB48ED4CECAB15B3 FOREIGN KEY (travel_id) REFERENCES travel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE travel_customer ADD CONSTRAINT FK_EB48ED4C9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE travel DROP FOREIGN KEY FK_2D0B6BCED7ED1D4B');
        $this->addSql('ALTER TABLE travel DROP FOREIGN KEY FK_2D0B6BCEEC8B7ADE');
        $this->addSql('ALTER TABLE travel_customer DROP FOREIGN KEY FK_EB48ED4CECAB15B3');
        $this->addSql('ALTER TABLE travel_customer DROP FOREIGN KEY FK_EB48ED4C9395C3F3');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE guide');
        $this->addSql('DROP TABLE period');
        $this->addSql('DROP TABLE travel');
        $this->addSql('DROP TABLE travel_customer');
    }
}
