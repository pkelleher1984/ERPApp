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

Route::get('/reports',  function() { 

	return view('reports');
}
 );



Route::post('/reports',  'DashboardController@genReport');





Route::get('/controlpanel', 'DashboardController@logs');




Route::get('/', 'DashboardController@metrics')->name('dashboard');;





Route::get('/tasks/print', 'TasksController@index')->name('tasks.print');
Route::get('/tasks/bind', 'TasksController@index')->name('tasks.bind');
Route::get('/tasks/box', 'TasksController@index')->name('tasks.box');
Route::get('/tasks/build', 'TasksController@index')->name('tasks.build');
Route::resource('/tasks', 'TasksController');






Route::get('/orders/book', 'OrdersController@index')->name('orders.book');
Route::get('/orders/combo', 'OrdersController@index')->name('orders.combo');
Route::get('/orders/disc', 'OrdersController@index')->name('orders.disc');
Route::resource('/orders', 'OrdersController');




Route::get('/stockitems/book', 'StockItemsController@index')->name('stockitems.book');
Route::get('/stockitems/combo', 'StockItemsController@index')->name('stockitems.combo');
Route::get('/stockitems/disc', 'StockItemsController@index')->name('stockitems.disc');
Route::resource('/stockitems', 'StockItemsController');




Route::get('/status/activate/{id}',array('as'=>'status.activate','uses'=>'StatusController@activateOrder'));

Route::get('/status/hold/{id}',array('as'=>'status.hold','uses'=>'StatusController@holdOrder'));

//Route::get('/status/complete/{id}',array('as'=>'order.complete','uses'=>'StatusController@completeOrder'));

Route::get('/status/task/complete/{id}',array('as'=>'task.complete','uses'=>'StatusController@completeTask'));





Route::get('/orders/ajax/{id}',array('as'=>'myform.ajax','uses'=>'OrdersController@myformAjax'));



Auth::routes();

Route::get('/user/logout', 'StatusController@userLogout')->name('userLogout');

Route::get('/user/{id}', 'StatusController@userChange')->name('userChange');


Route::get('/admin', 'StatusController@adminLogin')->name('admin');


Route::get('/home', 'HomeController@index')->name('home');



/***
+--------+-----------+-----------------------------+--------------------+---------------------------------------------------+--------------+
| Domain | Method    | URI                         | Name               | Action                                            | Middleware   |
+--------+-----------+-----------------------------+--------------------+---------------------------------------------------+--------------+
|        | GET|HEAD  | /                           |                    | Closure                                           | web          |
|        | GET|HEAD  | api/user                    |                    | Closure                                           | api,auth:api |
|        | GET|HEAD  | orders                      | orders.index       | App\Http\Controllers\OrdersController@index       | web          |
|        | POST      | orders                      | orders.store       | App\Http\Controllers\OrdersController@store       | web          |
|        | GET|HEAD  | orders/create               | orders.create      | App\Http\Controllers\OrdersController@create      | web          |
|        | GET|HEAD  | orders/{order}              | orders.show        | App\Http\Controllers\OrdersController@show        | web          |
|        | PUT|PATCH | orders/{order}              | orders.update      | App\Http\Controllers\OrdersController@update      | web          |
|        | DELETE    | orders/{order}              | orders.destroy     | App\Http\Controllers\OrdersController@destroy     | web          |
|        | GET|HEAD  | orders/{order}/edit         | orders.edit        | App\Http\Controllers\OrdersController@edit        | web          |
|        | GET|HEAD  | reports                     |                    | Closure                                           | web          |
|        | POST      | stockitems                  | stockitems.store   | App\Http\Controllers\StockItemsController@store   | web          |
|        | GET|HEAD  | stockitems                  | stockitems.index   | App\Http\Controllers\StockItemsController@index   | web          |
|        | GET|HEAD  | stockitems/create           | stockitems.create  | App\Http\Controllers\StockItemsController@create  | web          |
|        | GET|HEAD  | stockitems/{stockitem}      | stockitems.show    | App\Http\Controllers\StockItemsController@show    | web          |
|        | PUT|PATCH | stockitems/{stockitem}      | stockitems.update  | App\Http\Controllers\StockItemsController@update  | web          |
|        | DELETE    | stockitems/{stockitem}      | stockitems.destroy | App\Http\Controllers\StockItemsController@destroy | web          |
|        | GET|HEAD  | stockitems/{stockitem}/edit | stockitems.edit    | App\Http\Controllers\StockItemsController@edit    | web          |
|        | POST      | tasks                       | tasks.store        | App\Http\Controllers\TasksController@store        | web          |
|        | GET|HEAD  | tasks                       | tasks.index        | App\Http\Controllers\TasksController@index        | web          |
|        | GET|HEAD  | tasks/create                | tasks.create       | App\Http\Controllers\TasksController@create       | web          |
|        | PUT|PATCH | tasks/{task}                | tasks.update       | App\Http\Controllers\TasksController@update       | web          |
|        | DELETE    | tasks/{task}                | tasks.destroy      | App\Http\Controllers\TasksController@destroy      | web          |
|        | GET|HEAD  | tasks/{task}                | tasks.show         | App\Http\Controllers\TasksController@show         | web          |
|        | GET|HEAD  | tasks/{task}/edit           | tasks.edit         | App\Http\Controllers\TasksController@edit         | web          |
+--------+-----------+-----------------------------+--------------------+---------------------------------------------------+--------------+


**/

