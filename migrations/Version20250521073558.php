<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250521073558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE abonnement (id INT AUTO_INCREMENT NOT NULL, id_utilisateur_id INT NOT NULL, id_categorie_id INT DEFAULT NULL, libelle VARCHAR(75) NOT NULL, frequence VARCHAR(255) NOT NULL, montant DOUBLE PRECISION NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, description VARCHAR(75) DEFAULT NULL, INDEX IDX_351268BBC6EE5C49 (id_utilisateur_id), INDEX IDX_351268BB9F34925F (id_categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE achat (id INT AUTO_INCREMENT NOT NULL, id_utilisateur_id INT NOT NULL, id_categorie_id INT NOT NULL, montant DOUBLE PRECISION NOT NULL, date_achat DATE NOT NULL, description VARCHAR(75) DEFAULT NULL, INDEX IDX_26A98456C6EE5C49 (id_utilisateur_id), INDEX IDX_26A984569F34925F (id_categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, argent DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE abonnement ADD CONSTRAINT FK_351268BBC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB9F34925F FOREIGN KEY (id_categorie_id) REFERENCES categorie (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE achat ADD CONSTRAINT FK_26A98456C6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE achat ADD CONSTRAINT FK_26A984569F34925F FOREIGN KEY (id_categorie_id) REFERENCES categorie (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BBC6EE5C49
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BB9F34925F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE achat DROP FOREIGN KEY FK_26A98456C6EE5C49
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE achat DROP FOREIGN KEY FK_26A984569F34925F
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE abonnement
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE achat
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE categorie
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE `user`
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
