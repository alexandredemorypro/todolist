<?php
namespace api\model;

use framework\ModelBase;
use framework\PDOSingleton;
use framework\Request;

/**
 * Class Item
 * @package api\model
 */
class Item extends ModelBase
{
    protected string $table = 'items';
    public int $id;
    public int $category_id;
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
INSERT INTO `{$this->table}` (`category_id`, `name`, `description`) VALUES (:category_id, :title, :description);
SQL;
        $statement = $PDOInstance->prepare($query);
        $statement->bindValue(':category_id', $request->post['category_id']);
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
DELETE `{$this->table}`, `subitems` FROM `{$this->table}` 
LEFT JOIN `subitems` ON `subitems`.`item_id` = `{$this->table}`.`id` 
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

    /**
     * @param Request $request
     * @return array|null
     */
    public function getByCategoryId(Request $request): ?array
    {
        $PDOInstance = PDOSingleton::getInstance();
        $query = <<<SQL
SELECT `id`, `category_id`, `name`, `description` FROM `{$this->table}` WHERE `category_id` = :id;
SQL;
        $statement = $PDOInstance->prepare($query);
        $statement->bindValue(':id', $request->request['id']);

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS, get_called_class());
    }
}
