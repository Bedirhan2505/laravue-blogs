<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blogs;
use Auth;

class BlogsController extends Controller
{
    public function addblog(Request $request){
       // $blogs = new Blogs;
    
            $file = array();
            array_push($file,$request->all());
            
            $response = [
                'success' => true,
                'data' => $file,
                'message' => 'Uploads Image'
                ];
            return response()->json($response, 200);
    }
}
