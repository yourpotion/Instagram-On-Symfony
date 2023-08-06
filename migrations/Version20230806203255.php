<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230806203255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE following DROP FOREIGN KEY FK_71BF8DE3AC24F853');
        $this->addSql('ALTER TABLE following ADD CONSTRAINT FK_71BF8DE3AC24F853 FOREIGN KEY (follower_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE following DROP FOREIGN KEY FK_71BF8DE3AC24F853');
        $this->addSql('ALTER TABLE following ADD CONSTRAINT FK_71BF8DE3AC24F853 FOREIGN KEY (follower_id) REFERENCES follower (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
