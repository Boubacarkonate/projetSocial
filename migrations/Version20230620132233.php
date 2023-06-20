<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230620132233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce_emploi ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE annonce_emploi ADD CONSTRAINT FK_1407B3E4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_1407B3E4A76ED395 ON annonce_emploi (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce_emploi DROP FOREIGN KEY FK_1407B3E4A76ED395');
        $this->addSql('DROP INDEX IDX_1407B3E4A76ED395 ON annonce_emploi');
        $this->addSql('ALTER TABLE annonce_emploi DROP user_id');
    }
}
