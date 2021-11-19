<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Story;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Image;

class StoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stories = Story::all();
        return view('dashboard.blogs.index', compact('stories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create');
        $cats = Category::all();
        return view('dashboard.blogs.create', compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'body' => 'required',
            'featured_image' => 'image|nullable|max:1999'

        ]);
        $store = new Story;

        $feat_img_path = [];

        if($request->file('featured_image')) {
            $originalImage  = $request->file('featured_image');
            $thumbnailImage = Image::make($originalImage);
            $thumbnailPath  = public_path().'/thumbnail/';
            $originalPath   = public_path().'/uploads/';

            $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());

            $thumbnailImage->resize(200,120);
            $thumbnailImage->save($thumbnailPath.time().$originalImage->getClientOriginalName());
            $feat_img_path = [ \URL::to('/thumbnail/'.time().$originalImage->getClientOriginalName() ),  \URL::to('/uploads/'.time().$originalImage->getClientOriginalName() )];
            $thumbnailImage->destroy();

        }

        $store->title = $request->title;
        $store->slug = Str::slug($request->title);
        $store->body = $request->body;
        $store->featured_image = \json_encode($feat_img_path);
        $store->status = $request->status;
        $store->category_id = $request->category_id; 
        $store->author_id = auth()->user()->id;
        $store->save();

        // if($post->save()) {
        //     $post_images = explode(",", $req->image);
        //     foreach($post_images as $image) {
        //         $image                 = new Images;
        //         $image->imageable_id   = $post->id;
        //         $image->imageable_type = 'App\Models\Blog\Post';
        //         $image->image_url      = \json_encode($feat_img_path);
        //         $image->save();
        //     }

        return redirect('/dashboard/stories/index')->with('Success', 'Story created successfully!');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $story = Story::where('slug', $slug)->first();
        $this->authorize('update', $story);
        // Gate::authorize('edit-story', $story);
        $category = Category::all();
        return view('dashboard.blogs.edit', compact('story', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'body' => 'required',
            // 'featured_image' => 'image|nullable|max:1999'

        ]);

        $story = Story::where('slug', $slug)->first();
        // $this->authorize('delete', $story);

        $feat_img_path = [];

        if($request->file('featured_image')) {
            $originalImage  = $request->file('featured_image');

            $thumbnailImage = Image::make($originalImage);
            $thumbnailPath  = public_path().'/thumbnail/';
            $originalPath   = public_path().'/uploads/';

            $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());

            $thumbnailImage->resize(200,120);
            $thumbnailImage->save($thumbnailPath.time().$originalImage->getClientOriginalName());
            $feat_img_path = [ \URL::to('/thumbnail/'.time().$originalImage->getClientOriginalName() ),  \URL::to('/uploads/'.time().$originalImage->getClientOriginalName() )];
            $thumbnailImage->destroy();


        //     if(!empty($featured_image)) {
        //         $story->title = $request->title;
        //         $story->slug = Str::slug($request->title);
        //         $story->body = $request->body;
        //         $story->featured_image = \json_encode($feat_img_path);
        //         $story->status = $request->status;
        //         $story->category_id = $request->category_id; 
        //         $story->author_id = auth()->user()->id;
        //         $story->save();
        // }
        } 
        // else {
        //     $new_story = new Story;
        //     $new_story->title = $request->title;
        //     $new_story->slug = Str::slug($request->title);
        //     $new_story->body = $request->body;
        //     $new_story->featured_image = \json_encode($feat_img_path);
        //     $new_story->status = $request->status;
        //     $new_story->category_id = $request->category_id; 
        //     $new_story->author_id = auth()->user()->id;
        //     $new_story->save();
        // }

        $story->title = $request->title;
        $story->slug = Str::slug($request->title);
        $story->body = $request->body;
        if($request->file('featured_image')) {
            $story->featured_image = \json_encode($feat_img_path);
        }
        $story->status = $request->status;
        $story->category_id = $request->category_id; 
        $story->author_id = auth()->user()->id;
        $story->save();

        return redirect('/dashboard/stories/index')->with('success', 'Story updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $story = Story::where('slug',$slug);
        $story->delete();
        return back();
    }
}
