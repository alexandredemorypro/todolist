<?php
namespace api\controller;

use api\model\Item;
use api\model\Subitem;
use framework\Request;
use framework\Response;

/**
 * Class SubitemController
 * @package api\controller
 */
class SubitemController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function getAll(Request $request)
    {
        $subitems = (new Subitem())->getAll();

        if ($subitems) {
            return new Response($subitems, 200);
        }

        return new Response('failure', 500);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function get(Request $request)
    {
        $subitem = (new Subitem())->get($request);

        if ($subitem) {
            return new Response($subitem, 200);
        }

        return new Response('failure', 500);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function getByItemId(Request $request)
    {
        $subitem = (new Subitem())->getByItemId($request);

        if (is_array($subitem)) {
            return new Response($subitem, 200);
        }

        return new Response('failure', 500);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $subitemCreated = (new Subitem())->create($request);

        if ($subitemCreated) {
            return new Response($subitemCreated, 200);
        }

        return new Response('failure', 500);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function delete(Request $request)
    {
        $subitemDeleted = (new Subitem())->delete($request);

        if ($subitemDeleted) {
            return new Response($subitemDeleted, 200);
        }

        return new Response('failure', 500);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $subitemUpdated = (new Subitem())->update($request);

        if ($subitemUpdated) {
            return new Response($subitemUpdated, 200);
        }

        return new Response('failure', 500);
    }
}