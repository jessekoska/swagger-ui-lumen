<?php

use Illuminate\Support\Facades\App;
use Swagger\Swagger;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

$app->get(config('swagger-ui-lumen.routes.docs'), function ($page = 'api-docs.json') {
    $filePath = config('swagger-ui-lumen.paths.docs')."/{$page}";

    if (File::extension($filePath) === '') {
        $filePath .= '.json';
    }

    if (! File::exists($filePath)) {
        App::abort(404, "Cannot find {$filePath}");
    }

    $content = File::get($filePath);

    return new Response($content, 200, [
        'Content-Type' => 'application/json',
    ]);
});

$app->get(config('swagger-ui-lumen.routes.api'), function () {
    
    if (config('swagger-ui-lumen.proxy')) {
        $proxy = (new Request)->server('REMOTE_ADDR');
        (new Request)->setTrustedProxies([$proxy]);
    }

    $extras = [];
    $conf = config('swagger-ui-lumen');
    if (array_key_exists('validatorUrl', $conf)) {
        // This allows for a null value, since this has potentially
        // desirable side effects for swagger.  See the view for more
        // details.
        $extras['validatorUrl'] = $conf['validatorUrl'];
    }

    //need the / at the end to avoid CORS errors on Homestead systems.
    $response = new Response(
        view('swagger-ui-lumen::index', [
            'apiKeyPrefix' => config('swagger-ui-lumen.api.auth_token_prefix'),
            'apiKey' => config('swagger-ui-lumen.api.auth_token'),
            'apiKeyVar' => config('swagger-ui-lumen.api.key_var'),
            'apiKeyInject' => config('swagger-ui-lumen.api.key_inject'),
            'secure' => (new Request)->secure(),
            'urlToDocs' => url(config('swagger-ui-lumen.routes.docs')),
            'requestHeaders' => config('swagger-ui-lumen.headers.request'),
        ], $extras),
        200
    );

    if (is_array(config('swagger-ui-lumen.headers.view')) && ! empty(config('swagger-ui-lumen.headers.view'))) {
        foreach (config('swagger-ui-lumen.headers.view') as $key => $value) {
            $response->header($key, $value);
        }
    }

    return $response;
});