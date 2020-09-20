<?php
namespace api\model;

use framework\PDOSingleton;
use framework\Request;

/**
 * Class UserModel
 * @package api\model
 */
class User
{
    public int $id;
    public string $firstname;
    public string $lastname;
    public string $email;
    public ?string $password;
    public string $role;

    /**
     * @param Request $request
     * @return mixed
     */
    public function get(Request $request)
    {
        $PDOInstance = PDOSingleton::getInstance();
        $query = <<<'SQL'
SELECT * FROM `users` WHERE `email` = :email;
SQL;
        $statement = $PDOInstance->prepare($query);
        $statement->bindValue(':email', $request->post['email']);
        $statement->execute();

        return $statement->fetchObject('\api\model\User');
    }
}
