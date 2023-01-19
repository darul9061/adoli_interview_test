<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Home', [
        'Videos' => [
            [
                'title' => "",
                'sub_title' => "",
                'views' => "",
                'size' => "",
                'last_modified' => ""
            ],
            [
                'title' => "",
                'sub_title' => "",
                'views' => "",
                'size' => "",
                'last_modified' => ""
            ],
            [
                'title' => "",
                'sub_title' => "",
                'views' => "",
                'size' => "",
                'last_modified' => ""
            ],
            [
                'title' => "",
                'sub_title' => "",
                'views' => "",
                'size' => "",
                'last_modified' => ""
            ],
        ]
    ]);
});
Route::get('/projects', function () {
    return Inertia::render('Projects');
});
Route::get('/camera', function () {
    return Inertia::render('Camera');
});
