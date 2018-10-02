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

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $table = $schema->createTable("genders");
        $table->addColumn("id", TextType::INTEGER)->setUnsigned(true);
        $table->addColumn("name", TextType::STRING)->setLength(50);
        $table->setPrimaryKey((array) "id");
    }

    public function postUp(Schema $schema)
    {
        $this->connection->insert("genders", [
            "id" => 0,
            "name" => "unanswered"
        ]);
        $this->connection->insert("genders", [
            "id" => 1,
            "name" => "male"
        ]);
        $this->connection->insert("genders", [
            "id" => 2,
            "name" => "female"
        ]);
        $this->connection->insert("genders", [
            "id" => 9,
            "name" => "not applicable"
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $table = $schema->getTable("genders");
        $schema->dropTable($table->getName());
    }
}
