<?php

declare(strict_types=1);

namespace App\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200706164549 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE method_user (method_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_9147AC3F19883967 (method_id), INDEX IDX_9147AC3FA76ED395 (user_id), PRIMARY KEY(method_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE method_user ADD CONSTRAINT FK_9147AC3F19883967 FOREIGN KEY (method_id) REFERENCES method (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE method_user ADD CONSTRAINT FK_9147AC3FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE method_user');
    }
}
