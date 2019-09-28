<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190928042220 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aff ADD work_day_id INT NOT NULL');
        $this->addSql('ALTER TABLE aff ADD CONSTRAINT FK_21227049A23B8704 FOREIGN KEY (work_day_id) REFERENCES work_day (id)');
        $this->addSql('CREATE INDEX IDX_21227049A23B8704 ON aff (work_day_id)');
        $this->addSql('ALTER TABLE coach ADD work_day_id INT NOT NULL');
        $this->addSql('ALTER TABLE coach ADD CONSTRAINT FK_3F596DCCA23B8704 FOREIGN KEY (work_day_id) REFERENCES work_day (id)');
        $this->addSql('CREATE INDEX IDX_3F596DCCA23B8704 ON coach (work_day_id)');
        $this->addSql('ALTER TABLE big_way ADD work_day_id INT NOT NULL');
        $this->addSql('ALTER TABLE big_way ADD CONSTRAINT FK_12438522A23B8704 FOREIGN KEY (work_day_id) REFERENCES work_day (id)');
        $this->addSql('CREATE INDEX IDX_12438522A23B8704 ON big_way (work_day_id)');
        $this->addSql('ALTER TABLE tandem ADD work_day_id INT NOT NULL');
        $this->addSql('ALTER TABLE tandem ADD CONSTRAINT FK_3A8DD142A23B8704 FOREIGN KEY (work_day_id) REFERENCES work_day (id)');
        $this->addSql('CREATE INDEX IDX_3A8DD142A23B8704 ON tandem (work_day_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aff DROP FOREIGN KEY FK_21227049A23B8704');
        $this->addSql('DROP INDEX IDX_21227049A23B8704 ON aff');
        $this->addSql('ALTER TABLE aff DROP work_day_id');
        $this->addSql('ALTER TABLE big_way DROP FOREIGN KEY FK_12438522A23B8704');
        $this->addSql('DROP INDEX IDX_12438522A23B8704 ON big_way');
        $this->addSql('ALTER TABLE big_way DROP work_day_id');
        $this->addSql('ALTER TABLE coach DROP FOREIGN KEY FK_3F596DCCA23B8704');
        $this->addSql('DROP INDEX IDX_3F596DCCA23B8704 ON coach');
        $this->addSql('ALTER TABLE coach DROP work_day_id');
        $this->addSql('ALTER TABLE tandem DROP FOREIGN KEY FK_3A8DD142A23B8704');
        $this->addSql('DROP INDEX IDX_3A8DD142A23B8704 ON tandem');
        $this->addSql('ALTER TABLE tandem DROP work_day_id');
    }
}
