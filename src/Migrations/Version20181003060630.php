<?php
declare(strict_types = 1);
namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Types\TextType;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181003060630 extends AbstractMigration
{

    const TABLE_NAME = "users";

    const COLUMN_NAME = "birthday_year";

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $table = $schema->getTable(self::TABLE_NAME);
        $table->addColumn(self::COLUMN_NAME, TextType::INTEGER)->setNotnull(false);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $table = $schema->getTable(self::TABLE_NAME);
        $table->dropColumn(self::COLUMN_NAME, TextType::INTEGER);
    }
}
