<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210924121049 extends AbstractMigration
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
        $this->addSql('ALTER TABLE categorie_fiche ADD CONSTRAINT FK_B96B21A8BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_fiche ADD CONSTRAINT FK_B96B21A8DF522508 FOREIGN KEY (fiche_id) REFERENCES fiche (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_fiche DROP FOREIGN KEY FK_B96B21A8BCF5E72D');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_fiche');
    }
}
