<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230108212640 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agencia (id INT AUTO_INCREMENT NOT NULL, gerente_id INT DEFAULT NULL, codigo VARCHAR(255) NOT NULL, telefone VARCHAR(255) NOT NULL, cidade VARCHAR(255) NOT NULL, rua VARCHAR(255) NOT NULL, cep VARCHAR(255) NOT NULL, bairro VARCHAR(255) NOT NULL, numero VARCHAR(255) NOT NULL, estado VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_EB6C2B995AEA750D (gerente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conta (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, agencia_id INT DEFAULT NULL, tipo_id INT DEFAULT NULL, numero VARCHAR(255) NOT NULL, saldo DOUBLE PRECISION NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_485A16C3DB38439E (usuario_id), INDEX IDX_485A16C3A6F796BE (agencia_id), INDEX IDX_485A16C3A9276E6C (tipo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gerente (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_306C486DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipo_conta (id INT AUTO_INCREMENT NOT NULL, tipo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transacao (id INT AUTO_INCREMENT NOT NULL, destinatario_id INT DEFAULT NULL, remetente_id INT DEFAULT NULL, descricao VARCHAR(255) NOT NULL, valor VARCHAR(255) NOT NULL, data DATETIME NOT NULL, INDEX IDX_6C9E60CEB564FBC1 (destinatario_id), INDEX IDX_6C9E60CEFA0A674B (remetente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, nome VARCHAR(255) NOT NULL, cpf VARCHAR(255) NOT NULL, celular VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agencia ADD CONSTRAINT FK_EB6C2B995AEA750D FOREIGN KEY (gerente_id) REFERENCES gerente (id)');
        $this->addSql('ALTER TABLE conta ADD CONSTRAINT FK_485A16C3DB38439E FOREIGN KEY (usuario_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE conta ADD CONSTRAINT FK_485A16C3A6F796BE FOREIGN KEY (agencia_id) REFERENCES agencia (id)');
        $this->addSql('ALTER TABLE conta ADD CONSTRAINT FK_485A16C3A9276E6C FOREIGN KEY (tipo_id) REFERENCES tipo_conta (id)');
        $this->addSql('ALTER TABLE gerente ADD CONSTRAINT FK_306C486DA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE transacao ADD CONSTRAINT FK_6C9E60CEB564FBC1 FOREIGN KEY (destinatario_id) REFERENCES conta (id)');
        $this->addSql('ALTER TABLE transacao ADD CONSTRAINT FK_6C9E60CEFA0A674B FOREIGN KEY (remetente_id) REFERENCES conta (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agencia DROP FOREIGN KEY FK_EB6C2B995AEA750D');
        $this->addSql('ALTER TABLE conta DROP FOREIGN KEY FK_485A16C3DB38439E');
        $this->addSql('ALTER TABLE conta DROP FOREIGN KEY FK_485A16C3A6F796BE');
        $this->addSql('ALTER TABLE conta DROP FOREIGN KEY FK_485A16C3A9276E6C');
        $this->addSql('ALTER TABLE gerente DROP FOREIGN KEY FK_306C486DA76ED395');
        $this->addSql('ALTER TABLE transacao DROP FOREIGN KEY FK_6C9E60CEB564FBC1');
        $this->addSql('ALTER TABLE transacao DROP FOREIGN KEY FK_6C9E60CEFA0A674B');
        $this->addSql('DROP TABLE agencia');
        $this->addSql('DROP TABLE conta');
        $this->addSql('DROP TABLE gerente');
        $this->addSql('DROP TABLE tipo_conta');
        $this->addSql('DROP TABLE transacao');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
