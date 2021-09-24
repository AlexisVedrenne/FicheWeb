<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210924124918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_fiche (categorie_id INT NOT NULL, fiche_id INT NOT NULL, INDEX IDX_B96B21A8BCF5E72D (categorie_id), INDEX IDX_B96B21A8DF522508 (fiche_id), PRIMARY KEY(categorie_id, fiche_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, la_fiche_id INT DEFAULT NULL, user_id INT DEFAULT NULL, texte VARCHAR(255) NOT NULL, note NUMERIC(4, 1) DEFAULT NULL, INDEX IDX_67F068BC18F7AE9B (la_fiche_id), INDEX IDX_67F068BCA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, nom VARCHAR(30) NOT NULL, date_creation DATETIME NOT NULL, note NUMERIC(4, 1) DEFAULT NULL, INDEX IDX_4C13CC78A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(20) NOT NULL, statut_connexion TINYINT(1) NOT NULL, date_inscription DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_fiche ADD CONSTRAINT FK_B96B21A8BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_fiche ADD CONSTRAINT FK_B96B21A8DF522508 FOREIGN KEY (fiche_id) REFERENCES fiche (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC18F7AE9B FOREIGN KEY (la_fiche_id) REFERENCES fiche (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC78A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_fiche DROP FOREIGN KEY FK_B96B21A8BCF5E72D');
        $this->addSql('ALTER TABLE categorie_fiche DROP FOREIGN KEY FK_B96B21A8DF522508');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC18F7AE9B');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCA76ED395');
        $this->addSql('ALTER TABLE fiche DROP FOREIGN KEY FK_4C13CC78A76ED395');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_fiche');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE fiche');
        $this->addSql('DROP TABLE user');
    }
}
