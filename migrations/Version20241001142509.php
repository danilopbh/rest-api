<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241001142509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE certidao_divida_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contribuinte_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE certidao_divida (id INT NOT NULL, contribuinte_id INT NOT NULL, value DOUBLE PRECISION NOT NULL, date_payment DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_20E0A4962563B399 ON certidao_divida (contribuinte_id)');
        $this->addSql('CREATE TABLE contribuinte (id INT NOT NULL, name VARCHAR(50) NOT NULL, cpf VARCHAR(20) NOT NULL, adress VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE certidao_divida ADD CONSTRAINT FK_20E0A4962563B399 FOREIGN KEY (contribuinte_id) REFERENCES contribuinte (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE certidao_divida_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE contribuinte_id_seq CASCADE');
        $this->addSql('ALTER TABLE certidao_divida DROP CONSTRAINT FK_20E0A4962563B399');
        $this->addSql('DROP TABLE certidao_divida');
        $this->addSql('DROP TABLE contribuinte');
    }
}
