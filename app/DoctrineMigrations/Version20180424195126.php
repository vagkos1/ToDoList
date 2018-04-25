<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180424195126 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE todo (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, created_at DATETIME NOT NULL, due_date DATETIME NOT NULL, priority INT NOT NULL, description VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, INDEX IDX_5A0EB6A0B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json_array)\', first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE todo ADD CONSTRAINT FK_5A0EB6A0B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE todo DROP FOREIGN KEY FK_5A0EB6A0B03A8386');
        $this->addSql('DROP TABLE todo');
        $this->addSql('DROP TABLE user');
    }
}
