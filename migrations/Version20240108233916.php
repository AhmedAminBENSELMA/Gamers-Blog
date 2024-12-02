<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240108233916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, account_id INT NOT NULL, comment_context LONGTEXT NOT NULL, INDEX IDX_9474526C4B89032C (post_id), INDEX IDX_9474526C9B6B5FBA (account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE followers (id INT AUTO_INCREMENT NOT NULL, gamer_id INT DEFAULT NULL, followedby_id INT DEFAULT NULL, INDEX IDX_8408FDA72F43A116 (gamer_id), INDEX IDX_8408FDA769D07F92 (followedby_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, gamer_id INT NOT NULL, context LONGTEXT NOT NULL, likes INT NOT NULL, video LONGTEXT NOT NULL, INDEX IDX_5A8A6C8D2F43A116 (gamer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C4B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C9B6B5FBA FOREIGN KEY (account_id) REFERENCES gamer (id)');
        $this->addSql('ALTER TABLE followers ADD CONSTRAINT FK_8408FDA72F43A116 FOREIGN KEY (gamer_id) REFERENCES gamer (id)');
        $this->addSql('ALTER TABLE followers ADD CONSTRAINT FK_8408FDA769D07F92 FOREIGN KEY (followedby_id) REFERENCES gamer (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D2F43A116 FOREIGN KEY (gamer_id) REFERENCES gamer (id)');
        $this->addSql('DROP TABLE admin');
        $this->addSql('ALTER TABLE gamer CHANGE full_name full_name VARCHAR(255) NOT NULL, CHANGE image image VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_880E0D76E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C4B89032C');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C9B6B5FBA');
        $this->addSql('ALTER TABLE followers DROP FOREIGN KEY FK_8408FDA72F43A116');
        $this->addSql('ALTER TABLE followers DROP FOREIGN KEY FK_8408FDA769D07F92');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D2F43A116');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE followers');
        $this->addSql('DROP TABLE post');
        $this->addSql('ALTER TABLE gamer CHANGE full_name full_name VARCHAR(255) DEFAULT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL');
    }
}
