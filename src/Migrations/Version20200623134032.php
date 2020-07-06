<?php

declare(strict_types=1);

namespace App\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200623134032 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE action_deliverable ADD action_id INT NOT NULL');
        $this->addSql('ALTER TABLE action_deliverable ADD CONSTRAINT FK_DAAF2D859D32F035 FOREIGN KEY (action_id) REFERENCES action (id)');
        $this->addSql('CREATE INDEX IDX_DAAF2D859D32F035 ON action_deliverable (action_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE action_deliverable DROP FOREIGN KEY FK_DAAF2D859D32F035');
        $this->addSql('DROP INDEX IDX_DAAF2D859D32F035 ON action_deliverable');
        $this->addSql('ALTER TABLE action_deliverable DROP action_id');
    }
}
