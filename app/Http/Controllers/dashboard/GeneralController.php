<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Story;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{

    // STORY CATEGORY STARTS HERE
    public function index()
    {
        $stories = Story::all();
        $categories = Category::all();
        return view('dashboard.blog-setting', compact('stories','categories'));
    }

    public function storiesblogs(){
        $cats = Category::all();
        return view('dashboard.blogs.blogcat', compact('cats'));
    }
    public function saveblogCat(Request $req){
        $req->validate([
            'name' => 'required'
        ]);

        $cat = New Category;
        $cat->name = $req->name;
        $cat->slug =  Str::slug($req->name);
        $cat->author_id = auth()->user()->id;
        $cat->save();

        return back()->with('success', 'Story category created!');
    }
    public function updateblogCat(Request $req, $slug){
        $req->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ]);
        $cat = Category::where('slug', $slug)->first();

        $cat->name = $req->name;
        $cat->slug = $req->slug;
        $cat->save();
        return back()->with('success', 'Story category updated!');
    }

    public function deleteBlogCat($slug){
        $cat = Category::where('slug',$slug)->first();
        $cat->delete();
        return back();
    }
    
}
