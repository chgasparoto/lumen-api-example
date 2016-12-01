<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->group(['prefix' => 'api/v1'], function($app) {

    /** User endpoints */
    $app->get('users', 'UserController@index');
    $app->get('users/{username}', 'UserController@show');
    $app->get('users/{id}/messages', 'UserController@userMessages');
    $app->post('users/{id}/messages', 'UserController@createMessage');

    /** Message endpoints */
    $app->get('messages', 'MessageController@index');
    $app->get('messages/{id}', 'MessageController@show');
    $app->put('messages/{id}', 'MessageController@update');
    $app->delete('messages/{id}', 'MessageController@delete');
});