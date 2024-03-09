<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

$list = [
    [
        "id" => 1,
        "email" => "george.bluth@reqres.in",
        "first_name" => "George",
        "last_name" => "Bluth",
        "avatar" => "https://reqres.in/img/faces/1-image.jpg"
    ],
    [
        "id" => 2,
        "email" => "janet.weaver@reqres.in",
        "first_name" => "Janet",
        "last_name" => "Weaver",
        "avatar" => "https://reqres.in/img/faces/2-image.jpg"
    ],
    [
        "id" => 3,
        "email" => "emma.wong@reqres.in",
        "first_name" => "Emma",
        "last_name" => "Wong",
        "avatar" => "https://reqres.in/img/faces/3-image.jpg"
    ],
    [
        "id" => 4,
        "email" => "eve.holt@reqres.in",
        "first_name" => "Eve",
        "last_name" => "Holt",
        "avatar" => "https://reqres.in/img/faces/4-image.jpg"
    ],
    [
        "id" => 5,
        "email" => "charles.morris@reqres.in",
        "first_name" => "Charles",
        "last_name" => "Morris",
        "avatar" => "https://reqres.in/img/faces/5-image.jpg"
    ],
    [
        "id" => 6,
        "email" => "tracey.ramos@reqres.in",
        "first_name" => "Tracey",
        "last_name" => "Ramos",
        "avatar" => "https://reqres.in/img/faces/6-image.jpg"
    ], [
        "id" => 7,
        "email" => "michael.lawson@reqres.in",
        "first_name" => "Michael",
        "last_name" => "Lawson",
        "avatar" => "https://reqres.in/img/faces/7-image.jpg"
    ],
    [
        "id" => 8,
        "email" => "lindsay.ferguson@reqres.in",
        "first_name" => "Lindsay",
        "last_name" => "Ferguson",
        "avatar" => "https://reqres.in/img/faces/8-image.jpg"
    ],
    [
        "id" => 9,
        "email" => "tobias.funke@reqres.in",
        "first_name" => "Tobias",
        "last_name" => "Funke",
        "avatar" => "https://reqres.in/img/faces/9-image.jpg"
    ],
    [
        "id" => 10,
        "email" => "byron.fields@reqres.in",
        "first_name" => "Byron",
        "last_name" => "Fields",
        "avatar" => "https://reqres.in/img/faces/10-image.jpg"
    ],
    [
        "id" => 11,
        "email" => "george.edwards@reqres.in",
        "first_name" => "George",
        "last_name" => "Edwards",
        "avatar" => "https://reqres.in/img/faces/11-image.jpg"
    ],
    [
        "id" => 12,
        "email" => "rachel.howell@reqres.in",
        "first_name" => "Rachel",
        "last_name" => "Howell",
        "avatar" => "https://reqres.in/img/faces/12-image.jpg"
    ]
];


Route::get('/user', function (Request $request) use ($list) {
    $page = $request->query('page');
    $per_page = $request->query('per_page');
    $total = count($list);
    $total_page = ceil($total / $per_page);

    $start = ($page - 1) * $per_page;
    $new_list_by_pagination = array_slice($list, $start, $per_page);

    $data = [
        "page" => $page,
        "per_page" => $per_page,
        "total" => count($list),
        "total_pages" => $total_page,
        "data" => $new_list_by_pagination, "support" => [
            "url" => "https://reqres.in/#support-heading",
            "text" => "To keep ReqRes free, contributions towards server costs are appreciated!"
        ]
    ];

    return response()->json($data);
});

Route::get('/user/{id}', function ($id) use ($list) {
    foreach ($list as $user) {
        if ($user['id'] == $id) {
            return response()->json(['data' => $user, "support" => [
                "url" => "https://reqres.in/#support-heading",
                "text" => "To keep ReqRes free, contributions towards server costs are appreciated!"
            ]]);
        }
    }

    return response()->json(new stdClass(), 404);
});
