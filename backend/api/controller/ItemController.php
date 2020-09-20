<?php
namespace api\controller;

use api\model\Item;
use framework\Request;
use framework\Response;

/**
 * Class ItemController
 * @package api\controller
 */
class ItemController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function getAll(Request $request)
    {
        $items = (new Item())->getAll();

        if ($items) {
            return new Response($items, 200);
        }

        return new Response('failure', 500);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function get(Request $request)
    {
        $item = (new Item())->get($request);

        if ($item) {
            return new Response($item, 200);
        }

        return new Response('failure', 500);
    }

    public function getByCategoryId(Request $request)
    {
        $items = (new Item())->getByCategoryId($request);

        if (is_array($items)) {
            return new Response($items, 200);
        }

        return new Response('failure', 500);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $itemCreated = (new Item())->create($request);

        if ($itemCreated) {
            return new Response($itemCreated, 200);
        }

        return new Response('failure', 500);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function delete(Request $request)
    {
        $itemDeleted = (new Item())->delete($request);

        if ($itemDeleted) {
            return new Response($itemDeleted, 200);
        }

        return new Response('failure', 500);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $itemUpdated = (new Item())->update($request);

        if ($itemUpdated) {
            return new Response($itemUpdated, 200);
        }

        return new Response('failure', 500);
    }
}
