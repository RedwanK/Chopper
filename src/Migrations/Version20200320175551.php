<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200320175551 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, short_description VARCHAR(100) DEFAULT NULL, long_description LONGTEXT DEFAULT NULL, main_image VARCHAR(255) NOT NULL, second_image VARCHAR(255) DEFAULT NULL, third_image VARCHAR(255) DEFAULT NULL, github_link VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, authors LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', duration DATE DEFAULT NULL, client VARCHAR(255) DEFAULT NULL, technologies LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', platform VARCHAR(255) DEFAULT NULL, prefered TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activities (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skills (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, icon VARCHAR(255) NOT NULL, first_description VARCHAR(400) NOT NULL, second_description VARCHAR(255) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cms_content (id INT AUTO_INCREMENT NOT NULL, text LONGTEXT NOT NULL, links LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', title VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE activities');
        $this->addSql('DROP TABLE skills');
        $this->addSql('DROP TABLE cms_content');
    }
}
