<?php


namespace App\Controllers;

use Component\Http\JsonResponse;
use Component\Http\Request;

class RecipeController
{
    public function index($id)
    {
        echo $id;
    }

    /**
     * @param $request
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        return new JsonResponse(['content' => 'asd'], 200);
    }
}