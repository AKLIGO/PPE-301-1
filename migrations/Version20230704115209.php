<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230704115209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles ADD articles_img_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD31687A524B78 FOREIGN KEY (articles_img_id) REFERENCES articles_images (id)');
        $this->addSql('CREATE INDEX IDX_BFDD31687A524B78 ON articles (articles_img_id)');
        $this->addSql('ALTER TABLE articles_images DROP articles_img_id, DROP article_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD31687A524B78');
        $this->addSql('DROP INDEX IDX_BFDD31687A524B78 ON articles');
        $this->addSql('ALTER TABLE articles DROP articles_img_id');
        $this->addSql('ALTER TABLE articles_images ADD articles_img_id INT NOT NULL, ADD article_id INT NOT NULL');
    }
}
