<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210928162502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE CategorieparFiche (idcategorie INT NOT NULL, idfiche INT NOT NULL, INDEX IDX_ECC1CC2637667FC1 (idcategorie), INDEX IDX_ECC1CC269A16A061 (idfiche), PRIMARY KEY(idcategorie, idfiche)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE CategorieparFiche ADD CONSTRAINT FK_ECC1CC2637667FC1 FOREIGN KEY (idcategorie) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE CategorieparFiche ADD CONSTRAINT FK_ECC1CC269A16A061 FOREIGN KEY (idfiche) REFERENCES fiche (id)');
        $this->addSql('DROP TABLE categorie_fiche');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie_fiche (categorie_id INT NOT NULL, fiche_id INT NOT NULL, INDEX IDX_B96B21A8BCF5E72D (categorie_id), INDEX IDX_B96B21A8DF522508 (fiche_id), PRIMARY KEY(categorie_id, fiche_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE categorie_fiche ADD CONSTRAINT FK_B96B21A8BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_fiche ADD CONSTRAINT FK_B96B21A8DF522508 FOREIGN KEY (fiche_id) REFERENCES fiche (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE CategorieparFiche');
    }
}
