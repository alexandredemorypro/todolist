<?php
namespace api\model;

use framework\ModelBase;
use framework\PDOSingleton;
use framework\Request;

/**
 * Class Subitem
 * @package api\model
 */
class Subitem extends ModelBase
{
    protected string $table = 'subitems';
    public int $id;
    public int $item_id;
    public string $name;
    public string $description;

    /**
     * @param Request $request
     * @return array
     */
    public function getByItemId(Request $request): array
    {
        $PDOInstance = PDOSingleton::getInstance();
        $query = <<<SQL
SELECT * FROM `{$this->table}` WHERE `item_id` = :id;
SQL;
        $statement = $PDOInstance->prepare($query);
        $statement->bindValue(':id', $request->request['id'], \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS, get_called_class());
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function create(Request $request): bool
    {
        $PDOInstance = PDOSingleton::getInstance();
        $query = <<<SQL
INSERT INTO `{$this->table}` (`item_id`, `name`, `description`) VALUES (:task_id, :title, :description);
SQL;
        $statement = $PDOInstance->prepare($query);
        $statement->bindValue(':task_id', $request->post['task_id']);
        $statement->bindValue(':title', $request->post['title']);
        $statement->bindValue(':description', $request->post['description']);

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
