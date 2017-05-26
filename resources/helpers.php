<?php

if (! function_exists('apiRoute')) {
    /**
     * @param        $routeName
     * @param array  $routeParams
     * @param string $version
     * @param bool   $absoluteUrl
     *
     * @return string
     */
    function apiRoute($routeName, $routeParams = [], $version = 'v1', $absoluteUrl = true)
    {
        $url = app(Dingo\Api\Routing\UrlGenerator::class);
        if (app()->environment() == 'production') {
            $url->forceSchema('https');
        }

        return $url->version($version)->route($routeName, $routeParams, $absoluteUrl);
    }
}