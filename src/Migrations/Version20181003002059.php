<?php
declare(strict_types = 1);
namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Types\TextType;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181003002059 extends AbstractMigration
{

    const TABLE_NAME = "prefs";

    private static function master($id, $name, $ruby, $code = null)
    {
        if (is_null($code)) {
            $code = sprintf("%02d", $id);
        }
        return compact("id", "name", "ruby", "code");
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $table = $schema->createTable(self::TABLE_NAME);
        $table->addColumn("id", TextType::INTEGER)->setUnsigned(true);
        $table->addColumn("name", TextType::STRING)->setLength(50);
        $table->addColumn("ruby", TextType::STRING)->setLength(50);
        $table->addColumn("code", TextType::STRING)->setLength(10);
        $table->setPrimaryKey((array) "id");
    }

    public function postUp(Schema $schema)
    {
        $this->connection->insert(self::TABLE_NAME, self::master(0, "未回答", "ミカイトウ"));
        $this->connection->insert(self::TABLE_NAME, self::master(1, "北海道", "ホッカイドウ"));
        $this->connection->insert(self::TABLE_NAME, self::master(2, "青森県", "アオモリケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(3, "岩手県", "イワテケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(4, "宮城県", "ミヤギケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(5, "秋田県", "アキタケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(6, "山形県", "ヤマガタケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(7, "福島県", "フクシマケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(8, "茨城県", "イバラキケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(9, "栃木県", "トチギケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(10, "群馬県", "グンマケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(11, "埼玉県", "サイタマケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(12, "千葉県", "チバケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(13, "東京都", "トウキョウト"));
        $this->connection->insert(self::TABLE_NAME, self::master(14, "神奈川県", "カナガワケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(15, "新潟県", "ニイガタケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(16, "富山県", "トヤマケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(17, "石川県", "イシカワケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(18, "福井県", "フクイケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(19, "山梨県", "ヤマナシケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(20, "長野県", "ナガノケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(21, "岐阜県", "ギフケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(22, "静岡県", "シズオカケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(23, "愛知県", "アイチケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(24, "三重県", "ミエケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(25, "滋賀県", "シガケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(26, "京都府", "キョウトフ"));
        $this->connection->insert(self::TABLE_NAME, self::master(27, "大阪府", "オオサカフ"));
        $this->connection->insert(self::TABLE_NAME, self::master(28, "兵庫県", "ヒョウゴケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(29, "奈良県", "ナラケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(30, "和歌山県", "ワカヤマケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(31, "鳥取県", "トットリケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(32, "島根県", "シマネケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(33, "岡山県", "オカヤマケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(34, "広島県", "ヒロシマケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(35, "山口県", "ヤマグチケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(36, "徳島県", "トクシマケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(37, "香川県", "カガワケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(38, "愛媛県", "エヒメケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(39, "高知県", "コウチケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(40, "福岡県", "フクオカケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(41, "佐賀県", "サガケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(42, "長崎県", "ナガサキケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(43, "熊本県", "クマモトケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(44, "大分県", "オオイタケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(45, "宮崎県", "ミヤザキケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(46, "鹿児島県", "カゴシマケン"));
        $this->connection->insert(self::TABLE_NAME, self::master(47, "沖縄県", "オキナワケン"));
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $table = $schema->getTable("prefs");
        $schema->dropTable($table->getName());
    }
}
    