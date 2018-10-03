<?php
declare(strict_types = 1);
namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Types\TextType;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181003002120 extends AbstractMigration
{

    const TABLE_NAME = "users";

    const INDEX_NAME = "idx_user_prefs";

    const FKEY_NAME = "fk_user_prefs";

    const FKEY_COLUMN = "pref_id";

    const FKEY_TABLE = "prefs";

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $table = $schema->getTable(self::TABLE_NAME);
        $table->addColumn(self::FKEY_COLUMN, TextType::INTEGER)
            ->setUnsigned(true)
            ->setDefault("0")
            ->setNotnull(true);
        $table->addIndex((array) self::FKEY_COLUMN, self::INDEX_NAME);
        $table->addForeignKeyConstraint(self::FKEY_TABLE, (array) self::FKEY_COLUMN, (array) "id", [], self::FKEY_NAME);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $table = $schema->getTable(self::TABLE_NAME);
        $table->removeForeignKey(self::FKEY_NAME);
        $table->dropIndex(self::INDEX_NAME);
        $table->dropColumn(self::FKEY_COLUMN, TextType::INTEGER);
    }
}
