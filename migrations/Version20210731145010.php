<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210731145010 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, nom_e VARCHAR(255) NOT NULL, prenom_e VARCHAR(255) NOT NULL, date_naissance_e DATE NOT NULL, lieu_naissance_e VARCHAR(255) NOT NULL, sexe_e VARCHAR(255) NOT NULL,nationalite_e VARCHAR(255) NOT NULL, addresse_e VARCHAR(255) NOT NULL, phone_e VARCHAR(255) NOT NULL, email_e VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE etudiant');
    }
}
