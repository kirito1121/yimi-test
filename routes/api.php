<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/services', function () {
    $menus = \App\Menu::with('services')->get();
    return $menus;
});

Route::post('/services', function (Request $request) {
    $input = $request->only(['name', 'price', 'unit', 'description', 'minutes']);
    $service = new \App\Service();
    $service->name = $input['name'];
    $service->price = $input['price'];
    $service->unit = $input['unit'];
    $service->description = $input['description'];
    $service->minutes = $input['minutes'];
    $path = $request->file('image')->store('services');
    $service->image = $path;
    $service->save();
    $service->menus()->attach($request->input('menu_id'), ['price' => 30]);
    return $service;
});

Route::post('/menus', function (Request $request) {
    $input = $request->all();
    $menus = \App\Menu::create($input);
    return $menus;
});

Route::put('/menus/{id}', function ($id, Request $request) {
    $input = $request->all();
    $menu = \App\Menu::find($id);
    $menu->name = $input['name'];
    $menu->save();
    return $menu;
});

Route::put('/services/{id}', function ($id, Request $request) {
    $input = $request->all();
    $service = \App\Service::find($id);
    $service->name = $request->input('name');
    $service->price = $request->input('price');
    $service->unit = $request->input('unit');
    $service->description = $request->input('description');
    $service->minutes = $request->input('minutes');
    $service->save();
    return $input;
});

Route::get('/extras', function (Request $request) {
    $extras = \App\Extra::with('options')->get();
    return $extras;
});

Route::get('/services/{id}', function ($id, Request $request) {
    $service = \App\Service::with('extras.options')->find($id);
    return $service;
});

Route::delete('/services/{id}', function ($id, Request $request) {
    $service = \App\Service::find($id);
    $service->delete();
    return 'abc';
});

Route::get('/extras/{id}', function ($id, Request $request) {
    $extra = \App\Extra::with('options')->find($id);
    return $extra;
});

Route::post('/extras', function (Request $request) {
    $input = $request->all();
    $extra = \App\Extra::create($input);
    return $extra;
});
Route::put('/extras/{id}', function ($id, Request $request) {
    $input = $request->all();
    $extras = \App\Extra::where('index', '>=', $input['index'])->get();
    foreach ($extras as $item) {
        $item->index = $item->index + 1;
        $item->save();
    }

    $extra = \App\Extra::find($id);
    $extra->name = $input['name'];
    $extra->index = $input['index'];
    $extra->multiple = $input['multiple'];
    $index = $extra->index;
    $extra->save();
    return $extra;
});

Route::get('/options', function (Request $request) {
    $options = \App\Option::get();
    return $options;
});
