<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210718210712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rent (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, guid VARCHAR(255) NOT NULL, start_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', end_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', state VARCHAR(255) NOT NULL, price INT NOT NULL, INDEX IDX_2784DCC19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rent_copies (rent_id INT NOT NULL, copy_id INT NOT NULL, INDEX IDX_FB9CBBD7E5FD6250 (rent_id), INDEX IDX_FB9CBBD7A8752772 (copy_id), PRIMARY KEY(rent_id, copy_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rent ADD CONSTRAINT FK_2784DCC19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE rent_copies ADD CONSTRAINT FK_FB9CBBD7E5FD6250 FOREIGN KEY (rent_id) REFERENCES rent (id)');
        $this->addSql('ALTER TABLE rent_copies ADD CONSTRAINT FK_FB9CBBD7A8752772 FOREIGN KEY (copy_id) REFERENCES copy (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rent_copies DROP FOREIGN KEY FK_FB9CBBD7E5FD6250');
        $this->addSql('DROP TABLE rent');
        $this->addSql('DROP TABLE rent_copies');
    }
}
