<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200122193814 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE perfil CHANGE usuario_id usuario_id INT DEFAULT NULL, CHANGE idperfil idperfil INT DEFAULT NULL, CHANGE area area VARCHAR(120) DEFAULT NULL, CHANGE cargo cargo VARCHAR(120) DEFAULT NULL, CHANGE celular celular VARCHAR(120) DEFAULT NULL, CHANGE foto foto VARCHAR(120) DEFAULT NULL');
        $this->addSql('ALTER TABLE evento CHANGE usuario_id usuario_id INT DEFAULT NULL, CHANGE nombre nombre VARCHAR(200) DEFAULT NULL, CHANGE sede sede VARCHAR(120) DEFAULT NULL, CHANGE fecha fecha DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE fullname fullname VARCHAR(120) DEFAULT NULL, CHANGE active active TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE eventos DROP operador, CHANGE nombre nombre VARCHAR(200) DEFAULT NULL, CHANGE sede sede VARCHAR(120) DEFAULT NULL, CHANGE fecha fecha DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE evento CHANGE usuario_id usuario_id INT DEFAULT NULL, CHANGE nombre nombre VARCHAR(200) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE sede sede VARCHAR(120) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE fecha fecha DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE eventos ADD operador VARCHAR(120) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE nombre nombre VARCHAR(200) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE sede sede VARCHAR(120) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE fecha fecha DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE perfil CHANGE usuario_id usuario_id INT DEFAULT NULL, CHANGE idperfil idperfil INT DEFAULT NULL, CHANGE area area VARCHAR(120) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE cargo cargo VARCHAR(120) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE celular celular VARCHAR(120) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE foto foto VARCHAR(120) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE fullname fullname VARCHAR(120) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE active active TINYINT(1) DEFAULT \'NULL\'');
    }
}
