<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240527171121 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE calendar (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, terrain_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, description LONGTEXT NOT NULL, all_day TINYINT(1) NOT NULL, INDEX IDX_6EA9A146A76ED395 (user_id), INDEX IDX_6EA9A1468A2D8B41 (terrain_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, subject VARCHAR(100) DEFAULT NULL, message LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE match_basket (id INT AUTO_INCREMENT NOT NULL, genre_match VARCHAR(255) NOT NULL, nombres_joueur INT NOT NULL, date_match DATE NOT NULL, duree_match INT NOT NULL, points_match INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservations (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, id_calendar_id INT DEFAULT NULL, INDEX IDX_4DA23979F37AE5 (id_user_id), INDEX IDX_4DA23912526F3F (id_calendar_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservations_terrain (reservations_id INT NOT NULL, terrain_id INT NOT NULL, INDEX IDX_454E216FD9A7F869 (reservations_id), INDEX IDX_454E216F8A2D8B41 (terrain_id), PRIMARY KEY(reservations_id, terrain_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, id_user VARCHAR(10) NOT NULL, nom_team VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE terrain (id INT AUTO_INCREMENT NOT NULL, nom_tdb VARCHAR(255) NOT NULL, adresse_tdb VARCHAR(255) NOT NULL, long_tdb NUMERIC(10, 0) NOT NULL, latt_tdb NUMERIC(10, 0) NOT NULL, libelle_ville VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, date_de_naissance DATE DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, tel VARCHAR(14) DEFAULT NULL, ban TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_terrain (user_id INT NOT NULL, terrain_id INT NOT NULL, INDEX IDX_907B4DBBA76ED395 (user_id), INDEX IDX_907B4DBB8A2D8B41 (terrain_id), PRIMARY KEY(user_id, terrain_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_match_basket (user_id INT NOT NULL, match_basket_id INT NOT NULL, INDEX IDX_3E5D578A76ED395 (user_id), INDEX IDX_3E5D578250B7F9 (match_basket_id), PRIMARY KEY(user_id, match_basket_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_team (user_id INT NOT NULL, team_id INT NOT NULL, INDEX IDX_BE61EAD6A76ED395 (user_id), INDEX IDX_BE61EAD6296CD8AE (team_id), PRIMARY KEY(user_id, team_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A146A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A1468A2D8B41 FOREIGN KEY (terrain_id) REFERENCES terrain (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA23979F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA23912526F3F FOREIGN KEY (id_calendar_id) REFERENCES calendar (id)');
        $this->addSql('ALTER TABLE reservations_terrain ADD CONSTRAINT FK_454E216FD9A7F869 FOREIGN KEY (reservations_id) REFERENCES reservations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservations_terrain ADD CONSTRAINT FK_454E216F8A2D8B41 FOREIGN KEY (terrain_id) REFERENCES terrain (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_terrain ADD CONSTRAINT FK_907B4DBBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_terrain ADD CONSTRAINT FK_907B4DBB8A2D8B41 FOREIGN KEY (terrain_id) REFERENCES terrain (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_match_basket ADD CONSTRAINT FK_3E5D578A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_match_basket ADD CONSTRAINT FK_3E5D578250B7F9 FOREIGN KEY (match_basket_id) REFERENCES match_basket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_team ADD CONSTRAINT FK_BE61EAD6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_team ADD CONSTRAINT FK_BE61EAD6296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A146A76ED395');
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A1468A2D8B41');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA23979F37AE5');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA23912526F3F');
        $this->addSql('ALTER TABLE reservations_terrain DROP FOREIGN KEY FK_454E216FD9A7F869');
        $this->addSql('ALTER TABLE reservations_terrain DROP FOREIGN KEY FK_454E216F8A2D8B41');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE user_terrain DROP FOREIGN KEY FK_907B4DBBA76ED395');
        $this->addSql('ALTER TABLE user_terrain DROP FOREIGN KEY FK_907B4DBB8A2D8B41');
        $this->addSql('ALTER TABLE user_match_basket DROP FOREIGN KEY FK_3E5D578A76ED395');
        $this->addSql('ALTER TABLE user_match_basket DROP FOREIGN KEY FK_3E5D578250B7F9');
        $this->addSql('ALTER TABLE user_team DROP FOREIGN KEY FK_BE61EAD6A76ED395');
        $this->addSql('ALTER TABLE user_team DROP FOREIGN KEY FK_BE61EAD6296CD8AE');
        $this->addSql('DROP TABLE calendar');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE match_basket');
        $this->addSql('DROP TABLE reservations');
        $this->addSql('DROP TABLE reservations_terrain');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE terrain');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_terrain');
        $this->addSql('DROP TABLE user_match_basket');
        $this->addSql('DROP TABLE user_team');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
