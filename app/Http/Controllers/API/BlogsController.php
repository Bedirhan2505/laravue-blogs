<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blogs;
use Auth;
use Log;
use Str;
class BlogsController extends Controller
{
    public function addblog(Request $request){
       // $blogs = new Blogs;
            $image = $request->file('image');
            $imagefullname = $image->hashName();
            $request->file('image')->storeAs('images',$imagefullname);

            $blogs = new Blogs;
            $blogs->author_id = 1;
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
}