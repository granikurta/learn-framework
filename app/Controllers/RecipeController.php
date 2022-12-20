<?php


namespace App\Controllers;

use Component\Http\JsonResponse;
use Database\DB;

class RecipeController
{

    private $connection;

    public function __construct()
    {
        $pdo = new DB();
        $this->connection = $pdo->getConnection();
    }

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