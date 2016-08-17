<?php

namespace SwaggerUILumen\Http\Controllers;

use App\Http\Controllers\Controller;
use SwaggerUILumen\Generator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiController extends Controller {

	public function index($page = 'api-docs.json')
	{
		if (config('swagger-ui-lumen.generate_always')) {
	        Generator::generateDocs();
	    }
	    
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
	}
}