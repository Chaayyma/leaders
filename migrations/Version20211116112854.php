<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211116112854 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formation_session (formation_id INT NOT NULL, session_id INT NOT NULL, INDEX IDX_95BB90AF5200282E (formation_id), INDEX IDX_95BB90AF613FECDF (session_id), PRIMARY KEY(formation_id, session_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('ALTER TABLE formation_session ADD CONSTRAINT FK_95BB90AF5200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_session ADD CONSTRAINT FK_95BB90AF613FECDF FOREIGN KEY (session_id) REFERENCES session (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation ADD administrateurs_id INT NOT NULL');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BFC86024E2 FOREIGN KEY (administrateurs_id) REFERENCES administrateur (id)');
        $this->addSql('CREATE INDEX IDX_404021BFC86024E2 ON formation (administrateurs_id)');
        $this->addSql('ALTER TABLE inscription_formation ADD formation_id INT NOT NULL, ADD candidat_id INT NOT NULL');
        $this->addSql('ALTER TABLE inscription_formation ADD CONSTRAINT FK_E655E3A75200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE inscription_formation ADD CONSTRAINT FK_E655E3A78D0EB82 FOREIGN KEY (candidat_id) REFERENCES condidat (id)');
        $this->addSql('CREATE INDEX IDX_E655E3A75200282E ON inscription_formation (formation_id)');
        $this->addSql('CREATE INDEX IDX_E655E3A78D0EB82 ON inscription_formation (candidat_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

        $this->addSql('DROP TABLE formation_session');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BFC86024E2');
        $this->addSql('DROP INDEX IDX_404021BFC86024E2 ON formation');
        $this->addSql('ALTER TABLE formation DROP administrateurs_id');
        $this->addSql('ALTER TABLE inscription_formation DROP FOREIGN KEY FK_E655E3A75200282E');
        $this->addSql('ALTER TABLE inscription_formation DROP FOREIGN KEY FK_E655E3A78D0EB82');
        $this->addSql('DROP INDEX IDX_E655E3A75200282E ON inscription_formation');
        $this->addSql('DROP INDEX IDX_E655E3A78D0EB82 ON inscription_formation');
        $this->addSql('ALTER TABLE inscription_formation DROP formation_id, DROP candidat_id');
    }
}
