<?php
namespace framework;

/**
 * Class modelBase
 * @package framework
 */
class ModelBase
{
    protected string $table;
    public int $id;

    /**
     * @return mixed
     */
    public function getAll()
    {
        $PDOInstance = PDOSingleton::getInstance();
        $query = <<<SQL
SELECT * FROM `{$this->table}`;
SQL;
        $statement = $PDOInstance->prepare($query);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS, get_called_class());
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function get(Request $request)
    {
        $PDOInstance = PDOSingleton::getInstance();
        $query = <<<SQL
SELECT * FROM `{$this->table}` WHERE `id` = :id;
SQL;
        $statement = $PDOInstance->prepare($query);
        $statement->bindValue(':id', $request->request['id']);
        $statement->execute();

        return $statement->fetchObject(get_called_class());
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function delete(Request $request): bool
    {
        $PDOInstance = PDOSingleton::getInstance();
        $query = <<<SQL
DELETE FROM `{$this->table}` WHERE `id` = :id;
SQL;
        $statement = $PDOInstance->prepare($query);
        $statement->bindValue(':id', $request->request['id']);

        return $statement->execute();
    }
}