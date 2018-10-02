<?php
declare(strict_types = 1);
namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Types\TextType;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181002051750 extends AbstractMigration
{

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $users = $schema->getTable("users");
        $users->addColumn("gender_id", TextType::INTEGER)->setUnsigned(true);
        $users->addIndex((array) "gender_id", "idx_user_genders");
        $users->addForeignKeyConstraint("genders", (array) "gender_id", (array) "id", [], "fk_user_genders");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $users = $schema->getTable("users");
        $users->dropColumn("gender_id", TextType::INTEGER);
    }
}
