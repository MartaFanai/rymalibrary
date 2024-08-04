<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CacheController extends Controller
{
    public function ionicons()
    {
        $cacheKey = 'ionicons_css_' . md5('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css');
        if (Cache::has($cacheKey)) {
            $css = Cache::get($cacheKey);
        } else {
            $client = new \Illuminate\Http\Client\Factory();
            $response = $client->get('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css');
            if ($response->ok()) {
                $css = $response->body();
                Cache::put($cacheKey, $css, now()->addHours(24));
            }
        }
        return response($css)
            ->header('Content-Type', 'text/css');
    }

    public function google_fonts()
    {
        $cacheKey = 'google_fonts_' . md5('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700');
        if (Cache::has($cacheKey)) {
            $css = Cache::get($cacheKey);
        } else {
            $client = new \Illuminate\Http\Client\Factory();
            $response = $client->get('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700');
            if ($response->ok()) {
                $css = $response->body();
                Cache::put($cacheKey, $css, now()->addHours(24));
            }
        }
        return response($css)
            ->header('Content-Type', 'text/css');
    }

    public function google_api()
    {
        $cacheKey = 'google_fonts_' . md5('https://fonts.googleapis.com/css?family=Nunito:200,600');
        if (Cache::has($cacheKey)) {
            $css = Cache::get($cacheKey);
        } else {
            $client = new \Illuminate\Http\Client\Factory();
            $response = $client->get('https://fonts.googleapis.com/css?family=Nunito:200,600');
            if ($response->ok()) {
                $css = $response->body();
                Cache::put($cacheKey, $css, now()->addHours(24));
            }
        }
        return response($css)
            ->header('Content-Type', 'text/css');
    }

    public function material_icons()
    {
        $cacheKey = 'material_icons_' . md5('https://fonts.googleapis.com/icon?family=Material+Icons');
        if (Cache::has($cacheKey)) {
            $css = Cache::get($cacheKey);
        } else {
            $client = new \Illuminate\Http\Client\Factory();
            $response = $client->get('https://fonts.googleapis.com/icon?family=Material+Icons');
            if ($response->ok()) {
                $css = $response->body();
                Cache::put($cacheKey, $css, now()->addHours(24));
            }
        }
        return response($css)
            ->header('Content-Type', 'text/css');
    }

    public function dns_prefetch()
    {
        $cacheKey = 'dns_prefetch_' . md5('//fonts.gstatic.com');
        if (Cache::has($cacheKey)) {
            $link = Cache::get($cacheKey);
        } else {
            $link = '<link rel="dns-prefetch" href="//fonts.gstatic.com">';
            Cache::put($cacheKey, $link, now()->addHours(24));
        }
        return $link;
    }

}
