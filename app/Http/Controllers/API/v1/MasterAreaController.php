<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\MasterArea;
use Illuminate\Http\Request;
use Illuminate\Queue\RedisQueue;

class MasterAreaController extends Controller
{
    //
    protected $apiKey;
    public function __construct(Request $request)
    {
        $this->apiKey = $request->query('api_key');
    }
    public function index(Request $request){
        if ($this->apiKey!== config('services.api.secret')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return response()->json([
            MasterArea::all()
        ]);
        
    }

    public function show($id){
        
        if ($this->apiKey !== config('services.api.secret')){
            return response()->json([
                'message' => 'unauthorized'
            ],401);
        }

        $area = MasterArea::find($id);

        if(!$area){
            return response()->json([
                'message' => 'data not found'
            ],404);
        }
        return response()->json([
            'data' => $area
        ]);

    }
}           
