<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

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
    $x = Carbon::createFromFormat('d/m/Y','22/12/2018')->toDateTimeString();
    dd($x);
    $file = storage_path().'/json/users.json';
    $data = json_decode(file_get_contents($file) , true);
    // dd(array_values($data));

    foreach($data['users'] as $key => $user)
    {
        dd($user);
    }
    return view('welcome');
});
