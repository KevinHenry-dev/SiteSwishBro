<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240527201350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservations_terrain (reservations_id INT NOT NULL, terrain_id INT NOT NULL, INDEX IDX_454E216FD9A7F869 (reservations_id), INDEX IDX_454E216F8A2D8B41 (terrain_id), PRIMARY KEY(reservations_id, terrain_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservations_terrain ADD CONSTRAINT FK_454E216FD9A7F869 FOREIGN KEY (reservations_id) REFERENCES reservations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservations_terrain ADD CONSTRAINT FK_454E216F8A2D8B41 FOREIGN KEY (terrain_id) REFERENCES terrain (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA2398A2D8B41');
        $this->addSql('DROP INDEX IDX_4DA2398A2D8B41 ON reservations');
        $this->addSql('ALTER TABLE reservations DROP terrain_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservations_terrain DROP FOREIGN KEY FK_454E216FD9A7F869');
        $this->addSql('ALTER TABLE reservations_terrain DROP FOREIGN KEY FK_454E216F8A2D8B41');
        $this->addSql('DROP TABLE reservations_terrain');
        $this->addSql('ALTER TABLE reservations ADD terrain_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA2398A2D8B41 FOREIGN KEY (terrain_id) REFERENCES terrain (id)');
        $this->addSql('CREATE INDEX IDX_4DA2398A2D8B41 ON reservations (terrain_id)');
    }
}
