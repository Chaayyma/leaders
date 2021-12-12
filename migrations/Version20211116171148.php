<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211116171148 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evaluation (id INT AUTO_INCREMENT NOT NULL, note DOUBLE PRECISION NOT NULL, diplome VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formateur ADD classes_id INT NOT NULL');
        $this->addSql('ALTER TABLE formateur ADD CONSTRAINT FK_ED767E4F9E225B24 FOREIGN KEY (classes_id) REFERENCES classe (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ED767E4F9E225B24 ON formateur (classes_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE evaluation');
        $this->addSql('ALTER TABLE formateur DROP FOREIGN KEY FK_ED767E4F9E225B24');
        $this->addSql('DROP INDEX UNIQ_ED767E4F9E225B24 ON formateur');
        $this->addSql('ALTER TABLE formateur DROP classes_id');
    }
}
