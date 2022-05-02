<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220502204911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admins (id INT AUTO_INCREMENT NOT NULL, possesseur_id INT NOT NULL, poste VARCHAR(255) NOT NULL, date_debut_fonction DATETIME NOT NULL, competences VARCHAR(255) NOT NULL, cv VARCHAR(255) DEFAULT NULL, parcours LONGTEXT DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, INDEX IDX_A2E0150F4D6EDE5B (possesseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiants (id INT AUTO_INCREMENT NOT NULL, possesseur_id INT NOT NULL, filiere VARCHAR(255) NOT NULL, niveau VARCHAR(255) NOT NULL, diplome VARCHAR(255) DEFAULT NULL, dernier_etablissement VARCHAR(255) DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, INDEX IDX_227C02EB4D6EDE5B (possesseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matieres (id INT AUTO_INCREMENT NOT NULL, admin_id INT NOT NULL, titre VARCHAR(255) NOT NULL, specialite VARCHAR(255) NOT NULL, niveau VARCHAR(255) NOT NULL, statut VARCHAR(255) DEFAULT NULL, INDEX IDX_8D9773D2642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE requetes (id INT AUTO_INCREMENT NOT NULL, etudiant_id INT NOT NULL, admin_id INT DEFAULT NULL, matiere_id INT NOT NULL, recu VARCHAR(255) NOT NULL, quitus VARCHAR(255) NOT NULL, objet VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, etat VARCHAR(255) DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, date_depot DATETIME NOT NULL, date_traite DATETIME NOT NULL, INDEX IDX_2D13E3C4DDEAB1A3 (etudiant_id), INDEX IDX_2D13E3C4642B8210 (admin_id), INDEX IDX_2D13E3C4F46CD258 (matiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE revendications (id INT AUTO_INCREMENT NOT NULL, etudiant_id INT NOT NULL, requete_id INT NOT NULL, objet VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, etat VARCHAR(255) DEFAULT NULL, statut VARCHAR(255) NOT NULL, INDEX IDX_60E4B844DDEAB1A3 (etudiant_id), INDEX IDX_60E4B84418FB544F (requete_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, date_naissance DATETIME NOT NULL, adresse VARCHAR(255) NOT NULL, matricule VARCHAR(255) NOT NULL, date_compte DATETIME NOT NULL, statut VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admins ADD CONSTRAINT FK_A2E0150F4D6EDE5B FOREIGN KEY (possesseur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE etudiants ADD CONSTRAINT FK_227C02EB4D6EDE5B FOREIGN KEY (possesseur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE matieres ADD CONSTRAINT FK_8D9773D2642B8210 FOREIGN KEY (admin_id) REFERENCES admins (id)');
        $this->addSql('ALTER TABLE requetes ADD CONSTRAINT FK_2D13E3C4DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiants (id)');
        $this->addSql('ALTER TABLE requetes ADD CONSTRAINT FK_2D13E3C4642B8210 FOREIGN KEY (admin_id) REFERENCES admins (id)');
        $this->addSql('ALTER TABLE requetes ADD CONSTRAINT FK_2D13E3C4F46CD258 FOREIGN KEY (matiere_id) REFERENCES matieres (id)');
        $this->addSql('ALTER TABLE revendications ADD CONSTRAINT FK_60E4B844DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiants (id)');
        $this->addSql('ALTER TABLE revendications ADD CONSTRAINT FK_60E4B84418FB544F FOREIGN KEY (requete_id) REFERENCES requetes (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matieres DROP FOREIGN KEY FK_8D9773D2642B8210');
        $this->addSql('ALTER TABLE requetes DROP FOREIGN KEY FK_2D13E3C4642B8210');
        $this->addSql('ALTER TABLE requetes DROP FOREIGN KEY FK_2D13E3C4DDEAB1A3');
        $this->addSql('ALTER TABLE revendications DROP FOREIGN KEY FK_60E4B844DDEAB1A3');
        $this->addSql('ALTER TABLE requetes DROP FOREIGN KEY FK_2D13E3C4F46CD258');
        $this->addSql('ALTER TABLE revendications DROP FOREIGN KEY FK_60E4B84418FB544F');
        $this->addSql('ALTER TABLE admins DROP FOREIGN KEY FK_A2E0150F4D6EDE5B');
        $this->addSql('ALTER TABLE etudiants DROP FOREIGN KEY FK_227C02EB4D6EDE5B');
        $this->addSql('DROP TABLE admins');
        $this->addSql('DROP TABLE etudiants');
        $this->addSql('DROP TABLE matieres');
        $this->addSql('DROP TABLE requetes');
        $this->addSql('DROP TABLE revendications');
        $this->addSql('DROP TABLE `user`');
    }
}
