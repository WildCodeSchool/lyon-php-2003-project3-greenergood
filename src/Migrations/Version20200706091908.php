<?php

declare(strict_types=1);

namespace App\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200706091908 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE method ADD author_id INT DEFAULT NULL, ADD picture VARCHAR(255) DEFAULT NULL, ADD objective2 VARCHAR(255) DEFAULT NULL, ADD objective3 VARCHAR(255) DEFAULT NULL, CHANGE objectives objective1 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE method ADD CONSTRAINT FK_5E593A60F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5E593A60F675F31B ON method (author_id)');
        $this->addSql('ALTER TABLE reset_password_request CHANGE requested_at requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE expires_at expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE method DROP FOREIGN KEY FK_5E593A60F675F31B');
        $this->addSql('DROP INDEX IDX_5E593A60F675F31B ON method');
        $this->addSql('ALTER TABLE method ADD objectives VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP author_id, DROP objective1, DROP picture, DROP objective2, DROP objective3');
        $this->addSql('ALTER TABLE reset_password_request CHANGE requested_at requested_at DATETIME NOT NULL, CHANGE expires_at expires_at DATETIME NOT NULL');
    }
}
