<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230622103910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce_emploi ADD categorie_id INT NOT NULL, ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE annonce_emploi ADD CONSTRAINT FK_1407B3E4BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE annonce_emploi ADD CONSTRAINT FK_1407B3E4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_1407B3E4BCF5E72D ON annonce_emploi (categorie_id)');
        $this->addSql('CREATE INDEX IDX_1407B3E4A76ED395 ON annonce_emploi (user_id)');
        $this->addSql('ALTER TABLE commandes ADD forfait_id INT NOT NULL, ADD facture_id INT NOT NULL, ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C906D5F2C FOREIGN KEY (forfait_id) REFERENCES forfait (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C7F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_35D4282C906D5F2C ON commandes (forfait_id)');
        $this->addSql('CREATE INDEX IDX_35D4282C7F2DEE08 ON commandes (facture_id)');
        $this->addSql('CREATE INDEX IDX_35D4282CA76ED395 ON commandes (user_id)');
        $this->addSql('ALTER TABLE cv ADD categorie_id INT NOT NULL, ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE92BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE92A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B66FFE92BCF5E72D ON cv (categorie_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B66FFE92A76ED395 ON cv (user_id)');
        $this->addSql('ALTER TABLE facture ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_FE866410A76ED395 ON facture (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE92BCF5E72D');
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE92A76ED395');
        $this->addSql('DROP INDEX IDX_B66FFE92BCF5E72D ON cv');
        $this->addSql('DROP INDEX UNIQ_B66FFE92A76ED395 ON cv');
        $this->addSql('ALTER TABLE cv DROP categorie_id, DROP user_id');
        $this->addSql('ALTER TABLE annonce_emploi DROP FOREIGN KEY FK_1407B3E4BCF5E72D');
        $this->addSql('ALTER TABLE annonce_emploi DROP FOREIGN KEY FK_1407B3E4A76ED395');
        $this->addSql('DROP INDEX IDX_1407B3E4BCF5E72D ON annonce_emploi');
        $this->addSql('DROP INDEX IDX_1407B3E4A76ED395 ON annonce_emploi');
        $this->addSql('ALTER TABLE annonce_emploi DROP categorie_id, DROP user_id');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410A76ED395');
        $this->addSql('DROP INDEX IDX_FE866410A76ED395 ON facture');
        $this->addSql('ALTER TABLE facture DROP user_id');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C906D5F2C');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C7F2DEE08');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282CA76ED395');
        $this->addSql('DROP INDEX IDX_35D4282C906D5F2C ON commandes');
        $this->addSql('DROP INDEX IDX_35D4282C7F2DEE08 ON commandes');
        $this->addSql('DROP INDEX IDX_35D4282CA76ED395 ON commandes');
        $this->addSql('ALTER TABLE commandes DROP forfait_id, DROP facture_id, DROP user_id');
    }
}
