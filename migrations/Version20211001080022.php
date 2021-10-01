<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211001080022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C715CA2B0');
        $this->addSql('DROP TABLE commentaire_categorie');
        $this->addSql('DROP TABLE contenue');
        $this->addSql('DROP INDEX IDX_6A2CA10C715CA2B0 ON media');
        $this->addSql('ALTER TABLE media CHANGE contenue_id contenu_id INT NOT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C3C1CC488 FOREIGN KEY (contenu_id) REFERENCES contenu (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10C3C1CC488 ON media (contenu_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire_categorie (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE contenue (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C3C1CC488');
        $this->addSql('DROP INDEX IDX_6A2CA10C3C1CC488 ON media');
        $this->addSql('ALTER TABLE media CHANGE contenu_id contenue_id INT NOT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C715CA2B0 FOREIGN KEY (contenue_id) REFERENCES contenue (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10C715CA2B0 ON media (contenue_id)');
    }
}
