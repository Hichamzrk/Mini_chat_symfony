<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200905134233 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aime CHANGE user_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE aime ADD CONSTRAINT FK_8533FE89D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8533FE89D86650F ON aime (user_id_id)');
        $this->addSql('ALTER TABLE mglobal RENAME INDEX fk_2ecad87b9d86650f TO IDX_2ECAD87B9D86650F');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aime DROP FOREIGN KEY FK_8533FE89D86650F');
        $this->addSql('DROP INDEX IDX_8533FE89D86650F ON aime');
        $this->addSql('ALTER TABLE aime CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE mglobal RENAME INDEX idx_2ecad87b9d86650f TO FK_2ECAD87B9D86650F');
    }
}
