<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\File;
use App\Traits\ImageUpload;
use App\News;
use App\Category;


class NewsController extends Controller
{   
    use ImageUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsMain = News::latest()->first();
        $news = News::latest()->offset(1)->limit(6)->get();

        return view('pages.home')->withNews($news)->withNewsMain($newsMain);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('news.create');
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
            'title' => 'required|unique:news|max:100',
            'body' => 'required',
            'photo' => 'required',
            'categories' => 'required',
        ]);

        $news = new News();
        $news->title = $request->title;
        $news->body = $request->body;
        $news->user_id = Auth::user()->id;

        $image = $this->uploadNewsPhoto($request->file('photo'));

        $news->photo = $image;
        $news->save();

        $news->categories()->sync($request->categories, false);

        Session::flash('message', 'News uploaded successfully!');

        return redirect()->route('news.show', $news->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);

        return view('news.show')->withNews($news);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        $categories = Category::all();
        $categories2 = [];
        foreach ($categories as $category) {
            $categories2[$category->id] = $category->name;
        }

        return view('news.edit')->withNews($news)->withCats($categories2);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:100',
            'body' => 'required',
            'categories' => 'required',
        ]);

        $news = News::find($id);
        $news->title = $request->title;
        $news->body = $request->body;
        if($request->hasFile('photo')){

            $photo = $this->uploadNewsPhoto($request->file('photo'), $news->photo);

            $news->photo = $photo;
        }
        $news->save();

        $news->categories()->sync($request->categories);

        Session::flash('message', 'News edited successfully!');

        return redirect()->route('news.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::destroy($id);

    }

    public function byCategory($category){

        $cat = Category::where('name', $category)->firstOrFail();

        $news = $cat->news;

        return view('news.category')->withNews($news);
    }
}
