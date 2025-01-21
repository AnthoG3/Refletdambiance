<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250121115735 extends AbstractMigration
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
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE realisation_inspiration DROP FOREIGN KEY FK_3B53A6B8B685E551');
        $this->addSql('ALTER TABLE realisation_inspiration DROP FOREIGN KEY FK_3B53A6B82B726C5F');
        $this->addSql('DROP TABLE realisation_inspiration');
    }
}
