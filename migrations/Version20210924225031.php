<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210924225031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE modele ADD procede_id INT NOT NULL');
        $this->addSql('ALTER TABLE modele ADD CONSTRAINT FK_10028558D970B6A5 FOREIGN KEY (procede_id) REFERENCES procede (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_10028558D970B6A5 ON modele (procede_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE modele DROP FOREIGN KEY FK_10028558D970B6A5');
        $this->addSql('DROP INDEX UNIQ_10028558D970B6A5 ON modele');
        $this->addSql('ALTER TABLE modele DROP procede_id');
    }
}
