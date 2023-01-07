<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blogs;
use App\Models\Categories;
use Auth;
use Log;
use Str;
use Storage;
class BlogsController extends Controller
{
    public function addblog(Request $request){
       // $blogs = new Blogs;
            $image = $request->file('image');
            $imagefullname = $image->hashName();
            $request->file('image')->storeAs('images',$imagefullname);

            $blogs = new Blogs;
            $blogs->author_id = Auth::id();
            $blogs->image = $imagefullname;
            $blogs->description = $request->desc;
            $blogs->title = $request->title;
            $blogs->content = $request->content;
            $blogs->category_id = $request->selected;
            $blogs->slugs = Str::slug($request->title);
            
            if($blogs->save()){
                $response = [
                    'message' => 'Add Blog Successfuly',
                ];
            } else {
                $response = [
                    'message' => 'Add Blog Error !',
                ];
            }
            

            return response()->json($response, 200);

            
    }
    public function blogslist(){
        $getblogs = Blogs::get();
        $data = array();
        
        
        foreach ($getblogs as $getblog) {
            $categories= Categories::where("id",$getblog->category_id)->first();
            $imagelink = Storage::url('images/'.$getblog->image);
            array_push($data,[
                "title" => $getblog->title,
                "desc" => $getblog->description,
                "image" => $imagelink,
                "content" => $getblog->content,
                "created_at" => $getblog->created_at,
                "categories" => $categories->name
            ]);  
            
        }

        if($getblogs){
            $response = [
                'success' => true,
                'data' => $data,
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