<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230704123143 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles ADD articles_images_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168298C6869 FOREIGN KEY (articles_images_id) REFERENCES articles_images (id)');
        $this->addSql('CREATE INDEX IDX_BFDD3168298C6869 ON articles (articles_images_id)');
        $this->addSql('ALTER TABLE articles_images DROP FOREIGN KEY FK_5A276A477294869C');
        $this->addSql('DROP INDEX IDX_5A276A477294869C ON articles_images');
        $this->addSql('ALTER TABLE articles_images DROP article_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168298C6869');
        $this->addSql('DROP INDEX IDX_BFDD3168298C6869 ON articles');
        $this->addSql('ALTER TABLE articles DROP articles_images_id');
        $this->addSql('ALTER TABLE articles_images ADD article_id INT NOT NULL');
        $this->addSql('ALTER TABLE articles_images ADD CONSTRAINT FK_5A276A477294869C FOREIGN KEY (article_id) REFERENCES articles (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_5A276A477294869C ON articles_images (article_id)');
    }
}
