<?php

declare(strict_types=1);

namespace App\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200706125651 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_user (contact_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_A56C54B6E7A1254A (contact_id), INDEX IDX_A56C54B6A76ED395 (user_id), PRIMARY KEY(contact_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_method (contact_id INT NOT NULL, method_id INT NOT NULL, INDEX IDX_CECB0DE1E7A1254A (contact_id), INDEX IDX_CECB0DE119883967 (method_id), PRIMARY KEY(contact_id, method_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact_user ADD CONSTRAINT FK_A56C54B6E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact_user ADD CONSTRAINT FK_A56C54B6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact_method ADD CONSTRAINT FK_CECB0DE1E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact_method ADD CONSTRAINT FK_CECB0DE119883967 FOREIGN KEY (method_id) REFERENCES method (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_user DROP FOREIGN KEY FK_A56C54B6E7A1254A');
        $this->addSql('ALTER TABLE contact_method DROP FOREIGN KEY FK_CECB0DE1E7A1254A');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE contact_user');
        $this->addSql('DROP TABLE contact_method');
    }
}
