<?php

namespace App\Http\Controllers\Wialon;

use App\Http\Controllers\Controller;
use App\Services\WialonService;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $token = $request->token;
        if($token){
            WialonService::login($token);
            info(['wialonSid' => session('wialonSid')]);
            return Inertia::render('Dashboard');
        }else{
            abort(401);
        }
    }

    public function items(){
        // $params = [
        //     "spec" => [
		// 		"itemsType" => 'avl_unit',	
		// 		"propName" => '',	
		// 		"propValueMask" => '',	
		// 		"sortType" => '',
		// 		"propType" => '',
		// 		"or_logic" => true	
        //     ],
        //     "force" => 1,			
        //     "flags" => 1,			
        //     "from" => 0,			
        //     "to" => 0
        // ];
        // $data = WialonService::makeRequest('core/search_items', $params);
        // return response()->json($data);
/***************** */
        // $params = [
        //     "itemId" => '82732',	//82711
        //     "flags" => 1,
        //     "lastTime" => 1685452633,
        //     "lastCount" => 100,
        //     "flagsMask" => 0,
        //     "loadCount" => 100
        // ];
        // $data = WialonService::makeRequest('messages/load_last', $params);
        // return response()->json($data);

        /************************* */
// $params = [];
//         $data = WialonService::makeRequest('avl_evts', $params);
//         return response()->json($data);


//************************** */

$params = [
    "type" => 2,	//82711
];
$data = WialonService::makeRequest('core/get_user_info', $params);
return response()->json($data);
    }
}
