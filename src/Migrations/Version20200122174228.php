<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200122174228 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE evento (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(200) DEFAULT NULL, sede VARCHAR(120) DEFAULT NULL, fecha DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE perfil CHANGE usuario_id usuario_id INT DEFAULT NULL, CHANGE idperfil idperfil INT DEFAULT NULL, CHANGE area area VARCHAR(120) DEFAULT NULL, CHANGE cargo cargo VARCHAR(120) DEFAULT NULL, CHANGE celular celular VARCHAR(120) DEFAULT NULL, CHANGE foto foto VARCHAR(120) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD evento_id INT DEFAULT NULL, CHANGE eventos_id eventos_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL, CHANGE fullname fullname VARCHAR(120) DEFAULT NULL, CHANGE active active TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64987A5F842 FOREIGN KEY (evento_id) REFERENCES evento (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64987A5F842 ON user (evento_id)');
        $this->addSql('ALTER TABLE eventos CHANGE nombre nombre VARCHAR(200) DEFAULT NULL, CHANGE sede sede VARCHAR(120) DEFAULT NULL, CHANGE fecha fecha DATETIME DEFAULT NULL, CHANGE operador operador VARCHAR(120) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64987A5F842');
        $this->addSql('DROP TABLE evento');
        $this->addSql('ALTER TABLE eventos CHANGE nombre nombre VARCHAR(200) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE sede sede VARCHAR(120) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE fecha fecha DATETIME DEFAULT \'NULL\', CHANGE operador operador VARCHAR(120) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE perfil CHANGE usuario_id usuario_id INT DEFAULT NULL, CHANGE idperfil idperfil INT DEFAULT NULL, CHANGE area area VARCHAR(120) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE cargo cargo VARCHAR(120) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE celular celular VARCHAR(120) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE foto foto VARCHAR(120) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX IDX_8D93D64987A5F842 ON user');
        $this->addSql('ALTER TABLE user DROP evento_id, CHANGE eventos_id eventos_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE fullname fullname VARCHAR(120) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE active active TINYINT(1) DEFAULT \'NULL\'');
    }
}
