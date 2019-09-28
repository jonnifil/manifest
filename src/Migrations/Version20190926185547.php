<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190926185547 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE aff (id INT AUTO_INCREMENT NOT NULL, flight_id INT DEFAULT NULL, aff_client_id INT NOT NULL, aff_first_id INT NOT NULL, aff_second_id INT DEFAULT NULL, aff_operator_id INT DEFAULT NULL, level SMALLINT NOT NULL, INDEX IDX_2122704991F478C5 (flight_id), INDEX IDX_2122704914E27080 (aff_client_id), INDEX IDX_212270498C3EFDD5 (aff_first_id), INDEX IDX_21227049F29F026D (aff_second_id), INDEX IDX_212270498B32B0C2 (aff_operator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coach (id INT AUTO_INCREMENT NOT NULL, flight_id INT DEFAULT NULL, coach_client_id INT NOT NULL, coach_driver_id INT NOT NULL, coach_operator_id INT DEFAULT NULL, type SMALLINT NOT NULL, INDEX IDX_3F596DCC91F478C5 (flight_id), INDEX IDX_3F596DCC8F9A7DB6 (coach_client_id), INDEX IDX_3F596DCC55332D9E (coach_driver_id), INDEX IDX_3F596DCC7C9FC672 (coach_operator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE singleton (id INT AUTO_INCREMENT NOT NULL, flight_id INT NOT NULL, member_id INT NOT NULL, type SMALLINT NOT NULL, INDEX IDX_65563EB291F478C5 (flight_id), INDEX IDX_65563EB27597D3FE (member_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aff ADD CONSTRAINT FK_2122704991F478C5 FOREIGN KEY (flight_id) REFERENCES flight (id)');
        $this->addSql('ALTER TABLE aff ADD CONSTRAINT FK_2122704914E27080 FOREIGN KEY (aff_client_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE aff ADD CONSTRAINT FK_212270498C3EFDD5 FOREIGN KEY (aff_first_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE aff ADD CONSTRAINT FK_21227049F29F026D FOREIGN KEY (aff_second_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE aff ADD CONSTRAINT FK_212270498B32B0C2 FOREIGN KEY (aff_operator_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE coach ADD CONSTRAINT FK_3F596DCC91F478C5 FOREIGN KEY (flight_id) REFERENCES flight (id)');
        $this->addSql('ALTER TABLE coach ADD CONSTRAINT FK_3F596DCC8F9A7DB6 FOREIGN KEY (coach_client_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE coach ADD CONSTRAINT FK_3F596DCC55332D9E FOREIGN KEY (coach_driver_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE coach ADD CONSTRAINT FK_3F596DCC7C9FC672 FOREIGN KEY (coach_operator_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE singleton ADD CONSTRAINT FK_65563EB291F478C5 FOREIGN KEY (flight_id) REFERENCES flight (id)');
        $this->addSql('ALTER TABLE singleton ADD CONSTRAINT FK_65563EB27597D3FE FOREIGN KEY (member_id) REFERENCES member (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE aff');
        $this->addSql('DROP TABLE coach');
        $this->addSql('DROP TABLE singleton');
    }
}
