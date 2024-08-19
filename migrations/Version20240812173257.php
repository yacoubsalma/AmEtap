<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240812173257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE custom_form (id INT AUTO_INCREMENT NOT NULL, evenement_id INT NOT NULL, field_label VARCHAR(255) NOT NULL, field_type VARCHAR(255) NOT NULL, INDEX IDX_53FE35B2FD02F13 (evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE custom_form ADD CONSTRAINT FK_53FE35B2FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (ide)');
        $this->addSql('ALTER TABLE evenement CHANGE img img VARCHAR(255) DEFAULT NULL, CHANGE dateD dateD DATE NOT NULL, CHANGE dateF dateF DATE NOT NULL');
        $this->addSql('ALTER TABLE reservation CHANGE ide ide INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE custom_form DROP FOREIGN KEY FK_53FE35B2FD02F13');
        $this->addSql('DROP TABLE custom_form');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE evenement CHANGE img img VARCHAR(255) NOT NULL, CHANGE dateD dateD DATE DEFAULT \'NULL\', CHANGE dateF dateF DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE reservation CHANGE ide ide INT NOT NULL');
    }
}
