<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class UserController extends Controller
{
    protected $list;

    public function __construct()
    {
        $this->list = config('users');
    }

    public function index(Request $request)
    {
        $page = $request->query('page');
        $per_page = $request->query('per_page');
        $total = count($this->list);
        $total_page = ceil($total / $per_page);

        $start = ($page - 1) * $per_page;
        $new_list_by_pagination = array_slice($this->list, $start, $per_page);

        $data = [
            "page" => (int)$page,
            "per_page" => (int)$per_page,
            "total" => count($this->list),
            "total_pages" => $total_page,
            "data" => $new_list_by_pagination,
            "support" => [
                "url" => "https://reqres.in/#support-heading",
                "text" => "To keep ReqRes free, contributions towards server costs are appreciated!"
            ]
        ];

        return response()->json($data);
    }

    public function show($id)
    {
        foreach ($this->list as $user) {
            if ($user['id'] == $id) {
                return response()->json(['data' => $user, "support" => [
                    "url" => "https://reqres.in/#support-heading",
                    "text" => "To keep ReqRes free, contributions towards server costs are appreciated!"
                ]]);
            }
        }

        return response()->json(new stdClass(), 404);
    }
}
