<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230704120543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles_images DROP articles_img_id');
        $this->addSql('ALTER TABLE articles_images ADD CONSTRAINT FK_5A276A477294869C FOREIGN KEY (article_id) REFERENCES articles (id)');
        $this->addSql('CREATE INDEX IDX_5A276A477294869C ON articles_images (article_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles_images DROP FOREIGN KEY FK_5A276A477294869C');
        $this->addSql('DROP INDEX IDX_5A276A477294869C ON articles_images');
        $this->addSql('ALTER TABLE articles_images ADD articles_img_id INT NOT NULL');
    }
}
