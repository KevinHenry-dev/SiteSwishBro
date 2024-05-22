<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240522200829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservations ADD id_user_id INT DEFAULT NULL, ADD id_calendar_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA23979F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA23912526F3F FOREIGN KEY (id_calendar_id) REFERENCES calendar (id)');
        $this->addSql('CREATE INDEX IDX_4DA23979F37AE5 ON reservations (id_user_id)');
        $this->addSql('CREATE INDEX IDX_4DA23912526F3F ON reservations (id_calendar_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA23979F37AE5');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA23912526F3F');
        $this->addSql('DROP INDEX IDX_4DA23979F37AE5 ON reservations');
        $this->addSql('DROP INDEX IDX_4DA23912526F3F ON reservations');
        $this->addSql('ALTER TABLE reservations DROP id_user_id, DROP id_calendar_id');
    }
}
