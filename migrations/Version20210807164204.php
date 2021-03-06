<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210807164204 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant ADD scolaire_id INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E326D97093 FOREIGN KEY (scolaire_id) REFERENCES scolaire (id)');
        $this->addSql('CREATE INDEX IDX_717E22E326D97093 ON etudiant (scolaire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E326D97093');
        $this->addSql('DROP INDEX IDX_717E22E326D97093 ON etudiant');
        $this->addSql('ALTER TABLE etudiant DROP scolaire_id, CHANGE updated_at updated_at DATETIME NOT NULL');
    }
}
