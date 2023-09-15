<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230915130957 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE library ADD CONSTRAINT FK_A18098BCE3D4686C FOREIGN KEY (fkusers_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A18098BCE3D4686C ON library (fkusers_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE library DROP FOREIGN KEY FK_A18098BCE3D4686C');
        $this->addSql('DROP INDEX IDX_A18098BCE3D4686C ON library');
    }
}
