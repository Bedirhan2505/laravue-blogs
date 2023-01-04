<?php

namespace App\Http\Controllers\API;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function listencategory(Request $request){
        $getcat = Categories::all();
        if($getcat){
            $response = [
                'success' => true,
                'data' => $getcat,
                'message' => 'Listening Category All'
                ];
            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => 'Error Listening'
                ];
            return response()->json($response, 200);
        }
    }
}
