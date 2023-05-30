<?php
namespace App\Services;

use App\Models\User;
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
            static::auth_user($responseData['user']);
            if (isset($responseData['eid'])) {
                session(['wialonSid' => $responseData['eid']]);
                return redirect()->route('dashboard');
            }else{
                abort(401);
            }
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the request
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public static function makeRequest(string $svc, array $params, string $method = 'post'){
        try {
            $client = new Client();
            $url = config('wialon.base_api_url');
            $response = $client->$method($url, [
                'form_params' => [
                    'sid' => session('wialonSid'),
                    'svc' => $svc,
                    'params' => json_encode($params),
                ],
            ]);
            $responseData = json_decode($response->getBody(), true);
            return $responseData ?? false;
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the request
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public static function auth_user(array $wialonUser){
        
        try {
            $user = User::firstOrCreate([
                'wialon_id' => $wialonUser['id'],
            ], [
                'name' => $wialonUser['nm'],
                'password' => bcrypt($wialonUser['id']),
                'wialon_id' => $wialonUser['id'],
            ]);
            auth()->attempt([
                'name' => $wialonUser['nm'],
                'password' => $wialonUser['id']
            ]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
        
    }
}
?>