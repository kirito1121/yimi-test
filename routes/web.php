<?php

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
    return 'Try to smile through your pain until pain made you smile.';
});

// Route::get('/services', function () {
//     $menus = \App\Menu::with('services.extras.options')->get();
//     return $menus;
// });
// use Illuminate\Http\Request;
// Route::post('/menus', function (Request $request) {
//     $input = $request->all();
//     $menus = \App\Menu::create($input);
//     return $menus;
// });
