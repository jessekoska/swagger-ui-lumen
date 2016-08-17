<?php

namespace SwaggerUILumen\Http\Controllers;

use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use SwaggerUILumen\Generator;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class DocsController extends Controller {

	public function index()
	{
		$page = 'api-docs.json';
		
		if (config('swagger-ui-lumen.generate_always')) {
	        Generator::generateDocs();
	    }
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
	}
}