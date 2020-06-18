<?php

declare(strict_types=1);

namespace App\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200617144104 extends AbstractMigration
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
        $this->addSql('ALTER TABLE action ADD activated TINYINT(1) NOT NULL, DROP number, CHANGE edition_number edition_number INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE method_link');
        $this->addSql('ALTER TABLE action ADD number INT DEFAULT NULL, DROP activated, CHANGE edition_number edition_number INT NOT NULL');
    }
}
