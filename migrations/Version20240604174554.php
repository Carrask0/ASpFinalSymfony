<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240604174554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE biblioteca (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, direccion VARCHAR(255) NOT NULL, ciudad VARCHAR(255) NOT NULL, horario_apertura TIME NOT NULL, horario_cierre TIME NOT NULL, fecha_fundacion DATE NOT NULL, normas VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE libro (id INT AUTO_INCREMENT NOT NULL, biblioteca_id INT NOT NULL, titulo VARCHAR(255) NOT NULL, autor VARCHAR(255) NOT NULL, sinopsis VARCHAR(255) NOT NULL, publicacion VARCHAR(255) NOT NULL, editorial VARCHAR(255) NOT NULL, isbn VARCHAR(255) NOT NULL, numero_ejemplares INT NOT NULL, INDEX IDX_5799AD2B6A5EDAE9 (biblioteca_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE libro ADD CONSTRAINT FK_5799AD2B6A5EDAE9 FOREIGN KEY (biblioteca_id) REFERENCES biblioteca (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE libro DROP FOREIGN KEY FK_5799AD2B6A5EDAE9');
        $this->addSql('DROP TABLE biblioteca');
        $this->addSql('DROP TABLE libro');
    }
}
