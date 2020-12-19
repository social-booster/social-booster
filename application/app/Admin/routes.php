<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('users', UserController::class);
    $router->resource('concepts', ConceptController::class);
    $router->resource('concept-users', ConceptUserController::class);
    $router->resource('covers', CoverController::class);
    $router->resource('concept-votes', ConceptVoteController::class);
    $router->resource('concept-real-votes', ConceptRealVoteController::class);
    $router->resource('cover-votes', CoverVoteController::class);
    $router->resource('cover-real-votes', CoverRealVoteController::class);
    $router->resource('channels', ChannelController::class);
    $router->resource('messages', MessageController::class);
});
