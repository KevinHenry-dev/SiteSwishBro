<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240514144114 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservations_terrain (reservations_id INT NOT NULL, terrain_id INT NOT NULL, INDEX IDX_454E216FD9A7F869 (reservations_id), INDEX IDX_454E216F8A2D8B41 (terrain_id), PRIMARY KEY(reservations_id, terrain_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_terrain (user_id INT NOT NULL, terrain_id INT NOT NULL, INDEX IDX_907B4DBBA76ED395 (user_id), INDEX IDX_907B4DBB8A2D8B41 (terrain_id), PRIMARY KEY(user_id, terrain_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_match_basket (user_id INT NOT NULL, match_basket_id INT NOT NULL, INDEX IDX_3E5D578A76ED395 (user_id), INDEX IDX_3E5D578250B7F9 (match_basket_id), PRIMARY KEY(user_id, match_basket_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_team (user_id INT NOT NULL, team_id INT NOT NULL, INDEX IDX_BE61EAD6A76ED395 (user_id), INDEX IDX_BE61EAD6296CD8AE (team_id), PRIMARY KEY(user_id, team_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservations_terrain ADD CONSTRAINT FK_454E216FD9A7F869 FOREIGN KEY (reservations_id) REFERENCES reservations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservations_terrain ADD CONSTRAINT FK_454E216F8A2D8B41 FOREIGN KEY (terrain_id) REFERENCES terrain (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_terrain ADD CONSTRAINT FK_907B4DBBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_terrain ADD CONSTRAINT FK_907B4DBB8A2D8B41 FOREIGN KEY (terrain_id) REFERENCES terrain (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_match_basket ADD CONSTRAINT FK_3E5D578A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_match_basket ADD CONSTRAINT FK_3E5D578250B7F9 FOREIGN KEY (match_basket_id) REFERENCES match_basket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_team ADD CONSTRAINT FK_BE61EAD6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_team ADD CONSTRAINT FK_BE61EAD6296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE calendar ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A146A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6EA9A146A76ED395 ON calendar (user_id)');
        $this->addSql('ALTER TABLE reservations ADD calendar_id INT DEFAULT NULL, ADD match_basket_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL, DROP id_terrain, DROP id_match, DROP id_user, DROP id_team');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239A40A2C8 FOREIGN KEY (calendar_id) REFERENCES calendar (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239250B7F9 FOREIGN KEY (match_basket_id) REFERENCES match_basket (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4DA239A40A2C8 ON reservations (calendar_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4DA239250B7F9 ON reservations (match_basket_id)');
        $this->addSql('CREATE INDEX IDX_4DA239A76ED395 ON reservations (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservations_terrain DROP FOREIGN KEY FK_454E216FD9A7F869');
        $this->addSql('ALTER TABLE reservations_terrain DROP FOREIGN KEY FK_454E216F8A2D8B41');
        $this->addSql('ALTER TABLE user_terrain DROP FOREIGN KEY FK_907B4DBBA76ED395');
        $this->addSql('ALTER TABLE user_terrain DROP FOREIGN KEY FK_907B4DBB8A2D8B41');
        $this->addSql('ALTER TABLE user_match_basket DROP FOREIGN KEY FK_3E5D578A76ED395');
        $this->addSql('ALTER TABLE user_match_basket DROP FOREIGN KEY FK_3E5D578250B7F9');
        $this->addSql('ALTER TABLE user_team DROP FOREIGN KEY FK_BE61EAD6A76ED395');
        $this->addSql('ALTER TABLE user_team DROP FOREIGN KEY FK_BE61EAD6296CD8AE');
        $this->addSql('DROP TABLE reservations_terrain');
        $this->addSql('DROP TABLE user_terrain');
        $this->addSql('DROP TABLE user_match_basket');
        $this->addSql('DROP TABLE user_team');
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A146A76ED395');
        $this->addSql('DROP INDEX IDX_6EA9A146A76ED395 ON calendar');
        $this->addSql('ALTER TABLE calendar DROP user_id');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239A40A2C8');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239250B7F9');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239A76ED395');
        $this->addSql('DROP INDEX UNIQ_4DA239A40A2C8 ON reservations');
        $this->addSql('DROP INDEX UNIQ_4DA239250B7F9 ON reservations');
        $this->addSql('DROP INDEX IDX_4DA239A76ED395 ON reservations');
        $this->addSql('ALTER TABLE reservations ADD id_terrain VARCHAR(255) NOT NULL, ADD id_match VARCHAR(255) NOT NULL, ADD id_user VARCHAR(255) NOT NULL, ADD id_team VARCHAR(255) NOT NULL, DROP calendar_id, DROP match_basket_id, DROP user_id');
    }
}
