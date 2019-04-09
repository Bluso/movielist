<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movies;
use DB;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $movies = Movies::all();
        // $movies = DB::select('SELECT * FROM movies order by name asc');
        // $movies = Movies::orderBy('name','asc')->take(1)->get();
        // $movies = Movies::orderBy('name','asc')->get();
        $movies = Movies::orderBy('id','asc')->paginate(10); //page number
        return view('movie')->with('movies',$movies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modifymov');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'mov-time' => 'required',
            'description' => 'required',
            'category' => 'required',
            'img' => 'required'
        ]);

        $movie = new Movies;
        $movie->id = $request->input('id');
        $movie->name = $request->input('name');
        $movie->mov_time = $request->input('mov-time');
        $movie->description = $request->input('description');
        $movie->category = $request->input('category');
        $movie->img = $request->input('img');
        $movie->save();

        $path = $request->file('image')->store('upload');

        return redirect('/movies')->with('success', 'Movie Saved Success');
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
    public function edit($id)
    {
        $movies = Movies::find($id);
        return view('editmov')->with('movies',$movies);
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
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'mov-time' => 'required',
            'description' => 'required',
            'category' => 'required'
            // 'img' => 'required'
        ]);

        $movie = Movies::find($id);
        $movie->id = $request->input('id');
        $movie->name = $request->input('name');
        $movie->mov_time = $request->input('mov-time');
        $movie->description = $request->input('description');
        $movie->category = $request->input('category');
        $movie->img = $request->input('inputFile');
        $path = $request->file('inputFile')->store('public');
        $movie->save();

        return redirect('/movies')->with('success', 'Movie Updated Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movies::find($id);
        $movie->delete();

        return redirect('/movies')->with('success', 'Movie Removed Success');

    }
}
