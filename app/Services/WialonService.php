<?php
namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use GuzzleHttp\Client;

class WialonService
{
    // Define error property to store any error from service functions.
    public static $error;

    // Login Function for wialon user and internal system.
    public static function login($token)
    {
        try {
            // Wialon login token Request.
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
            // Check if authanticated wialon user find or create user in internal system and generate session keys.
            if (isset($responseData['eid'])) {
                $authUser = static::auth_user($responseData['user']);
                if(!$authUser){
                    return false;
                }
                session([
                    'wialonSid' => $responseData['eid'],
                    'wialonToken' => $token
                ]);
                return true;
            }else{
                abort(401);
            }
        } catch (\Exception $e) {
            static::$error = $e->getMessage();
            return false;
        }
    }

    // Make wialon request
    public static function makeRequest(string $svc, array $params, string $method = 'post'){
        try {
            // update Session id.
            static::login(session('wialonToken'));
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
            static::$error = $e->getMessage();
            return false;
        }
    }

    public static function auth_user(array $wialonUser){
        
        try {
            $user = app(UserRepositoryInterface::class)->findOrCreate($wialonUser);
            auth()->attempt([
                'name' => $wialonUser['nm'],
                'password' => $wialonUser['id']
            ]);
            return true;
        } catch (\Exception $e) {
            static::$error = $e->getMessage();
            return false;
        }
    }
}
?>