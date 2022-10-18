<?php

declare(strict_types=1);

namespace LaService\Component\Doctrine\Data\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221018191454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE la_service_authentication_users ADD password_hash VARCHAR(255) DEFAULT NULL, ADD join_confirm_token_value VARCHAR(255) DEFAULT NULL, ADD join_confirm_token_expires DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE la_service_authentication_users DROP password_hash, DROP join_confirm_token_value, DROP join_confirm_token_expires');
    }
}
