<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190925041418 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tandem (id INT AUTO_INCREMENT NOT NULL, flight_id INT DEFAULT NULL, passenger_id INT NOT NULL, driver_id INT NOT NULL, operator_id INT DEFAULT NULL, INDEX IDX_3A8DD14291F478C5 (flight_id), INDEX IDX_3A8DD1424502E565 (passenger_id), INDEX IDX_3A8DD142C3423909 (driver_id), INDEX IDX_3A8DD142584598A3 (operator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tandem ADD CONSTRAINT FK_3A8DD14291F478C5 FOREIGN KEY (flight_id) REFERENCES flight (id)');
        $this->addSql('ALTER TABLE tandem ADD CONSTRAINT FK_3A8DD1424502E565 FOREIGN KEY (passenger_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE tandem ADD CONSTRAINT FK_3A8DD142C3423909 FOREIGN KEY (driver_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE tandem ADD CONSTRAINT FK_3A8DD142584598A3 FOREIGN KEY (operator_id) REFERENCES member (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tandem');
    }
}
