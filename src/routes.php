<?php

$app->group(['namespace' => 'SwaggerUILumen'], function() use ($app) {
    $app->get(config('swagger-ui-lumen.routes.docs'), ['uses' => 'Http\Controllers\DocsController@index']);
    $app->get(config('swagger-ui-lumen.routes.api'), ['uses' => 'Http\Controllers\ApiController@index']);
});