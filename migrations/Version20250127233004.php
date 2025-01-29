<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250127233004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE realisation_inspiration (realisation_id INT NOT NULL, inspiration_id INT NOT NULL, INDEX IDX_3B53A6B8B685E551 (realisation_id), INDEX IDX_3B53A6B82B726C5F (inspiration_id), PRIMARY KEY(realisation_id, inspiration_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE realisation_inspiration ADD CONSTRAINT FK_3B53A6B8B685E551 FOREIGN KEY (realisation_id) REFERENCES realisation (id)');
        $this->addSql('ALTER TABLE realisation_inspiration ADD CONSTRAINT FK_3B53A6B82B726C5F FOREIGN KEY (inspiration_id) REFERENCES inspiration (id)');
        $this->addSql('DROP TABLE contact');
        $this->addSql('ALTER TABLE formule CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE inspiration CHANGE created_at created_at DATETIME NOT NULL, CHANGE description content LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE realisation ADD formule_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE realisation ADD CONSTRAINT FK_EAA5610E2A68F4D1 FOREIGN KEY (formule_id) REFERENCES formule (id)');
        $this->addSql('CREATE INDEX IDX_EAA5610E2A68F4D1 ON realisation (formule_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, phone VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, pieces INT NOT NULL, m2 INT NOT NULL, habitation VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, foyer VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, styles LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', message LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE realisation_inspiration DROP FOREIGN KEY FK_3B53A6B8B685E551');
        $this->addSql('ALTER TABLE realisation_inspiration DROP FOREIGN KEY FK_3B53A6B82B726C5F');
        $this->addSql('DROP TABLE realisation_inspiration');
        $this->addSql('ALTER TABLE formule CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE inspiration CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE content description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE realisation DROP FOREIGN KEY FK_EAA5610E2A68F4D1');
        $this->addSql('DROP INDEX IDX_EAA5610E2A68F4D1 ON realisation');
        $this->addSql('ALTER TABLE realisation DROP formule_id');
    }
}
