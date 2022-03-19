<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210731170134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE parain (id INT AUTO_INCREMENT NOT NULL, nom_p VARCHAR(255) NOT NULL, profession_p VARCHAR(255) NOT NULL, contact_p VARCHAR(255) NOT NULL, nom_m VARCHAR(255) NOT NULL, profession_m VARCHAR(255) NOT NULL, contact_m VARCHAR(255) NOT NULL, addresse_pa VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etudiant ADD parain_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3646FE38D FOREIGN KEY (parain_id) REFERENCES parain (id)');
        $this->addSql('CREATE INDEX IDX_717E22E3646FE38D ON etudiant (parain_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3646FE38D');
        $this->addSql('DROP TABLE parain');
        $this->addSql('DROP INDEX IDX_717E22E3646FE38D ON etudiant');
        $this->addSql('ALTER TABLE etudiant DROP parain_id');
    }
}
