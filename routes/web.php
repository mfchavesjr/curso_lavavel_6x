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

use Illuminate\Routing\Route;

Route::get('/login', function () {
    return 'Tela Login';
})->name('login');

Route::get('/admin/dashboard', function(){
    return 'Home Admin';
})->middleware('auth');
// OU
Route::middleware(['auth'])->group( function () {

    Route::prefix('admin')->group(function () {

        Route::namespace('Admin')->group( function () {

            Route::name('admin')->group( function () {

                Route::get('/', function(){
                    return 'Home Admin';
                });

                Route::get('/financeiro', function(){
                    return 'Home Financeiro';
                });

                Route::get('/juridico', function(){
                    return 'Home Juridico';
                });
            });
        });
    });
});

// OU

Route::group([
    'middleware' => [],
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'name' => 'admin',
], function () {
    Route::get('/', function(){
        return 'Home Admin';
    });

    Route::get('/financeiro', function(){
        return 'Home Financeiro';
    });

    Route::get('/juridico', function(){
        return 'Home Juridico';
    });
});

Route::redirect('/redirect1', '/redirect2');
// OU
Route::get('/redirect1', function(){
    return redirect('/redirect2');
})->name('url.name');

Route::get('/redirect3', function(){
    return redirect()->route('url.name');
});

Route::get('/redirect2', function(){
    return 'Redirect 2';
});

Route::get('/categorias/{idPoduto?}', function($idPoduto = '') {
    return "Produto(s): {$idPoduto}";
});

Route::get('/categorias/{flag}', function($paramentro) {
    return "Produtos da categoria: {$paramentro}";
});

Route::get('/categorias/{paramentro}/posts', function($paramentro) {
    return "Posts da categoria: {$paramentro}";
});


Route::get('/', function () {
    return view('welcome');
});
