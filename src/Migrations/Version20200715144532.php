<?php

declare(strict_types=1);

namespace App\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200715144532 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE method DROP FOREIGN KEY FK_5E593A6012469DE2');
        $this->addSql('ALTER TABLE method ADD CONSTRAINT FK_5E593A6012469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE method DROP FOREIGN KEY FK_5E593A6012469DE2');
        $this->addSql('ALTER TABLE method ADD CONSTRAINT FK_5E593A6012469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
