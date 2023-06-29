<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230629140717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, prix INT NOT NULL, stock INT NOT NULL, creat_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', valid TINYINT(1) NOT NULL, INDEX IDX_BFDD3168C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE articles_images (id INT AUTO_INCREMENT NOT NULL, articles_img_id INT DEFAULT NULL, images_id INT DEFAULT NULL, nom VARCHAR(123) NOT NULL, INDEX IDX_5A276A477A524B78 (articles_img_id), INDEX IDX_5A276A47D44F05E5 (images_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, coupns_id INT DEFAULT NULL, users_id INT NOT NULL, reference VARCHAR(231) NOT NULL, creat_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_35D4282CAEA34913 (reference), INDEX IDX_35D4282CF9D633E9 (coupns_id), INDEX IDX_35D4282C67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coupns_types (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coupons (id INT AUTO_INCREMENT NOT NULL, coupons_types_id INT NOT NULL, code VARCHAR(16) NOT NULL, description LONGTEXT NOT NULL, remise DOUBLE PRECISION NOT NULL, max_usage INT NOT NULL, date_validation DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, statut TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_F564111877153098 (code), INDEX IDX_F56411183DDD47B7 (coupons_types_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detaile_commandes (commandes_id INT NOT NULL, articles_id INT NOT NULL, quantite INT NOT NULL, prix INT NOT NULL, INDEX IDX_9972A7F8BF5C2E6 (commandes_id), INDEX IDX_9972A7F1EBAF6CC (articles_id), PRIMARY KEY(commandes_id, articles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(80) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, articles_images_id INT DEFAULT NULL, nom VARCHAR(45) NOT NULL, code VARCHAR(12) NOT NULL, INDEX IDX_5A6F91CE298C6869 (articles_images_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, nom VARCHAR(50) NOT NULL, valid TINYINT(1) NOT NULL, INDEX IDX_8CDE5729BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(120) NOT NULL, code_postal VARCHAR(6) NOT NULL, ville VARCHAR(23) NOT NULL, creat_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE articles_images ADD CONSTRAINT FK_5A276A477A524B78 FOREIGN KEY (articles_img_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE articles_images ADD CONSTRAINT FK_5A276A47D44F05E5 FOREIGN KEY (images_id) REFERENCES articles_images (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CF9D633E9 FOREIGN KEY (coupns_id) REFERENCES coupons (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE coupons ADD CONSTRAINT FK_F56411183DDD47B7 FOREIGN KEY (coupons_types_id) REFERENCES coupns_types (id)');
        $this->addSql('ALTER TABLE detaile_commandes ADD CONSTRAINT FK_9972A7F8BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commandes (id)');
        $this->addSql('ALTER TABLE detaile_commandes ADD CONSTRAINT FK_9972A7F1EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE marque ADD CONSTRAINT FK_5A6F91CE298C6869 FOREIGN KEY (articles_images_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE5729BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168C54C8C93');
        $this->addSql('ALTER TABLE articles_images DROP FOREIGN KEY FK_5A276A477A524B78');
        $this->addSql('ALTER TABLE articles_images DROP FOREIGN KEY FK_5A276A47D44F05E5');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282CF9D633E9');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C67B3B43D');
        $this->addSql('ALTER TABLE coupons DROP FOREIGN KEY FK_F56411183DDD47B7');
        $this->addSql('ALTER TABLE detaile_commandes DROP FOREIGN KEY FK_9972A7F8BF5C2E6');
        $this->addSql('ALTER TABLE detaile_commandes DROP FOREIGN KEY FK_9972A7F1EBAF6CC');
        $this->addSql('ALTER TABLE marque DROP FOREIGN KEY FK_5A6F91CE298C6869');
        $this->addSql('ALTER TABLE type DROP FOREIGN KEY FK_8CDE5729BCF5E72D');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE articles_images');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE coupns_types');
        $this->addSql('DROP TABLE coupons');
        $this->addSql('DROP TABLE detaile_commandes');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
