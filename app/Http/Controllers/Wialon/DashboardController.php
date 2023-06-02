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
            $login = WialonService::login($token);
            if($login){
                return Inertia::render('Dashboard');
            }else{
                return response()->json(WialonService::$error);
            }
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

// $params = [
//     "type" => 2,	//82711
// ];
// $data = WialonService::makeRequest('core/get_user_info', $params);
// return response()->json($data);

// $params = [
//             "spec" => [
//                 [
//                     "type" => 'id',	
//                     "data" => '82732',	
//                     "flags" => 2,	
//                     "mod" => 1,
//                     "max_items" => 2
//                 ],
//             ]
//         ];
//         $data = WialonService::makeRequest('core/update_data_flags', $params);
//         return response()->json($data);
    }
}
