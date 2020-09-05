<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200905080328 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aime ADD m_global_id INT NOT NULL');
        $this->addSql('ALTER TABLE aime ADD CONSTRAINT FK_8533FE873FE76B6 FOREIGN KEY (m_global_id) REFERENCES mglobal (id)');
        $this->addSql('CREATE INDEX IDX_8533FE873FE76B6 ON aime (m_global_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aime DROP FOREIGN KEY FK_8533FE873FE76B6');
        $this->addSql('DROP INDEX IDX_8533FE873FE76B6 ON aime');
        $this->addSql('ALTER TABLE aime DROP m_global_id');
    }
}
