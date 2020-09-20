<?php
namespace db;

use framework\PDOSingleton;

/**
 * Class DatabaseSchema
 * @package db
 */
class DatabaseSchema
{

    /**
     * @throws \Exception
     */
    public static function create()
    {
        try {
            $PDOInstance = PDOSingleton::getInstance();

            $sql = <<<'SQL'
CREATE TABLE `users` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `firstname` VARCHAR(50),
    `lastname` VARCHAR(50),
    `email` VARCHAR(80) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `role` VARCHAR(16) NOT NULL
)
SQL;
            $PDOInstance->exec($sql);
            echo "Table Users created successfully";

            $sql = <<<'SQL'
CREATE TABLE `categories` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL,
    `description` VARCHAR(255)
)
SQL;
            $PDOInstance->exec($sql);
            echo "Table Categories created successfully";

            $sql = <<<'SQL'
CREATE TABLE `items` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `category_id` INT UNSIGNED,
    `name` VARCHAR(50) NOT NULL,
    `description` VARCHAR(255)
)
SQL;
            $PDOInstance->exec($sql);
            echo "Table Items created successfully";

            $sql = <<<'SQL'
CREATE TABLE `subitems` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `item_id` INT UNSIGNED,
    `name` VARCHAR(50) NOT NULL,
    `description` VARCHAR(255)
)
SQL;
            $PDOInstance->exec($sql);
            echo "Table Subitems created successfully";
        } catch(\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @throws \Exception
     */
    public static function seed()
    {
        try {
            $PDOInstance = PDOSingleton::getInstance();
            /* Users Inserts */
            $passwordHash = 'password_hash';
            $sql = <<<SQL
INSERT INTO `users` (`firstname`, `lastname`, `email`, `password`, `role`)
VALUES ('Jean', 'Dupont', 'jean.dupont@gmail.com', '{$passwordHash('medialis0Password0!', PASSWORD_DEFAULT)}', 'admin');
SQL;
            $PDOInstance->exec($sql);
            echo "Table users seeded successfully";

            /* Categories Inserts */
            $sql = <<<'SQL'
INSERT INTO `categories` (`name`, `description`)
VALUES ('todo', 'Things i have to do soon or later');
SQL;
            $PDOInstance->exec($sql);
            echo "Table categories seeded successfully";

            /* Items Inserts */
            $sql = <<<'SQL'
INSERT INTO `items` (`category_id`, `name`, `description`)
VALUES (1, 'tech test', 'Thing i am doing');
SQL;
            $PDOInstance->exec($sql);
            echo "Table items seeded successfully";

            /* Subitems Inserts */
            $sql = <<<'SQL'
INSERT INTO `subitems` (`item_id`, `name`, `description`)
VALUES (1, 'backend', 'from scratch !');
SQL;
            $PDOInstance->exec($sql);
            echo "Table subitems seeded successfully";
        } catch(\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
