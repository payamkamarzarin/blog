<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function post_blog(Request $request){

        $blog = new Blog();

        $blog->title = $request->input('title');
        $blog->title_description = $request->input('title_description');
        $blog->some_text = $request->input('some_text');
        $blog->text = $request->input('text');

        $file= $request->file('image');
        $filename = $file->getClientOriginalName();
        $path = $file->storeAs('uploads', $filename, 'public');

        $blog->image = 'storage/' . $path;

        $blog->save();

        return redirect(route('show'));
    }
    public function show(){
        return view('Admin.CreatePost');
    }

}
