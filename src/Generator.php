<?php

namespace SwaggerUILumen;

use Illuminate\Support\Facades\File;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

class Generator
{
    public static function generateDocs()
    {
        $apps = config('swagger-ui-lumen.paths.annotations');
        $docs = config('swagger-ui-lumen.paths.docs');
        if (! File::exists($docs) || is_writable($docs)) {
            // delete all existing documentation
            if (File::exists($docs)) {
                File::deleteDirectory($docs);
            }
            File::makeDirectory($docs);
            
            $filename = $docs . '/api-docs.json';
            
            $yaml = base_path('api-docs.yaml');
            
            try {
                $array = Yaml::parse(file_get_contents('/path/to/file.yml'));
            } catch (ParseException $e) {
                printf("Unable to parse the YAML string: %s", $e->getMessage());
            }
            $json = json_encode($array);

            if (file_put_contents($filename, $json) === false) {
                throw new Exception('Failed to save ("' . $filename . '")');
            }
        }
    }\
}
