<?php
declare(strict_types = 1);
namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Types\TextType;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180926040751 extends AbstractMigration
{

    const TABLE_NAME = "users";

    private static function master($id, $username, $password, $email)
    {
        return compact("id", "username", "password", "email");
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $table = $schema->createTable(self::TABLE_NAME);
        $table->addColumn("id", TextType::INTEGER)->setAutoincrement(true);
        $table->addColumn("username", TextType::STRING)->setLength(50);
        $table->addColumn("password", TextType::STRING)->setLength(255);
        $table->addColumn("email", TextType::STRING)->setLength(255);
        $table->addColumn("created", TextType::DATETIME)->setDefault("CURRENT_TIMESTAMP");
        $table->addColumn("updated", TextType::DATETIME)->setDefault("CURRENT_TIMESTAMP");
        $table->addColumn("del_flag", TextType::BOOLEAN)->setDefault("0");

        $table->setPrimaryKey((array) "id");
    }

    public function postUp(Schema $schema)
    {
        $this->connection->insert(self::TABLE_NAME, self::master(1, 'system', '$2y$12$VmCANtMHpirByAlEIDXqUO.IIYKhm4gDTE1ZlyCVV82QREnowlNKC', 'system@localhost'));
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $table = $schema->getTable(self::TABLE_NAME);
        $schema->dropTable($table->getName());
    }
}
