<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210926212153 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredients_compose_modele (id INT AUTO_INCREMENT NOT NULL, grammage INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE modele DROP FOREIGN KEY FK_10028558D970B6A5');
        $this->addSql('DROP INDEX UNIQ_17AE806ED970B6A5 ON modele');
        $this->addSql('ALTER TABLE modele CHANGE procede_id id_procede_id INT NOT NULL');
        $this->addSql('ALTER TABLE modele ADD CONSTRAINT FK_17AE806E7CFA3672 FOREIGN KEY (id_procede_id) REFERENCES procede (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_17AE806E7CFA3672 ON modele (id_procede_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ingredients_compose_modele');
        $this->addSql('ALTER TABLE Modele DROP FOREIGN KEY FK_17AE806E7CFA3672');
        $this->addSql('DROP INDEX UNIQ_17AE806E7CFA3672 ON Modele');
        $this->addSql('ALTER TABLE Modele CHANGE id_procede_id procede_id INT NOT NULL');
        $this->addSql('ALTER TABLE Modele ADD CONSTRAINT FK_10028558D970B6A5 FOREIGN KEY (procede_id) REFERENCES procede (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_17AE806ED970B6A5 ON Modele (procede_id)');
    }
}
