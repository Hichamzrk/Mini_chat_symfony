<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200904141601 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mglobal CHANGE user_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE mglobal ADD CONSTRAINT FK_2ECAD87B9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_2ECAD87B9D86650F ON mglobal (user_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mglobal DROP FOREIGN KEY FK_2ECAD87B9D86650F');
        $this->addSql('DROP INDEX IDX_2ECAD87B9D86650F ON mglobal');
        $this->addSql('ALTER TABLE mglobal CHANGE user_id_id user_id INT NOT NULL');
    }
}
