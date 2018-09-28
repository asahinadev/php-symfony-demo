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

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $table = $schema->createTable("users");
        $table->addColumn("id", TextType::INTEGER)
            ->setUnsigned(true)
            ->setAutoincrement(true);

        $table->addColumn("username", TextType::STRING)->setLength(50);
        $table->addColumn("password", TextType::STRING)->setLength(255);
        $table->addColumn("email", TextType::STRING)->setLength(255);
        $table->addColumn("created", TextType::DATETIME)->setDefault("CURRENT_TIMESTAMP");
        $table->addColumn("updated", TextType::DATETIME)->setDefault("CURRENT_TIMESTAMP");
        $table->addColumn("del_flag", TextType::BOOLEAN)->setDefault("0");

        $table->setPrimaryKey((array) "id");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $table = $schema->createTable("users");
        $schema->dropTable($table->getName());
    }
}
