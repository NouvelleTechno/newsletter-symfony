<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210522121542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories_users (categories_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_1080B0A4A21214B7 (categories_id), INDEX IDX_1080B0A467B3B43D (users_id), PRIMARY KEY(categories_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE newsletters (id INT AUTO_INCREMENT NOT NULL, categories_id INT NOT NULL, name VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, is_sent TINYINT(1) NOT NULL, INDEX IDX_8ECF000CA21214B7 (categories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, is_rgpd TINYINT(1) NOT NULL, validation_token VARCHAR(255) DEFAULT NULL, is_valid TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categories_users ADD CONSTRAINT FK_1080B0A4A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categories_users ADD CONSTRAINT FK_1080B0A467B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE newsletters ADD CONSTRAINT FK_8ECF000CA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories_users DROP FOREIGN KEY FK_1080B0A4A21214B7');
        $this->addSql('ALTER TABLE newsletters DROP FOREIGN KEY FK_8ECF000CA21214B7');
        $this->addSql('ALTER TABLE categories_users DROP FOREIGN KEY FK_1080B0A467B3B43D');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE categories_users');
        $this->addSql('DROP TABLE newsletters');
        $this->addSql('DROP TABLE users');
    }
}
