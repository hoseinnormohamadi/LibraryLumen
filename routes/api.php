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

$router->get( 'health', 'HealthController@healthStatus');

$router->group(['namespace' => 'Api', 'prefix' => 'api', 'as' => 'api.'], function ($router) {
    $router->group(['namespace' => 'V1', 'prefix' => 'v1', 'as' => 'v1.'], function ($router) {
        $router->post('/Login', 'AuthController@login2');
        $router->post('/Register', 'AuthController@Register');
        $router->get('/', '');
        $router->group(['prefix' => 'User/'], function ($router) {
            $router->get('/MyBooks', 'UserController@MyBooks');
            $router->get('/MyInfo', 'UserController@MyInfo');
            $router->post('/ChangePassword', 'UserController@ChangePassword');
        });
        $router->group(['prefix' => 'Book/'], function ($router) {
            $router->get('/', 'BookController@AllBook');
            $router->post('/AddBook', 'BookController@AddBook');
            $router->get('/Show/{ID}', 'BookController@Show');
            $router->get('/Delete/{ID}', 'BookController@Delete');
            $router->get('/FindByTag/{TAG}', 'BookController@FindByTag');
            $router->put('/Edit/{ID}/', 'BookController@Update');
        });
        $router->group(['prefix' => 'Tag/'], function ($router) {
            $router->post('/Add', 'TagController@Add');
            $router->get('/Delete/{ID}', 'TagController@Delete');
        });
        $router->group(['prefix' => 'Payment/'], function ($router) {
            $router->get('/Buy/{ID}', 'PaymentController@Buy');
            $router->get('/Rent/{ID}', 'PaymentController@Rent');
            $router->get('/UnRent/{ID}', 'PaymentController@UnRent');
        });
    });
});
