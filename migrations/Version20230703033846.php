<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230703033846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles_images ADD CONSTRAINT FK_5A276A477294869C7A524B78 FOREIGN KEY (article_id, articles_img_id) REFERENCES articles (id)');
        $this->addSql('CREATE INDEX IDX_5A276A477294869C7A524B78 ON articles_images (article_id, articles_img_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles_images DROP FOREIGN KEY FK_5A276A477294869C7A524B78');
        $this->addSql('DROP INDEX IDX_5A276A477294869C7A524B78 ON articles_images');
    }
}
