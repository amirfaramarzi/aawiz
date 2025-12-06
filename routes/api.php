<?php

/** @var Fomo\Router\Router $router */
#######################################################################################
##                                                                                   ##
##                                                                                   ##
##                                                                                   ##
##                                                                                   ##
##                                api v1 live here...                                ##
##                                                                                   ##
##                                                                                   ##
##                                                                                   ##
##                                                                                   ##
#######################################################################################
use App\V1\Middlewares\AdminAccessMiddleware;
use App\V1\Middlewares\AuthenticationMiddleware;
use App\V1\Controllers\AuthController;
use App\V1\Controllers\EvaluationController;

$router->group(['prefix' => 'v1'] , function () use ($router) {
    $router->group(['prefix' => 'auth'] , function () use ($router) {
        $router->post('login' , [AuthController::class , 'login']);
        $router->post('register' , [AuthController::class , 'register']);
    });
    $router->group(['middleware' => AuthenticationMiddleware::class] , function () use ($router) {
        $router->group(['prefix' => 'evaluations'] , function () use ($router) {
            $router->get('/' , [EvaluationController::class , 'getEvaluations']);
            $router->post('/' , [EvaluationController::class , 'insertEvaluation' , 'middleware' => AdminAccessMiddleware::class]);
            $router->patch('{evaluation_id}' , [EvaluationController::class , 'updateEvaluation' , 'middleware' => AdminAccessMiddleware::class]);
            $router->delete('{evaluation_id}' , [EvaluationController::class , 'destroyEvaluation' , 'middleware' => AdminAccessMiddleware::class]);
        });
    });
});