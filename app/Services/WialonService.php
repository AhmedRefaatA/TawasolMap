<?php
namespace App\Services;

use GuzzleHttp\Client;

class WialonService
{
    public static function login($token)
    {
        try {
            $client = new Client();
            $url = config('wialon.base_api_url');
            $response = $client->post($url, [
                'form_params' => [
                    'svc' => 'token/login',
                    'params' => json_encode([
                        "token" => $token,
                    ]),
                ],
            ]);
            $responseData = json_decode($response->getBody(), true);
            if (isset($responseData['eid'])) {
                session(['wialonSid' => $responseData['eid']]);
            }else{
                abort(401);
            }
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the request
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
?>