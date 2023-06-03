<?php

namespace App\Http\Controllers\Wialon;

use App\Events\UpdateVehicleLocation;
use App\Http\Controllers\Controller;
use App\Services\WialonService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VehicleTrackingController extends Controller
{
    public function index(){
        try {
            $params = [
                "spec" => [
                    "itemsType" => 'avl_unit',	
                    "propName" => '',	
                    "propValueMask" => '',	
                    "sortType" => '',
                    "propType" => '',
                    "or_logic" => true	
                ],
                "force" => 1,			
                "flags" => 1,			
                "from" => 0,			
                "to" => 0
            ];
            $data = WialonService::makeRequest('core/search_items', $params);
            $items = $data['items'];
            return Inertia::render('Vehicle/Index', [
                'items' => $items
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'error' => $e->getMessage()
             ]); 
        }
    }

    public function tracking(Request $request, $id){
        $params = [
            "itemId" => $id,//'82732',	//82711
            "flags" => 1,
            "lastTime" => $request->t,
            "lastCount" => 1,
            "flagsMask" => 0,
            "loadCount" => 1
        ];
        $data = WialonService::makeRequest('messages/load_last', $params);
        event(new UpdateVehicleLocation($id, $data));
    }
}
