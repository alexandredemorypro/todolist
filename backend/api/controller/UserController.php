<?php
namespace api\controller;

use api\model\User;
use framework\Request;
use framework\Response;

/**
 * Class UserController
 * @package api\controller
 */
class UserController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function auth(Request $request)
    {
        $user = (new User())->get($request);

        if ($user) {
            $validPassword = password_verify($request->post['password'], $user->password);
            $user->password = null;
            if ($validPassword) {
                return new Response($user, 200);
            }
        }

        return new Response('failure', 500);
    }
}
