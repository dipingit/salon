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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');

Auth::routes();

//server side processing of data table
Route::post('all-bills', 'BillController@allBills');

//service search via select2
Route::get('service-autocomplete-search','ServiceController@autocompletesearch')->name('service-autocomplete-search');

//individual customer report
Route::get('customer/report/{id}', 'CustomerController@report');

//customer list print
Route::get('customer/print', 'CustomerController@print');

//customer list pdf
Route::get('customer/pdf', 'CustomerController@exportPDF');

//customer list excel
Route::get('customer/excel', 'CustomerController@exportExcel');

//server side data table processing of expenses
Route::post('all-expenses', 'ExpenseController@allExpenses');

//customer search via select2
Route::get('customer-autocomplete-search','CustomerController@autocompletesearch')->name('customer-autocomplete-search');

//expense item report
Route::get('expense-item/report/{id}', 'ExpenseItemController@report');
Route::post('all-expenses-of/{id}', 'ExpenseItemController@particularExpense');

//delete delivery
Route::post('bill/full-destroy/{id}', 'BillController@destroyBill');

//print a bill
Route::get('bill/print/{id}', 'BillController@print');

//return price of a service
Route::get('service/price/{id}', 'ServiceController@returnPrice');

Route::get('sms', 'HomeController@returnSMSPage');
Route::post('send/sms/individual', 'HomeController@sendSMSIndividually');
Route::post('send/sms/all', 'HomeController@sendSMSAll');


Route::group(['middleware' => ['auth']], function() {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('customer', 'CustomerController');
	Route::resource('employee', 'EmployeeController');
	Route::resource('service', 'ServiceController');
	Route::resource('expense', 'ExpenseController');
	Route::resource('bill', 'BillController');
	Route::resource('expense-item', 'ExpenseItemController');
});
