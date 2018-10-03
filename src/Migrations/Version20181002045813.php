<?php
declare(strict_types = 1);
namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Types\TextType;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181002045813 extends AbstractMigration
{

    const TABLE_NAME = "genders";

    private static function master($id, $name)
    {
        return compact("id", "name");
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $table = $schema->createTable(self::TABLE_NAME);
        $table->addColumn("id", TextType::INTEGER)->setUnsigned(true);
        $table->addColumn("name", TextType::STRING)->setLength(50);
        $table->setPrimaryKey((array) "id");
    }

    public function postUp(Schema $schema)
    {
        $this->connection->insert(self::TABLE_NAME, self::master(0, "未回答"));
        $this->connection->insert(self::TABLE_NAME, self::master(1, "男性"));
        $this->connection->insert(self::TABLE_NAME, self::master(2, "女性"));
        $this->connection->insert(self::TABLE_NAME, self::master(9, "適用不可"));
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $table = $schema->getTable(self::TABLE_NAME);
        $schema->dropTable($table->getName());
    }
}
