<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200905080118 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aime DROP FOREIGN KEY FK_8533FE880E261BC');
        $this->addSql('DROP INDEX IDX_8533FE880E261BC ON aime');
        $this->addSql('ALTER TABLE aime DROP message_id_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aime ADD message_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE aime ADD CONSTRAINT FK_8533FE880E261BC FOREIGN KEY (message_id_id) REFERENCES mglobal (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8533FE880E261BC ON aime (message_id_id)');
    }
}
