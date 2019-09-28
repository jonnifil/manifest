<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190927061720 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE work_day_members (work_day_id INT NOT NULL, member_id INT NOT NULL, INDEX IDX_A2A442BEA23B8704 (work_day_id), INDEX IDX_A2A442BE7597D3FE (member_id), PRIMARY KEY(work_day_id, member_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE work_day_members ADD CONSTRAINT FK_A2A442BEA23B8704 FOREIGN KEY (work_day_id) REFERENCES work_day (id)');
        $this->addSql('ALTER TABLE work_day_members ADD CONSTRAINT FK_A2A442BE7597D3FE FOREIGN KEY (member_id) REFERENCES member (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE work_day_members');
    }
}
