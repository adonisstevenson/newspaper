<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use App\News;
use App\Category;

class NewsController extends Controller
{   
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
    public function store(StoreNewsRequest $request)
    {

        $news = new News();
        $news->title = $request->title;
        $news->body = $request->body;
        $news->user_id = Auth::user()->id;

        $filename = 'news_photo/'.time().'.'.$request->file('photo')->getClientOriginalExtension();

        $img = Image::make($request->file('photo')->getRealPath())->resize(1366, 768)->stream();

        Storage::disk('public')->put($filename, $img, 'public');

        $news->photo = $filename;

        $news->save();

        $news->categories()->sync($request->categories, false);

        return redirect()->route('news.show', $news->slug)->with('message', 'News uploaded successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $news = News::findBySlugOrFail($slug);
        $comments = $news->comments()->orderBy('created_at', 'desc')->get();

        return view('news.show')->withNews($news)->withComments($comments);
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
    public function update(UpdateNewsRequest $request, $id)
    {

        $news = News::find($id);
        $news->title = $request->title;
        $news->body = $request->body;

        if($request->hasFile('photo')){

            Storage::disk('public')->delete($news->photo);

            $filename = 'news_photo/'.time().'.'.$request->file('photo')->getClientOriginalExtension();

            $img = Image::make($request->file('photo')->getRealPath())->resize(1366, 768)->stream();

            Storage::disk('public')->put($filename, $img, 'public');

            $news->photo = $filename;
        }

        $news->save();

        $news->categories()->sync($request->categories);

        return redirect()->route('news.show', $news->slug)->with('message', 'News edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $news = News::find($id)->delete();

        return redirect('/')->with('message', 'News succesfully removed');

    }

    /**
     * Sort news by category 
     * 
     * @param string $category
     * @return \Illuminate\Http\Response
     */
    public function listByCategory($category){

        $cat = Category::where('name', $category)->firstOrFail();

        return view('news.category')->withNews($cat->news);
    }

}
