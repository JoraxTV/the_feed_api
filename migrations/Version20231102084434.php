<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231102084434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE publication ADD COLUMN auteur CLOB NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__publication AS SELECT id, message, date_publication FROM publication');
        $this->addSql('DROP TABLE publication');
        $this->addSql('CREATE TABLE publication (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, message CLOB NOT NULL, date_publication DATETIME NOT NULL)');
        $this->addSql('INSERT INTO publication (id, message, date_publication) SELECT id, message, date_publication FROM __temp__publication');
        $this->addSql('DROP TABLE __temp__publication');
    }
}
