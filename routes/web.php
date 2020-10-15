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
    return view('welcome');
});
//ou (fazer esse caso apenas quando é uma view MUITO simples).
Route::view('/welcome', 'welcome');

//Aceita todos e quaisquer tipos de requisição HTTP.
Route::any('/any', function () {
   return 'any';
});

//Aceita apenas as requisições que foram passadas no array.
Route::match(['get', 'post'], '/match', function () {
    return 'match';
});

//Parâmetro obrigatório pela URL.
Route::get('/categorias/{categoria}', function ($categoria) {
   return "Produtos da categoria: {$categoria}";
});

//URL fixa após parâmetro passado dinamicamente.
Route::get('/categorias/{categoria}/posts', function ($categoria) {
   return  "Posts da categoria: {$categoria}";
});

//Parâmetro não obrigatório, passa ? após ao parâmetro na URL e passa valor default no callback.
Route::get('/produtos/{idProduct?}', function ($idProduct = null) {
    return "Produto(s) {$idProduct}";
});

//Redirecionamento de rotas.
Route::get('/redirect1', function () {
    return redirect('redirect3');
});
//ou
Route::redirect('/redirect2', '/redirect3');
//para
Route::get('/redirect3', function () {
    return 'Olá, está na rota redirect 3.';
});

//Rotas nomeadas, neste caso podemos sempre utilizar o name e não mais a rota.
//Ex: route('todas.requisicoes') ou return redirect()->route('todas.requisicoes');
Route::any('/any', function () {
    return 'any';
})->name('todas.requisicoes');

//Grupos de rotas e utilização de middleware.
Route::get('/login', function () {
    return 'Área de Login.';
})->name('login');

// Middlaware de autenticação, todos dentro do grupo.
/* Route::middleware(['auth'])->group(function () {
        //Grupo de prefixos da URL, todas rotas dentro ficam admin/nome-url.
        Route::prefix('admin')->group(function () {
           //Grupo de namespaces, todas ficam dentro de Controller\Admin
           Route::namespace('Admin')->group(function () {
               //Grupo de name de rotas, todas ficam com admin.nome-rota.
               Route::name('admin.')->group(function () {
                   Route::get('/', 'AdminController@index')->name('home');
                   Route::get('/produtos', 'AdminController@products')->name('products');
                   Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
                   Route::get('/financeiro', 'AdminController@financial')->name('financial');
               });
           });
       });
    });
*/
//ou de forma resumida
Route::group([
    'name' => 'admin.',
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['auth'],
], function () {
    Route::get('/', 'AdminController@index')->name('home');
    Route::get('/produtos', 'AdminController@products')->name('products');
    Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::get('/financeiro', 'AdminController@financial')->name('financial');
});

//Trabalhando com Controllers.
/*  Route::get('/products', 'ProductController@index')->name('products.index');
    Route::get('/products/{id}', 'ProductController@show')->name('products.show');
    Route::put('/products/{id}', 'ProductController@update')->name('products.update');
    Route::post('/products/store', 'ProductController@store')->name('products.store');
    Route::get('/products/{id}/edit', 'ProductController@edit')->name('products.edit');
    Route::get('/products/create', 'ProductController@create')->name('products.create');
    Route::delete('/products/{id}', 'ProductController@destroy')->name('products.destroy');
*/
//ou para resumir todos as rotas padrões de cima em apenas uma linha, apenas uma linha emplementa todos os métodos a cima.
Route::resource('products', 'ProductController')->middleware(['auth', 'check.is.admin']); //<- Para adicionar o middleware a todos os métodos.
Route::get('products/search', 'ProductController@search')->name('products.search');

Auth::routes(['register' => false]);
