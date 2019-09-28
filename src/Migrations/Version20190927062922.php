<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190927062922 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE big_way_members (big_way_id INT NOT NULL, member_id INT NOT NULL, INDEX IDX_C3792FDCF4A92B88 (big_way_id), INDEX IDX_C3792FDC7597D3FE (member_id), PRIMARY KEY(big_way_id, member_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE big_way_members ADD CONSTRAINT FK_C3792FDCF4A92B88 FOREIGN KEY (big_way_id) REFERENCES big_way (id)');
        $this->addSql('ALTER TABLE big_way_members ADD CONSTRAINT FK_C3792FDC7597D3FE FOREIGN KEY (member_id) REFERENCES member (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE big_way_members');
    }
}
