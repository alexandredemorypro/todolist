<?php
namespace api\controller;

use api\model\Category;
use framework\Request;
use framework\Response;

/**
 * Class CategoryController
 * @package api\controller
 */
class CategoryController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function getAll(Request $request)
    {
        $categories = (new Category())->getAll();

        if ($categories) {
            return new Response($categories, 200);
        }

        return new Response('failure', 500);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function get(Request $request)
    {
        $category = (new Category())->get($request);

        if ($category) {
            return new Response($category, 200);
        }

        return new Response('failure', 500);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $categoryCreated = (new Category())->create($request);

        if ($categoryCreated) {
            return new Response($categoryCreated, 200);
        }

        return new Response('failure', 500);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function delete(Request $request)
    {
        $categoryDeleted = (new Category())->delete($request);

        if ($categoryDeleted) {
            return new Response($categoryDeleted, 200);
        }

        return new Response('failure', 500);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $categoryUpdated = (new Category())->update($request);

        if ($categoryUpdated) {
            return new Response($categoryUpdated, 200);
        }

        return new Response('failure', 500);
    }
}