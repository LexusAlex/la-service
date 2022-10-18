<?php

declare(strict_types=1);

namespace LaService\Component\Doctrine\Data\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221018163109 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE la_service_authentication_users ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD email VARCHAR(255) NOT NULL COMMENT \'(DC2Type:authentication_user_email)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2A14AB25E7927C74 ON la_service_authentication_users (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_2A14AB25E7927C74 ON la_service_authentication_users');
        $this->addSql('ALTER TABLE la_service_authentication_users DROP created_at, DROP updated_at, DROP email');
    }
}
