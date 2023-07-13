<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230713181714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_image (id INT AUTO_INCREMENT NOT NULL, articles_id INT DEFAULT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_B28A764E1EBAF6CC (articles_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, marque_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, stock DOUBLE PRECISION NOT NULL, couleur VARCHAR(255) NOT NULL, valid TINYINT(1) NOT NULL, INDEX IDX_BFDD3168C54C8C93 (type_id), INDEX IDX_BFDD31684827B9B2 (marque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE command_users (id INT AUTO_INCREMENT NOT NULL, commandes_id INT DEFAULT NULL, users_id INT DEFAULT NULL, INDEX IDX_872BF0DA8BF5C2E6 (commandes_id), INDEX IDX_872BF0DA67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, date_creat DATE NOT NULL, reference VARCHAR(255) NOT NULL, date_livraison DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coupons (id INT AUTO_INCREMENT NOT NULL, coupons_type_id INT DEFAULT NULL, code VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, valeur INT NOT NULL, statut TINYINT(1) NOT NULL, max_usage INT NOT NULL, date_create DATE NOT NULL, date_expiration DATE NOT NULL, INDEX IDX_F5641118CC42426B (coupons_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coupons_commandes (id INT AUTO_INCREMENT NOT NULL, coupons_id INT DEFAULT NULL, commandes_id INT DEFAULT NULL, INDEX IDX_956DA5206D72B15C (coupons_id), INDEX IDX_956DA5208BF5C2E6 (commandes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coupons_types (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE details_commandes (id INT AUTO_INCREMENT NOT NULL, articles_id INT DEFAULT NULL, commandes_id INT DEFAULT NULL, prix_total DOUBLE PRECISION NOT NULL, quantites DOUBLE PRECISION NOT NULL, INDEX IDX_4FD424F71EBAF6CC (articles_id), INDEX IDX_4FD424F78BF5C2E6 (commandes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, commande_id INT DEFAULT NULL, montant DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_FE86641082EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_8CDE5729BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(120) NOT NULL, code_postal VARCHAR(6) NOT NULL, ville VARCHAR(23) NOT NULL, creat_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_image ADD CONSTRAINT FK_B28A764E1EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD31684827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE command_users ADD CONSTRAINT FK_872BF0DA8BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commandes (id)');
        $this->addSql('ALTER TABLE command_users ADD CONSTRAINT FK_872BF0DA67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE coupons ADD CONSTRAINT FK_F5641118CC42426B FOREIGN KEY (coupons_type_id) REFERENCES coupons_types (id)');
        $this->addSql('ALTER TABLE coupons_commandes ADD CONSTRAINT FK_956DA5206D72B15C FOREIGN KEY (coupons_id) REFERENCES coupons (id)');
        $this->addSql('ALTER TABLE coupons_commandes ADD CONSTRAINT FK_956DA5208BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commandes (id)');
        $this->addSql('ALTER TABLE details_commandes ADD CONSTRAINT FK_4FD424F71EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE details_commandes ADD CONSTRAINT FK_4FD424F78BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commandes (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641082EA2E54 FOREIGN KEY (commande_id) REFERENCES commandes (id)');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE5729BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_image DROP FOREIGN KEY FK_B28A764E1EBAF6CC');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168C54C8C93');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD31684827B9B2');
        $this->addSql('ALTER TABLE command_users DROP FOREIGN KEY FK_872BF0DA8BF5C2E6');
        $this->addSql('ALTER TABLE command_users DROP FOREIGN KEY FK_872BF0DA67B3B43D');
        $this->addSql('ALTER TABLE coupons DROP FOREIGN KEY FK_F5641118CC42426B');
        $this->addSql('ALTER TABLE coupons_commandes DROP FOREIGN KEY FK_956DA5206D72B15C');
        $this->addSql('ALTER TABLE coupons_commandes DROP FOREIGN KEY FK_956DA5208BF5C2E6');
        $this->addSql('ALTER TABLE details_commandes DROP FOREIGN KEY FK_4FD424F71EBAF6CC');
        $this->addSql('ALTER TABLE details_commandes DROP FOREIGN KEY FK_4FD424F78BF5C2E6');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641082EA2E54');
        $this->addSql('ALTER TABLE type DROP FOREIGN KEY FK_8CDE5729BCF5E72D');
        $this->addSql('DROP TABLE article_image');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE command_users');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE coupons');
        $this->addSql('DROP TABLE coupons_commandes');
        $this->addSql('DROP TABLE coupons_types');
        $this->addSql('DROP TABLE details_commandes');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
