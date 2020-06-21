<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200615200140 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE method_link (id INT AUTO_INCREMENT NOT NULL, method_id INT NOT NULL, url VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_2A78E38719883967 (method_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE method_link ADD CONSTRAINT FK_2A78E38719883967 FOREIGN KEY (method_id) REFERENCES method (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, method_id INT DEFAULT NULL, name VARCHAR(155) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_64C19C119883967 (method_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE link (id INT AUTO_INCREMENT NOT NULL, url LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE link_method (link_id INT NOT NULL, method_id INT NOT NULL, INDEX IDX_3F9D7EEF19883967 (method_id), INDEX IDX_3F9D7EEFADA40271 (link_id), PRIMARY KEY(link_id, method_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C119883967 FOREIGN KEY (method_id) REFERENCES method (id)');
        $this->addSql('ALTER TABLE link_method ADD CONSTRAINT FK_3F9D7EEF19883967 FOREIGN KEY (method_id) REFERENCES method (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE link_method ADD CONSTRAINT FK_3F9D7EEFADA40271 FOREIGN KEY (link_id) REFERENCES link (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE method_link');
    }
}
