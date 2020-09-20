<?php
namespace api\model;

use framework\ModelBase;
use framework\PDOSingleton;
use framework\Request;

/**
 * Class Category
 * @package api\model
 */
class Category extends ModelBase
{
    protected string $table = 'categories';
    public int $id;
    public string $name;
    public string $description;

    /**
     * @param Request $request
     * @return bool
     */
    public function create(Request $request): bool
    {
        $PDOInstance = PDOSingleton::getInstance();
        $query = <<<SQL
INSERT INTO `{$this->table}` (`name`, `description`) VALUES (:title, :description);
SQL;
        $statement = $PDOInstance->prepare($query);
        $statement->bindValue(':title', $request->post['title']);
        $statement->bindValue(':description', $request->post['description']);

        return $statement->execute();
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function delete(Request $request): bool
    {
        $PDOInstance = PDOSingleton::getInstance();
        $query = <<<SQL
DELETE `{$this->table}`, `items`, `subitems` FROM `{$this->table}`
LEFT JOIN `items` ON `items`.`category_id` = `{$this->table}`.`id` 
LEFT JOIN `subitems` ON `subitems`.`item_id` = `items`.`id` 
WHERE `{$this->table}`.`id` = :id;
SQL;
        $statement = $PDOInstance->prepare($query);
        $statement->bindValue(':id', $request->request['id']);

        return $statement->execute();
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function update(Request $request): bool
    {
        $PDOInstance = PDOSingleton::getInstance();
        $query = <<<SQL
UPDATE `{$this->table}` SET `name` = :name, `description` = :description WHERE `id` = :id;
SQL;
        $statement = $PDOInstance->prepare($query);
        $statement->bindValue(':id', $request->post['id']);
        $statement->bindValue(':name', $request->post['title']);
        $statement->bindValue(':description', $request->post['description']);

        return $statement->execute();
    }
}
