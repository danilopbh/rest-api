<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241007194809 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE certidao_divida_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE contribuinte_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE certidao_divida_siatu_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE certidao_divida_supp_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contribuinte_siatu_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contribuinte_supp_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE certidao_divida_siatu (id INT NOT NULL, contribuinte_id_id INT NOT NULL, valor DOUBLE PRECISION NOT NULL, pdfdivida BYTEA DEFAULT NULL, descricao VARCHAR(255) DEFAULT NULL, data_vencimento DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_36C56A918FD08BF3 ON certidao_divida_siatu (contribuinte_id_id)');
        $this->addSql('CREATE TABLE certidao_divida_supp (id INT NOT NULL, id_contribuinte_supp_id INT NOT NULL, valor DOUBLE PRECISION NOT NULL, pdfdivida BYTEA NOT NULL, descricao VARCHAR(255) DEFAULT NULL, data_vencimento DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_88C2AAE4BBA849FD ON certidao_divida_supp (id_contribuinte_supp_id)');
        $this->addSql('CREATE TABLE contribuinte_supp (id INT NOT NULL, nome VARCHAR(255) NOT NULL, cpf VARCHAR(255) NOT NULL, endereco VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE certidao_divida_siatu ADD CONSTRAINT FK_36C56A918FD08BF3 FOREIGN KEY (contribuinte_id_id) REFERENCES contribuinte_siatu (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE certidao_divida_supp ADD CONSTRAINT FK_88C2AAE4BBA849FD FOREIGN KEY (id_contribuinte_supp_id) REFERENCES contribuinte_supp (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE certida_divida_siatu DROP CONSTRAINT fk_20e0a4962563b399');
        $this->addSql('DROP TABLE certida_divida_siatu');
        $this->addSql('ALTER TABLE contribuinte_siatu ADD endereco VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE contribuinte_siatu DROP name');
        $this->addSql('ALTER TABLE contribuinte_siatu ALTER cpf TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE contribuinte_siatu RENAME COLUMN adress TO nome');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE certidao_divida_siatu_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE certidao_divida_supp_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE contribuinte_siatu_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE contribuinte_supp_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE certidao_divida_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contribuinte_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE certida_divida_siatu (id INT NOT NULL, contribuinte_id INT NOT NULL, value DOUBLE PRECISION NOT NULL, date_payment DATE DEFAULT NULL, description VARCHAR(255) NOT NULL, pdfdivida BYTEA DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_20e0a4962563b399 ON certida_divida_siatu (contribuinte_id)');
        $this->addSql('ALTER TABLE certida_divida_siatu ADD CONSTRAINT fk_20e0a4962563b399 FOREIGN KEY (contribuinte_id) REFERENCES contribuinte_siatu (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE certidao_divida_siatu DROP CONSTRAINT FK_36C56A918FD08BF3');
        $this->addSql('ALTER TABLE certidao_divida_supp DROP CONSTRAINT FK_88C2AAE4BBA849FD');
        $this->addSql('DROP TABLE certidao_divida_siatu');
        $this->addSql('DROP TABLE certidao_divida_supp');
        $this->addSql('DROP TABLE contribuinte_supp');
        $this->addSql('ALTER TABLE contribuinte_siatu ADD name VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE contribuinte_siatu ADD adress VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE contribuinte_siatu DROP nome');
        $this->addSql('ALTER TABLE contribuinte_siatu DROP endereco');
        $this->addSql('ALTER TABLE contribuinte_siatu ALTER cpf TYPE VARCHAR(20)');
    }
}
