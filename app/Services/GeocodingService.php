<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeocodingService
{
    public static function getLatLng($direccion)
    {
        $apiKey = '7e23c4c064ce4c3a8fa0f7400f082735'; // OpenCage API Key
        $url = 'https://api.opencagedata.com/geocode/v1/json?q=' . urlencode($direccion) . '&key=' . $apiKey . '&language=es';
        $response = Http::get($url);
        if ($response->ok() && isset($response['results'][0]['geometry'])) {
            return [
                'lat' => $response['results'][0]['geometry']['lat'],
                'lng' => $response['results'][0]['geometry']['lng'],
            ];
        }
        return null;
    }
}
