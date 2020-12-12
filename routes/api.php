<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('customers/{customer}', 'CustomerController@show')->name('api.v1.customers.show');
    Route::get('customers', 'CustomerController@index')->name('api.v1.customers.index');
    Route::get('customers-blocked', 'CustomerController@blockedCustomers')
        ->name('api.v1.customers_locked.index');
    Route::post('customers', 'CustomerController@store')->name('api.v1.customers.store');
    Route::put('customers', 'CustomerController@update')->name('api.v1.customers.update');
    Route::delete('customers/{customer}', 'CustomerController@blockCustomer')->name('api.v1.customers.delete');
});
